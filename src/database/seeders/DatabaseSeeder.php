<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = new User();
        $user->username = "test";
        $user->password = "123";
        $user->email = "test@test.com";
        $user->role = "admin";
        $user->save();


        $user = new User();
        $user->username = "kevin";
        $user->password = "123";
        $user->email = "a@a.com";
        $user->role = "user";
        $user->save();

    }
}
