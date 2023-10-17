<?php

namespace App\Models;

use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Enums\ReceiptDescriptionEnum;
use App\Models\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Course Enrollments
 */
class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function receipt(): HasOne
    {
        return $this->hasOne(Receipt::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public static function createEnrollment(int $studentId, int $courseId, string $proofOfPaymentPath, EnrollmentStatusEnum $enrollmentStatusEnum): bool
    {
        $statusOk = false;

        if (
            Course::where('id', $courseId)->exists()
            && User::where('id', $studentId)->where('role', UserRoleEnum::STUDENT->name)->exists()
        ) {
            $enrollment = new Enrollment();
            $enrollment->course_id = $courseId;
            $enrollment->student_id = $studentId;
            $enrollment->status = $enrollmentStatusEnum->name;
            $enrollment->proof_of_payment_path = $proofOfPaymentPath;

            $statusOk = $enrollment->save();
        } else {
            error_log('Invalid argument Student ID \'' . $studentId . '\' or Course ID \'' . $courseId . '\'');
        }

        return $statusOk;
    }

    /**
     * Get a Collection of Enrollments with the EnrollmentStatusEnum.
     * @return Collection
     */
    public static function enrollmentsWithStatus(EnrollmentStatusEnum $enrollmentStatus): Collection
    {
        return Enrollment::where('status', $enrollmentStatus->name);
    }

    /**
     * Get a Collection of students [User] in a Course, with optional Enrollment status.
     * @return Collection
     */
    public static function studentsIn(int $courseId, EnrollmentStatusEnum $enrollmentStatus = EnrollmentStatusEnum::SUCCESS): Collection
    {
        return User::whereIn(
            'id',
            Enrollment::where('course_id', $courseId)
                ->where('status', $enrollmentStatus->name)
                ->pluck('student_id')
        )->get();
    }

    /**
     * Mass update Enrollment statuses.
     * @param array $idStatusEnumMap An associative array of [$enrollmentId: int, $enrollmentStatusEnum: EnrollmentStatusEnum] pairs.
     * @return array An associative array of [$enrollmentId: int, $enrollmentStatusEnum: EnrollmentStatusEnum] pairs with errors.
     */
    // public static function massUpdateStatus(array $idStatusEnumMap /* EnrollmentStatusEnum $enrollmentStatus, int ...$enrollmentIds*/): array
    // {
    //     $failedIdStatusEnumPairs = [];
    //     array_walk($idStatusEnumMap, function ($id, $statusEnum) {
    //         if (
    //             $enrollment = Enrollment::find($id) != null
    //             && $statusEnum instanceof EnrollmentStatusEnum
    //         ) {
    //             $enrollment->status = $statusEnum->name;
    //         } else {
    //             array_push($failedIdStatusEnumPairs, [$id, $statusEnum]);
    //         }
    //     });

    //     return $failedIdStatusEnumPairs;
    // }

    /**
     * Update an Enrollment request status. If changing to SUCCESS, this function will automatically try to create Receipt.
     * @return bool $statusOk If true success, the Enrollment's status was successfully updated to the provided argument,
     *  otherwise, no changes were made.
     */
    public function updateStatus(EnrollmentStatusEnum $enrollmentStatusEnum, string $reviewComment = null): bool
    {
        if ($this->status == $enrollmentStatusEnum->name) {
            error_log('Error attempting to change with same status');
            return false;
        } else if (
            $enrollmentStatusEnum == EnrollmentStatusEnum::FAILED
            && $reviewComment == null
        ) {
            error_log('Comments required for request rejection');
            return false;
        }

        $statusOk = false;

        if ($enrollmentStatusEnum == EnrollmentStatusEnum::SUCCESS) {
            $statusOk = Receipt::createReceipt($this->id, ReceiptDescriptionEnum::PAY_COURSE_FEE->value);
        }

        if (!$statusOk) {
            error_log('Error creating Receipt');
            return false;
        }

        $this->status = $enrollmentStatusEnum->name;
        $this->review_comment = $reviewComment;
        $statusOk = $this->save();

        return $statusOk;
    }
}
