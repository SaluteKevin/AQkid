<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Course 1 was CANCELLED
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
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

        // Course 2 has ENDED
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
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

        // Course 3 is OPEN
        $teacherId = User::where('username', '_t2')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Fri 12pm',
            'description' => 'A Friday course at 12:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday noon', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday noon', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday noon', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday noon', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday noon', strtotime('-2 week', time()))),
        ]);

        $teacherId = User::where('username', '_t3')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher number 3',
            'description' => 'learn with teacher number 3',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 10am', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 10am', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 10am', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 10am', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 10am', strtotime('-2 week', time()))),
        ]);

        $teacherId = User::where('username', '_t4')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no. 3',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 11am', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 11am', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 11am', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 11am', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 11am', strtotime('-2 week', time()))),
        ]);

        $teacherId = User::where('username', '_t2')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no. 2',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 1pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 1pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 1pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 1pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 1pm', strtotime('-2 week', time()))),
        ]);

        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday 2pm', strtotime('-2 week', time()))),
        ]);
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Wednesday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Wednesday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Wednesday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Wednesday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Wednesday 2pm', strtotime('-2 week', time()))),
        ]);
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Saturday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Saturday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Saturday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Saturday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Saturday 2pm', strtotime('-2 week', time()))),
        ]);
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Sunday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Sunday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Sunday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Sunday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Sunday 2pm', strtotime('-2 week', time()))),
        ]);
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Friday 2pm', strtotime('-2 week', time()))),
        ]);
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Teacher no money',
            'description' => 'hello world',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday 2pm', strtotime('-1 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday 2pm', strtotime('+2 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday 2pm', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::OPEN->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday 2pm', strtotime('-2 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday 2pm', strtotime('-2 week', time()))),
        ]);

        // Course 4 is FULL
        $teacherId = User::where('username', '_t3')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Thu 12pm',
            'description' => 'A Thursday course at 12:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday noon', strtotime('-2 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday noon', strtotime('-1 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday noon', strtotime('+4 week', time()))),
            'status' => CourseStatusEnum::FULL->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday noon', strtotime('-3 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Thursday noon', strtotime('-3 week', time())))
        ]);

        // Course 5 is ACTIVE
        $teacherId = User::where('username', '_t1')->first()->id;
        Course::create([
            'teacher_id' => $teacherId,
            'title' => 'Tue 12pm',
            'description' => 'A Tuesday course at 12:00',
            'quota' => 10,
            'capacity' => 4,
            'min_age' => 12,
            'max_age' => 24,
            'duration' => 60,
            'opens_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday noon', strtotime('-2 week', time()))),
            'opens_until' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday noon', strtotime('-1 week', time()))),
            'starts_on' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday noon', strtotime('-1 week', time()))),
            'status' => CourseStatusEnum::ACTIVE->name,
            'price' => 7500.00,
            'created_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday noon', strtotime('-3 week', time()))),
            'updated_at' => date(env('APP_DATETIME_FORMAT'), strtotime('next Tuesday noon', strtotime('-3 week', time()))),
        ]);
    }
}
