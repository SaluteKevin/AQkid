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

        $timeslotIds = range(1, 10);

        foreach ($timeslotIds as $timeslotId) {
            $timeslot = Timeslot::find($timeslotId);

            foreach ($students as $student) {
                $student->studentAttendances()->attach($timeslot, ['has_attended' => ($timeslotId == 10 && $student->id == 4) ? 'FALSE' : 'TRUE']);
            }
        }

        // Make-up class for student_id = 4
        $student = User::find(4);
        $timeslot = Timeslot::find(11);
        $student->studentAttendances()->attach($timeslot, ['has_attended' => 'TRUE']);
    }
}
