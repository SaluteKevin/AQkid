<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Timeslot;



class TeacherController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getEvent','getTimeslot','getStudentAttends']]);
    }

    public function getEvent(User $teacher){
        
        $teacherCourses = Course::where('teacher_id',$teacher->id)->get();


        $alltimeslots =  [];

        foreach($teacherCourses as $course) {

            foreach($course->timeslots as $timeslot) {

                $timeslot->title = Course::find($timeslot->course_id)->title;
                $alltimeslots[] = $timeslot; 

            }

        }


        return $alltimeslots;
    }

    public function getTimeslot(Timeslot $timeslot){
      
        return $timeslot;
    }

    public function getStudentAttends(Timeslot $timeslot){
      
        return $timeslot->studentAttendances;
    }


}
