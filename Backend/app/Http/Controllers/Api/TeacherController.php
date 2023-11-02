<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Enums\StudentAttendanceEnum;
use App\Models\StudentAttendance;
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
        $this->middleware('auth:api', ['except' => ['getEvent','getTimeslot','getStudentAttends','studentAttend','studentAbsent',
        'getTeacherCourses']]);
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
        
        $timeslot->title = Course::find($timeslot->course_id)->title;

        return $timeslot;
    }

    public function getStudentAttends(Timeslot $timeslot){
      
        return $timeslot->studentAttendances;
    }

    public function studentAttend(Timeslot $timeslot, User $student) {

        if ($timeslot->updateAttendance($student->id, StudentAttendanceEnum::TRUE)) {

            return response()->json([
                'message' => "Successfully Attend Student",
            ]);

        }

        return response()->json([
            'message' => "Failed to Attend Student",
        ],422);
    }

    public function studentAbsent(Timeslot $timeslot, User $student) {

        if ($timeslot->updateAttendance($student->id, StudentAttendanceEnum::FALSE)) {

            return response()->json([
                'message' => "Successfully Absent Student",
            ]);
            
        }

        return response()->json([
            'message' => "Failed to Absent Student",
        ],422);

    }
    public function studentReview(Timeslot $timeslot, User $student, Request $request) {
        if ($timeslot->updateReview($student->id, $request->reviewText)) {

            return response()->json([
                'message' => "Successfully Review Student",
            ]);
            
        }

        return response()->json([
            'message' => "Failed to Review Student",
        ],422);

    }
    public function studentReviewImages(Timeslot $timeslot, User $student) {

        if ($timeslot->updateReviewImages($student->id, StudentAttendanceEnum::FALSE)) {

            return response()->json([
                'message' => "Successfully Absent Student",
            ]);
            
        }

        return response()->json([
            'message' => "Failed to Absent Student",
        ],422);

    }

    public function getTeacherCourses(User $teacher) {

        return Course::where('teacher_id',$teacher->id)->get()->sortby('created_at');

    }


}
