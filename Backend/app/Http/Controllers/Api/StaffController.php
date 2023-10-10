<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class StaffController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
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
    
    public function allTeachers() {

        // return all Teachers

    }

    public function createTeacher(Request $request) {

        // create Teacher

    }

    public function allStudents() {

        // return all Students

    }


}
