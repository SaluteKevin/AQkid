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
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Enums\UserRoleEnum;
use App\Models\Timeslot;
use Illuminate\Pagination\LengthAwarePaginator;


class StaffController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['rejectEnrollment','acceptEnrollment','enrollmentRequestReview','allEnrollmentRequests','allTeachers','getTeacher','createTeacher','searchTeacher','allStudents','getStudent','searchStudent','getAllCourses','filterStudent','getCourse','allTimeslots']]);
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

    public function getAllCourses() {
        return Course::get();
    }


    public function getCourse(Course $course) {

        $courseWithAllTimeslots = Course::allTimeslotsWithAuthor($course);

        $courseWithAllTimeslots->enroll_count = Course::studentsIn($courseWithAllTimeslots->id)->count();
        
        return $courseWithAllTimeslots;
    }

    public function allTimeslots() {
        $timeslots = Timeslot::get();
        return $timeslots;
    }
     

    public function allEnrollmentRequests() {

        $enrollments = Enrollment::enrollmentsWithStatus(EnrollmentStatusEnum::PENDING);
        
        $enrollmentsWithUser = Enrollment::getEnrollmentWithUserPaginate($enrollments);
        
        return $enrollmentsWithUser;

    }

    public function enrollmentRequestReview(Enrollment $enrollment) {
        $enrollment = Enrollment::getEnrollmentWithUser($enrollment);
        return $enrollment;
        // return specific enrollment request

    }

    public function acceptEnrollment(Enrollment $enrollment) {
        $enrollment->updateStatus(EnrollmentStatusEnum::SUCCESS,"none");
    }
    public function rejectEnrollment(Enrollment $enrollment) {
        $enrollment->updateStatus(EnrollmentStatusEnum::FAILED,"none");
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

        $students = User::allWithRolePaginate(UserRoleEnum::STUDENT);

        $studentsWithCoursesCount = User::queryStudentWithCoursesCount($students);

        return $studentsWithCoursesCount;
        
    }

    public function filterStudent(Request $request) {

        if ($request->get('filter') == 'active') {

            $students = User::allWithRole(UserRoleEnum::STUDENT);

            $activeStudents = User::queryStudentWithCoursesCountFilter($students, 'active');

            return $activeStudents;


        }

        else if ($request->get('filter') == 'inactive') {

            $students = User::allWithRole(UserRoleEnum::STUDENT);

            $inactiveStudents = User::queryStudentWithCoursesCountFilter($students, 'inactive');

            return $inactiveStudents;


        }

    }

    public function getStudent(User $user) {

        // implement enrollments futhermore
        $userWithCourses = User::getStudentWithCourses($user);

        return $userWithCourses;

    }

    public function searchStudent(Request $request) {

        $search = $request->input('search');

        $students = User::searchUser($search, UserRoleEnum::STUDENT);

        return $students;

    }


    // Teacher Page

    public function allTeachers() {

        $teachers = User::allWithRolePaginate(UserRoleEnum::TEACHER);

        $teachersWithCourses = User::queryWithCoursesCountPaginate($teachers);

        return $teachersWithCourses;
        // return all Teachers

    }

    public function searchTeacher(Request $request) {

        $search = $request->input('search');

        $teachers = User::searchUser($search, UserRoleEnum::TEACHER);

        $teachersWithCourses = User::queryWithCoursesCountCollection($teachers);

        return $teachersWithCourses;

    }

    public function getTeacher(User $user) {

        return User::queryTeacherWithCourses($user);

    }

    public function createTeacher(Request $request) {

        $request->validate([
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'birthdate' => 'required',
            'phone_number' => 'required',
            'email' => 'nullable',
            'profile_image_path' => 'nullable|image|mimes:png,gif,jpg,jpeg,bmp|max:2048'
        ]);
        
        $statusOk = User::createUser($request->get('username'), $request->get('password'), UserRoleEnum::TEACHER,
                                     $request->get('firstname'), $request->get('middlename'), $request->get('lastname'),
                                     $request->get('birthdate'), $request->get('phone_number'), $request->get('email'),
                                     $request->file('profile_image_path'));

        

        if ( $statusOk != false ) {

            return response()->json([
                'message' => "Successfully created User",
            ]);

        }

        return response()->json([
            'message' => "Failed to create User",
        ],422);

        
    }

}
