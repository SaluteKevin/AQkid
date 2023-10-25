<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Receipt;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = Enrollment::all();

        foreach ($enrollments as $enrollment) {
            if ($enrollment->status != EnrollmentStatusEnum::SUCCESS->name) {
                continue;
            }

            $coursePrice = Course::find($enrollment->course_id)->price;
            Receipt::create([
                'enrollment_id' => $enrollment->id,
                'payment_timestamp' => $enrollment->created_at,
                'receipt_timestamp' => $enrollment->updated_at,
                'description' => 'Course fee',
                'amount' => $coursePrice,
                'subtotal' => $coursePrice,
                'total' => $coursePrice,
                'created_at' => $enrollment->updated_at,
                'updated_at' => $enrollment->updated_at
            ]);
        }
    }
}
