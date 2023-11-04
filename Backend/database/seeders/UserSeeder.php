<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = 1;

        // Staff
        User::create([
            'username' => '_s',
            'password' => '54321`',
            'role' => 'STAFF',
            'first_name' => 'Only',
            'last_name' => 'Staff',
            'birthdate' => '1998-09-22',
            'phone_number' => '0988765432',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-28 08:00:00',
            'updated_at' => '2022-11-28 08:00:00'
        ]);

        // Teacher #
        User::create([
            'username' => '_t1',
            'password' => '54321`',
            'role' => 'TEACHER',
            'first_name' => 'First',
            'last_name' => 'Teacher',
            'birthdate' => '2000-01-01',
            'phone_number' => '0987654321',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-29 08:00:00',
            'updated_at' => '2022-11-29 08:00:00'
        ]);

        User::create([
            'username' => '_t2',
            'password' => '54321`',
            'role' => 'TEACHER',
            'first_name' => 'Second',
            'last_name' => 'Teacher',
            'birthdate' => '2001-01-01',
            'phone_number' => '0897654321',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-29 09:00:00',
            'updated_at' => '2022-11-29 09:00:00'
        ]);

        User::create([
            'username' => '_t3',
            'password' => '54321`',
            'role' => 'TEACHER',
            'first_name' => 'Third',
            'last_name' => 'Teacher',
            'birthdate' => '2000-01-01',
            'phone_number' => '0987654321',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-29 08:00:00',
            'updated_at' => '2022-11-29 08:00:00'
        ]);

        User::create([
            'username' => '_t4',
            'password' => '54321`',
            'role' => 'TEACHER',
            'first_name' => 'Fourth',
            'last_name' => 'Teacher',
            'birthdate' => '2001-01-01',
            'phone_number' => '0897654321',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-29 09:00:00',
            'updated_at' => '2022-11-29 09:00:00'
        ]);

        User::create([
            'username' => '_t5',
            'password' => '54321`',
            'role' => 'TEACHER',
            'first_name' => 'Fifth',
            'last_name' => 'Teacher',
            'birthdate' => '2001-01-01',
            'phone_number' => '0897654321',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-11-29 09:00:00',
            'updated_at' => '2022-11-29 09:00:00'
        ]);

        // STuDent #
        User::create([
            'username' => 'std1',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'First',
            'last_name' => 'Student',
            'birthdate' => '2014-05-01',
            'phone_number' => '0123456789',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:00:00',
            'updated_at' => '2022-12-07 09:00:00'
        ]);

        User::create([
            'username' => 'std2',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Second',
            'last_name' => 'Student',
            'birthdate' => '2014-08-21',
            'phone_number' => '0123457689',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:40:00',
            'updated_at' => '2022-12-07 09:40:00'
        ]);

        User::create([
            'username' => 'std3',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Third',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std4',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Fourth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std5',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Fifth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std6',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Sixth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std7',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Seventh',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std8',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Eighth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std9',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Ninth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'std10',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Tenth',
            'last_name' => 'Student',
            'birthdate' => '1997-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        // Enroll Failure STuDent #
        User::create([
            'username' => 'ef_std1',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'First',
            'middle_name' => 'Fail Enroll',
            'last_name' => 'Student',
            'birthdate' => '1996-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'ef_std2',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Second',
            'middle_name' => 'Fail Enroll',
            'last_name' => 'Student',
            'birthdate' => '1996-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        User::create([
            'username' => 'ef_std3',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Third',
            'middle_name' => 'Fail Enroll',
            'last_name' => 'Student',
            'birthdate' => '1996-01-16',
            'phone_number' => '0123457698',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            'created_at' => '2022-12-07 09:55:00',
            'updated_at' => '2022-12-07 09:55:00'
        ]);

        // Others
        User::create([
            'username' => 'Mikali99008',
            'password' => '54321`',
            'role' => 'STUDENT',
            'first_name' => 'Mikali',
            'last_name' => 'Hetian',
            'birthdate' => '2021-10-17',
            'phone_number' => '0878133545',
            'profile_image_path' => 'users/' . $id++ . '/profile_image.jpg',
            // `email` => `mikali@gmail.com`,
            'created_at' => '2022-10-17 09:55:00',
            'updated_at' => '2022-10-17 09:55:00'
        ]);
    }
}
