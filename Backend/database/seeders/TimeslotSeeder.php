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
        $courses = Course::where('status', CourseStatusEnum::ENDED->name)->orWhere('status', CourseStatusEnum::OPEN->name)->get();

        foreach ($courses as $course) {
            $courseId = $course->id;
            $dateTime = strtotime($course->start_datetime);
            $quota = $course->quota;
            $courseCreatedAt = $course->created_at;

            for ($time = 0; $time < $quota; $time++) {
                Timeslot::create([
                    'course_id' => $courseId,
                    'datetime' => date('Y-m-d H:i:s', $dateTime),
                    'type' => TimeslotTypeEnum::REGULAR->name,
                    'created_at' => $courseCreatedAt,
                    'updated_at' => $courseCreatedAt
                ]);

                $dateTime = strtotime('+1 week', $dateTime);

                // Make-up class for student_id = 4
                if ($courseId == 2 && date('Y-m-d H:i:s', $dateTime) == '2023-03-15 10:00:00') {
                    Timeslot::create([
                        'course_id' => $courseId,
                        'datetime' => date('Y-m-d H:i:s', $dateTime),
                        'type' => TimeslotTypeEnum::MAKEUP->name,
                        'created_at' => $courseCreatedAt,
                        'updated_at' => $courseCreatedAt
                    ]);
                }
            }
        }
    }
}
