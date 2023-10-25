<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Timeslot;
use Illuminate\Database\Seeder;

class TeacherAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeslots = Timeslot::all();

        foreach ($timeslots as $timeslot) {
            $teacherId = Course::find($timeslot->course_id)->teacher_id;
            $timeslot->teacherAttendances()->attach($teacherId);
        }
    }
}
