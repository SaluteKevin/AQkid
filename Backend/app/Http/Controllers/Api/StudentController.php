<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\EnrollmentStatusEnum;
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
        $this->middleware('auth:api', ['except' => ['getAllClasses','getAllCourse','showCourse','enrollCourse']]);
    }

    public function getAllClasses(){
       return Timeslot::get();
    }


    public function getAllCourse(){
        return Course::where('status',"OPEN")->get();
    }

    public function showCourse(Course $course){
        $teacher = User::find($course->teacher_id);
        return [$course, $teacher];
    }

    public function enrollCourse(Course $course, User $user , Request $request){
        
        if ($request->file('image_path')) {

            $path = $request->file('image_path')->store('uploads', 'public');
            $statusOk =  Enrollment::createEnrollment($user->id, $course->id, $path, EnrollmentStatusEnum::SUCCESS);
            if ($statusOk) {
                return response()->json([
                    'message' => "Successfully created User",
                ]);
            }

            return response()->json([
                'message' => "Failed to create User",
            ],422);
        }
        return response()->json([
            'message' => "Failed to Enroll Course",
        ],422);
        



    }
}
