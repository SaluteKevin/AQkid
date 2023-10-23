<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'teacher_id' => 2,
            'title' => 'Tue 10am',
            'description' => 'A Tuesday course at 10:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 0,
            'max_age' => 6,
            'duration' => 60,
            'opens_on' => '2022-12-05 08:00:00',
            'opens_until' => '2023-01-03 10:00:00',
            'starts_on' => '2023-01-03 10:00:00',
            'status' => CourseStatusEnum::CANCELLED->name,
            'price' => 7500.00,
            'created_at' => '2022-12-05 08:00:00',
            'updated_at' => '2023-01-03 10:00:00'
        ]);

        Course::create([
            'teacher_id' => 3,
            'title' => 'Wed 10am',
            'description' => 'A Wednesday course at 10:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 6,
            'max_age' => 12,
            'duration' => 60,
            'opens_on' => '2022-12-05 08:05:00',
            'opens_until' => '2023-01-04 10:00:00',
            'starts_on' => '2023-01-04 10:00:00',
            'status' => CourseStatusEnum::ENDED->name,
            'price' => 7500.00,
            'created_at' => '2022-12-05 08:05:00',
            'updated_at' => '2023-03-08 11:00:00'
        ]);

        Course::create([
            'teacher_id' => 2,
            'title' => 'Wed 4pm',
            'description' => 'A Wednesday course at 16:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => '2023-10-02 08:10:00',
            'opens_until' => '2024-01-03 16:00:00',
            'starts_on' => '2024-01-03 16:00:00',
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => '2023-10-02 08:10:00',
            'updated_at' => '2023-10-02 08:10:00'
        ]);
    }
}
