<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Enums\EnrollmentStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enrollment::create([
            'course_id' => 2,
            'student_id' => 4,
            'proof_of_payment_path' => 'users/4/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 09:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Enrollment::create([
            'course_id' => 2,
            'student_id' => 5,
            'proof_of_payment_path' => 'users/5/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 08:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Enrollment::create([
            'course_id' => 2,
            'student_id' => 6,
            'proof_of_payment_path' => 'users/6/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 10:05:00',
            'updated_at' => '2022-12-08 09:02:00'
        ]);

        Enrollment::create([
            'course_id' => 3,
            'student_id' => 7,
            'proof_of_payment_path' => 'users/7/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 11:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Enrollment::create([
            'course_id' => 3,
            'student_id' => 7,
            'proof_of_payment_path' => 'users/7/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => '2022-12-07 11:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Enrollment::create([
            'course_id' => 3,
            'student_id' => 7,
            'proof_of_payment_path' => 'users/7/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::FAILED->name,
            'created_at' => '2022-12-07 11:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);
    }
}
