<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;



class StaffController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['allTeachers','getTeacher','createTeacher','searchTeacher','allStudents','getStudent','searchStudent']]);
    }

    public function generateTimeslot(Request $request) {

        // 1. สร้าง course ตามเวลา generic

        // 2. assign ครู

        // 3. จอง timeslot specific

    }

    /**
     * 
     *  course open 1 คาบ ไม่มี student (ควรจะปิด)
     */

     

    public function allEnrollmentRequests() {

        // return all enrollment requests

    }

    public function enrollmentRequestReview(Request $request) {

        // return specific enrollment request

    }

    public function addTimeslot() {

    }

    public function removeTimeslot() {
        
    }


    public function addStudentAttendance() {

        
    }

    public function removeStudentAttendance() {


    }
    
    // Student Page
    public function allStudents() {

        $students = User::where('role',"STUDENT")->paginate(5);

        return $students;

    }

    public function getStudent(User $user) {

        // $courses = Course::where('teacher_id',$user->id)->get();

        // $enrollments = $user->enrollments;
        return $user;

    }

    public function searchStudent(Request $request) {

        $search = $request->input('search');

        $students = User::where('role', 'STUDENT')
            ->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', '%' . $search . '%');
            })
            ->get();

        // foreach ($teachers as $teacher) {

        //     $courses = Course::where('teacher_id',$teacher->id)->count();
    
        //     $teacher->course_count = $courses;
    
        // }

        return $students;

    }

    





    // Teacher Page

    public function allTeachers() {

        $teachers = User::where('role',"TEACHER")->paginate(5);

        foreach ($teachers as $teacher) {

            $courses = Course::where('teacher_id',$teacher->id)->count();

            $teacher->course_count = $courses;

        }

        return $teachers;
        // return all Teachers

    }

    public function searchTeacher(Request $request) {

        $search = $request->input('search');

        $teachers = User::where('role', 'TEACHER')
            ->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', '%' . $search . '%');
            })
            ->get();

        foreach ($teachers as $teacher) {

            $courses = Course::where('teacher_id',$teacher->id)->count();
    
            $teacher->course_count = $courses;
    
        }

        return $teachers;

    }

    public function getTeacher(User $user) {

        $courses = Course::where('teacher_id',$user->id)->get();

        $user->courses = $courses;

        return $user;

    }

    public function createTeacher(Request $request) {

        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'birthdate' => 'required',
            'phone_number' => 'required',
            'email' => 'nullable',
        ]);

        $user = new User();
        $user->username = $request->get('username');
        $user->password = $request->get('password');
        $user->role = 'TEACHER';
        $user->first_name = $request->get('firstname');
        $user->middle_name = $request->get('middlename');
        $user->last_name = $request->get('lastname');
        $user->birthdate = $request->get('birthdate');
        $user->phone_number = $request->get('phone_number');
        $user->email = $request->get('email');

        $file = $request->file('profile_image_path');

        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->username . "/" ."profile.jpg",$file);

        if ( $image_path != false ) {

            $user->profile_image_path = $image_path;

            if ( $user->save() ) {

                return response()->json([
                    'message' => "Successfully created User",
                ]);

            }

            return response()->json([
                'message' => "Failed to create User",
            ],422);

        }

        $image_path = "default";
        $user->profile_image_path = $image_path;
        
        if ( $user->save() ) {

            return response()->json([
                'message' => "Successfully created User",
            ]);

        }

        return response()->json([
            'message' => "Failed to create User",
        ],422);
        
    }

}
