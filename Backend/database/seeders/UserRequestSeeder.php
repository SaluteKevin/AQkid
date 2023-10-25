<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\UserRequestStatusEnum;
use App\Models\Enums\UserRequestTypeEnum;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Database\Seeder;

class UserRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRequest::create([
            'originator_id' => User::where('username', 'ef_std1')->first()->id,
            'course_id' => Course::where('status', CourseStatusEnum::ENDED->name)->first()->id,
            'type' => UserRequestTypeEnum::REFUND->name,
            'title' => 'Request for Refund',
            'description' => 'Submitted late',
            'status' => UserRequestStatusEnum::PENDING->name
        ]);

        UserRequest::create([
            'originator_id' => User::where('username', 'ef_std2')->first()->id,
            'course_id' => Course::where('status', CourseStatusEnum::ENDED->name)->first()->id,
            'type' => UserRequestTypeEnum::REFUND->name,
            'title' => 'Request for Refund',
            'description' => 'Submitted late',
            'status' => UserRequestStatusEnum::APPROVED->name
        ]);

        UserRequest::create([
            'originator_id' => User::where('username', 'ef_std3')->first()->id,
            'course_id' => Course::where('status', CourseStatusEnum::ENDED->name)->first()->id,
            'type' => UserRequestTypeEnum::REFUND->name,
            'title' => 'Request for Refund',
            'description' => 'Submitted late',
            'status' => UserRequestStatusEnum::REJECTED->name,
            'review_comment' => 'Fake transaction slip'
        ]);
    }
}
