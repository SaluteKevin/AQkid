<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\TimeslotTypeEnum;
use App\Models\Timeslot;
use Illuminate\Database\Seeder;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::whereIn('status', [
            CourseStatusEnum::OPEN->name,
            CourseStatusEnum::FULL->name,
            CourseStatusEnum::ACTIVE->name,
            CourseStatusEnum::ENDED->name
        ])->get();

        foreach ($courses as $course) {
            $courseId = $course->id;
            $courseQuota = $course->quota;
            $courseCreatedAt = $course->created_at;
            $timeslotDateTime = strtotime($course->starts_on);

            for ($time = 0; $time < $courseQuota; $time++) {
                Timeslot::create([
                    'course_id' => $courseId,
                    'datetime' => date(env('APP_DATETIME_FORMAT'), $timeslotDateTime),
                    'type' => TimeslotTypeEnum::REGULAR->name,
                    'created_at' => $courseCreatedAt,
                    'updated_at' => $courseCreatedAt
                ]);

                $timeslotDateTime = strtotime('+1 week', $timeslotDateTime);

                // Make-up class for Course 2, Student std1
                if ($courseId == 2 && date(env('APP_DATETIME_FORMAT'), $timeslotDateTime) == '2023-03-15 10:00:00') {
                    Timeslot::create([
                        'course_id' => $courseId,
                        'datetime' => date(env('APP_DATETIME_FORMAT'), $timeslotDateTime),
                        'type' => TimeslotTypeEnum::MAKEUP->name,
                        'created_at' => '2023-03-01 10:00:00',
                        'updated_at' => '2023-03-01 10:00:00'
                    ]);
                }
            }
        }
    }
}
