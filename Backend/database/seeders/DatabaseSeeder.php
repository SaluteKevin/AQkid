<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = new User();
        $user->username = "test";
        $user->password = "123";
        $user->email = "test@test.com";
        $user->role = "staff";
        $user->save();


        $user = new User();
        $user->username = "kevin";
        $user->password = "123";
        $user->email = "a@a.com";
        $user->role = "user";
        $user->save();
    }
}
