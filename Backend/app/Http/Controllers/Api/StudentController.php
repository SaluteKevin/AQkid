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
use App\Models\StudentAttendance;
use App\Models\Timeslot;
use App\Models\UserRequest;
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
        $this->middleware('auth:api', ['except' => ['getAllClasses', 'getAllCourse', 'showCourse', 'enrollCourse', 'updateProfile', 'userStat','allEnrollCourses','refundRequest','myEnrollments','myRefunds','getReceipt','certificate']]);
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
        // $course->timeslots->sortby('datetime');

        $course->timeslots->each(function ($time) {
            
            $time->title = Course::find($time->course_id)->title;
            
        })->sortby('datetime');

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

        $startDate = Carbon::parse($user->birthdate);
        $currentDate = Carbon::now();

        $monthsDifference = $startDate->diffInMonths($currentDate);

        if ($monthsDifference > $course->max_age || $monthsDifference < $course->min_age) {

            return response()->json([
                'message' => "Your age is not valid",
            ],422);

        }

        $imageOk = FileService::getFileManager()->uploadFile('users/' . $user->id . "/payments" . "/" . $this->generate_id(Carbon::now()) . ".jpg",$request->file('image_path'));

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

    public function generate_id( $input, $length = 6 ){
        // Create a raw binary sha256 hash and base64 encode it.
        $hash_base64 = base64_encode( hash( 'sha256', $input, true ) );
        // Replace non-urlsafe chars to make the string urlsafe.
        $hash_urlsafe = strtr( $hash_base64, '+/', '-_' );
        // Trim base64 padding characters from the end.
        $hash_urlsafe = rtrim( $hash_urlsafe, '=' );
        // Shorten the string before returning.
        return substr( $hash_urlsafe, 0, $length );
    }

    public function refundRequest(User $user, Request $request) {

        $request->validate([
            'image_path' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:2048',
            'title' => 'required',
            'course' => 'required',
        ]);

        
        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->id . "/refunds" . "/" . $this->generate_id(Carbon::now()) . ".jpg",$request->file('image_path'));

        if ($image_path != false) {

            $statusOk = UserRequest::createUserRequest($user->id, $request->get('course'), $request->get('title'),$image_path);

            if ($statusOk) {

                return response()->json([
                    'message' => "Successfully Created Refund Request",
                ]);

            }

            return response()->json([
                'message' => "Failed to Create Refund Request",
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

    // my enrollment
    public function myEnrollments(User $user) {

        $enrollments = Enrollment::where('student_id',$user->id)->get()->sortbyDesc('created_at');

        foreach($enrollments as $enroll) {
            $enroll->title = Course::find($enroll->course_id)->title;
        }
        
        return $enrollments;
    }

    public function myRefunds(User $user) {

        $refunds = UserRequest::where('originator_id', $user->id)->get()->sortByDesc('created_at');

        return $refunds;
    }

    public function getReceipt(Enrollment $enrollment) {
        $enrollment->receipt;
        $enrollment->user = User::find($enrollment->student_id);
        $enrollment->course;
        return $enrollment;

    }

    public function getMyClass(User $user) {
        $myclass = StudentAttendance::where('student_id',$user->id)->where('has_attended',TRUE )->get();
        $mytimeslots =  [];
        foreach($myclass as $timeslot) {
            $timeslot->time = Timeslot::find($timeslot->timeslot_id)->datetime;
            $timeslot->title = Course::find(Timeslot::find($timeslot->timeslot_id)->course_id)->title;
            $timeslot->images = $timeslot->images;
            $mytimeslots[] = $timeslot;
        }

        return $mytimeslots;



    }

    // fix somchoke

    public function certificate(Course $course) {
        $course->last_date = $course->timeslots->sortByDesc('datetime')->first()->datetime;
        $course->teacher = User::find($course->teacher_id);
        return $course;
    }

    public function getMakeUpClasses(User $user) {
        return $user->getMakeUpClasses();
    }



    


}
