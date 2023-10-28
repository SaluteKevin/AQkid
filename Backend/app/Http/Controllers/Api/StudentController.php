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
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


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
        $this->middleware('auth:api', ['except' => ['getAllClasses', 'getAllCourse', 'showCourse', 'enrollCourse', 'updateProfile', 'userStat','allEnrollCourses']]);
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
        $course->teacher = $teacher;
        $course->enroll_count = $course->studentsIn($course->id,EnrollmentStatusEnum::SUCCESS)->count();
        return $course;
    }

    public function enrollCourse(Course $course, User $user , Request $request){

        $request->validate([
            'image_path' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:2048'
        ]);

        if( Course::availableSpotCount($course->id) == 0 ) {
            return response()->json([
                'message' => "Course is Full, Pls contact the staff",
            ],422);
        }

        if( Course::availableSpotCount($course->id) < 0 ) {
            return response()->json([
                'message' => "Course is Closed",
            ],422);
        }

        $imageOk = FileService::getFileManager()->uploadFile('users/' . $user->id . "/payments" . "/" . Carbon::now() . ".jpg",$request->file('image_path'));

        if ($imageOk != false) {

            $statusOk =  Enrollment::createEnrollment($user->id, $course->id, $imageOk, EnrollmentStatusEnum::PENDING);

            if ($statusOk) {

                return response()->json([
                    'message' => "Successfully Enroll Course",
                ]);


            }

            return response()->json([
                'message' => "Failed to Enroll Course",
            ],422);


        }

        return response()->json([
            'message' => "Failed to Upload Slip",
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


    public function allEnrollCourses(User $user) {
        // Course::allTimeslotsWithAuthor($course);
        return Course::getAllEnrollmentCourses($user);

    }
}
