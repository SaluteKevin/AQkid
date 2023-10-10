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
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => '2022-12-07 09:10:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Enrollment::create([
            'course_id' => 2,
            'student_id' => 6,
            'status' => EnrollmentStatusEnum::SUCCESS->name,
            'created_at' => '2022-12-07 10:05:00',
            'updated_at' => '2022-12-08 09:02:00'
        ]);
    }
}
