<?php

namespace Database\Seeders;

use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::find(2);
        $timeslotIds = range(1, 11);

        foreach ($timeslotIds as $timeslotId) {
            $timeslot = Timeslot::find($timeslotId);
            $teacher->teacherAttendances()->attach($timeslot);
        }
    }
}
