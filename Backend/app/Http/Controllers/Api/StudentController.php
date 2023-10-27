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
use App\Models\Enums\StudentAttendanceEnum;
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
        $this->middleware('auth:api', ['except' => ['getAllClasses', 'getAllCourse', 'showCourse', 'enrollCourse', 'updateProfile', 'userStat']]);
    }

    public function getAllClasses(User $user)
    {
        return Timeslot::getStudentClasses($user);
    }


    public function getAllCourse(User $user)
    {
        return Course::whereIn('id', Enrollment::where('student_id', $user->id)
        ->where('status', EnrollmentStatusEnum::SUCCESS->name)
        ->pluck('course_id'))
        ->get();

    }

    public function showCourse(Course $course)
    {
        $teacher = User::find($course->teacher_id);
        return [$course, $teacher];
    }

    public function enrollCourse(Course $course, User $user , Request $request){

        if( Course::availableSpotCount($course->id) == 0 ) {
            return response()->json([
                'message' => "Course is Fully pls call the admin",
            ]);
        }
        if( Course::availableSpotCount($course->id) < 0 ) {
            return response()->json([
                'message' => "Course is Closed",
            ]);
        }

        if ($request->file('image_path')) {

            $path = $request->file('image_path')->store('uploads', 'public');
            $statusOk =  Enrollment::createEnrollment($user->id, $course->id, $path, EnrollmentStatusEnum::SUCCESS);
            if ($statusOk) {
                return response()->json([
                    'message' => "Successfully Register course",
                ]);
            }
        }
        return response()->json([
            'message' => "Failed to Register Course",
        ],422);
        



    }
    

    public function userStat(User $user)
    {

        return response()->json([
            'enrollments' => Enrollment::where('student_id', $user->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->count(),
            'courses' => Course::whereIn('id', Enrollment::where('student_id', $user->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->pluck('course_id'))->count(),
            'attend' => $user->studentAttendances->where('pivot.has_attended', StudentAttendanceEnum::TRUE->name)->count(),
        ]);
    }


    public function profile(User $user)
    {
        return User::where('role', 'STUDENT')::find($user);
    }
}
