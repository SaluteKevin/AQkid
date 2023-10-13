<?php

namespace App\Models;

use App\Models\Enums\EnrollmentStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrollment extends Model
{
    use HasFactory;

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

    public static function studentsIn(int $courseId, EnrollmentStatusEnum $enrollmentStatus = EnrollmentStatusEnum::SUCCESS): Collection
    {
        return User::whereIn(
            'id',
            Enrollment::where('course_id', $courseId)
                ->where('status', $enrollmentStatus->name)
                ->pluck('student_id')
        )->get();
    }
}
