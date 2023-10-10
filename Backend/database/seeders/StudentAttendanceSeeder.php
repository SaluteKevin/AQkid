<?php

namespace Database\Seeders;

use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            User::find(4),
            User::find(6)
        ];

        $timeslot_ids = range(1, 10);

        foreach ($timeslot_ids as $timeslot_id) {
            $timeslot = Timeslot::find($timeslot_id);

            foreach ($students as $student) {
                $student->student_attendances()->attach($timeslot, ['has_attended' => ($timeslot_id == 10 && $student->id == 4) ? 'FALSE' : 'TRUE']);
            }
        }

        // Make-up class for student_id = 4
        $student = User::find(4);
        $timeslot = Timeslot::find(11);
        $student->student_attendances()->attach($timeslot, ['has_attended' => 'TRUE']);
    }
}
