<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeslots = Timeslot::all();
        $course2student1 = User::where('username', 'std1')->first();
        $course2student1Id = $course2student1->id;

        foreach ($timeslots as $timeslot) {
            if ($timeslot->id == 11) {
                $timeslot->studentAttendances()->attach($course2student1, ['has_attended' => 'TRUE']);
                continue;
            }

            $studentIds = Enrollment::where('course_id', $timeslot->course_id)
                ->where('status', EnrollmentStatusEnum::SUCCESS->name)
                ->get()->map(function ($e) {
                    return $e['student_id'];
                });

            foreach ($studentIds as $studentId) {
                $timeslot->studentAttendances()->attach($studentId, ['has_attended' => ($timeslot->id == 10 && $studentId == $course2student1Id) ? 'FALSE' : 'TRUE']);
            }
        }
    }
}
