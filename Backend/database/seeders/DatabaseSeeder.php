<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            EnrollmentSeeder::class,
            ReceiptSeeder::class,
            TimeslotSeeder::class,
            TeacherAttendanceSeeder::class,
            StudentAttendanceSeeder::class,
            UserRequestSeeder::class,
        ]);
    }
}
