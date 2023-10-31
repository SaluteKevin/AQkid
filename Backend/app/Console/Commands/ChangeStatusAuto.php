<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;

class ChangeStatusAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-status-auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timeThreshold = Carbon::now(); 

        // Delete tokens older than the threshold
        $courses = Course::where('opens_on', '<=', $timeThreshold)->where('opens_until', '>=', $timeThreshold)->get();

        foreach($courses as $course) {
            $course->status = CourseStatusEnum::OPEN->name;
            $course->save();
        }
        
        $this->info("Succesfully, set Course Status");
    }
}
