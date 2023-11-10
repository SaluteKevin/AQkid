<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Course 1 was CANCELLED, no Enrollments required

        // Course 2 has ENDED
        $courseId = 2;

        $studentId = User::where('username', 'std1')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => '2022-12-07 09:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        // Fake payment slip
        $studentId = User::where('username', 'std2')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::FAILED->name,
            'review_comment' => 'Fake transaction slip',
            'created_at' => '2022-12-07 08:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        $studentId = User::where('username', 'std3')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => '2022-12-07 10:05:00',
            'updated_at' => '2022-12-08 09:02:00'
        ]);

        // Course 3 is OPEN
        $courseId = 3;

        $studentId = User::where('username', 'std1')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 11:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        $studentId = User::where('username', 'std3')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::PENDING->name,
            'created_at' => '2022-12-07 11:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        // Course 4 is FULL
        $courseId = 4;
        $createdAt = Course::find($courseId)->opens_on;
        $updatedAt = date(env('APP_DATETIME_FORMAT'), strtotime('+1 day', strtotime(Course::find($courseId)->opens_on)));

        $studentId = User::where('username', 'std4')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std5')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std6')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std7')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        // Course 5 is ACTIVE
        $courseId = 5;
        $createdAt = Course::find($courseId)->opens_on;
        $updatedAt = date(env('APP_DATETIME_FORMAT'), strtotime('+1 day', strtotime(Course::find($courseId)->opens_on)));

        $studentId = User::where('username', 'std8')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std9')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std10')->first()->id;
        Enrollment::create([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);

        $studentId = User::where('username', 'std1')->first()->id;
        Enrollment::create([
            'course_id' => 26,
            'student_id' => $studentId,
            'proof_of_payment_path' => 'users/' . $studentId . '/payments/hashed-slip-file-name.jpg',
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);
    }
}
