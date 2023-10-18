<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Enums\CourseStatusEnum;
use App\Models\Timeslot;

use function Laravel\Prompts\error;

class StudentController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllClasses','getAllCourse','showCourse']]);
    }

    public function getAllClasses(){
       return Timeslot::get();
    }


    public function getAllCourse(){
        return Course::where('status',"OPEN")->get();
    }

    public function showCourse(Course $course){
        
        return $course;
    }
}
