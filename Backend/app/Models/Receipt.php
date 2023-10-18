<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    use HasFactory;

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public static function createReceipt(int $enrollmentId, string $description): bool
    {
        if (($enrollment = Enrollment::find($enrollmentId)) == null) {
            error_log('Enrollment \'' . $enrollmentId . '\' not found');
            return false;
        } else if (($course = Course::find($enrollment->course_id)) == null) {
            error_log('Course \'' . $enrollment->course_id . '\' not found');
            return false;
        }

        $receipt = new Receipt();

        $receipt->enrollment_id = $enrollmentId;
        $receipt->payment_timestamp = $enrollment->created_at;
        $receipt->receipt_timestamp = date(env('APP_DATETIME_FORMAT'), time());
        $receipt->description = $description;
        $receipt->amount = $course->price;
        $receipt->subtotal = $course->price;
        $receipt->total = $course->price;

        return $receipt->save();
    }
}
