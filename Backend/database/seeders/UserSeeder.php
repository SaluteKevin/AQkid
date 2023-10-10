<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'staff_01',
            'password' => 'staff_password',
            'role' => 'STAFF',
            'first_name' => 'Salute',
            'last_name' => 'Khumyunn',
            'birthdate' => '1998-09-22',
            'phone_number' => '0988765432',
            'profile_image_path' => 'assets/_defaults/profile_image.png',
            'created_at' => '2022-11-28 08:00:00',
            'updated_at' => '2022-11-28 08:00:00'
        ]);

        User::create([
            'username' => 'teacher_01',
            'password' => 'teacher_password',
            'role' => 'TEACHER',
            'first_name' => 'Potsawat',
            'last_name' => 'Thinkanwatthana',
            'birthdate' => '2000-01-01',
            'phone_number' => '0987654321',
            'profile_image_path' => 'assets/teacher_01/profile_image.png',
            'created_at' => '2022-11-29 08:00:00',
            'updated_at' => '2022-11-29 08:00:00'
        ]);

        User::create([
            'username' => 'teacher_02',
            'password' => 'teacher_password',
            'role' => 'TEACHER',
            'first_name' => 'Jonathan',
            'last_name' => 'Thinkanwatthana',
            'birthdate' => '2001-01-01',
            'phone_number' => '0897654321',
            'profile_image_path' => 'assets/teacher_02/profile_image.png',
            'created_at' => '2022-11-29 09:00:00',
            'updated_at' => '2022-11-29 09:00:00'
        ]);

        User::create([
            'username' => 'j.doe',
            'password' => 'password',
            'role' => 'STUDENT',
            'first_name' => 'John',
            'middle_name' => 'Linus',
            'last_name' => 'Doe',
            'birthdate' => '2014-05-01',
            'phone_number' => '0123456789',
            'profile_image_path' => 'assets/j.doe/profile_image.png',
            'created_at' => '2022-12-07 09:00:00',
            'updated_at' => '2022-12-07 09:00:00'
        ]);

        User::create([
            'username' => 'a.seed',
            'password' => 'password',
            'role' => 'STUDENT',
            'first_name' => 'Apple',
            'last_name' => 'Seed',
            'birthdate' => '2014-08-21',
            'phone_number' => '0123457689',
            'profile_image_path' => 'assets/a.seed/profile_image.png',
            'created_at' => '2022-12-07 09:40:00',
            'updated_at' => '2022-12-07 09:40:00'
        ]);

        User::create([
            'username' => 'b.bird',
            'password' => 'password',
            'role' => 'STUDENT',
            'first_name' => 'Burden',
            'last_name' => 'Bird',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'assets/b.bird/profile_image.png',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);
    }
}
