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
use App\Models\Image;
use App\Models\StudentAttendance;
use App\Models\Timeslot;
use Illuminate\Support\Facades\Storage;

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
        'getTeacherCourses','checkAll']]);
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

    public function checkAll(Timeslot $timeslot) {
        
        $students = $timeslot->studentAttendances;
        $errors = [];
        foreach($students as $student) {
            $courseId = $timeslot->course_id;

            if ($student->pivot->course_joint_id != null) {
                $courseId = $student->pivot->course_joint_id;
            }

            $statusOk = $timeslot->updateAttendance($student->id, StudentAttendanceEnum::TRUE, $courseId);
            if ($statusOk == StudentAttendanceEnum::QUOTA){
                array_push($errors, 'Student '. User::find($student->id)->first_name .' '. User::find($student->id)->last_name .  ' is out of quota');
            }
        }

        return response()->json([
            'message' => "Successfully Check All Student",
            'errors' => $errors,
        ]);

    }

    public function studentAttend(Timeslot $timeslot, User $student) {
        $courseId = $timeslot->course_id;

        foreach($timeslot->studentAttendances->where('pivot.student_id',$student->id) as $student) {
            if ($student->pivot->course_joint_id != null ){
                $courseId = $student->pivot->course_joint_id;
                
            }
        }
        // if ($timeslot->studentAttendances->where('pivot.student_id',$student->id)->pivot->course_joint_id != null) {
        //     $courseId = $timeslot->studentAttendances->where('pivot.student_id',$student->id)->pivot->course_joint_id;
        // }

        if ($timeslot->updateAttendance($student->id, StudentAttendanceEnum::TRUE, $courseId) == StudentAttendanceEnum::QUOTA) {
            return response()->json([
                'message' => 'Student '. User::find($student->id)->first_name .' '. User::find($student->id)->last_name .  ' is out of quota',
            ],422);
        }

        if ($timeslot->updateAttendance($student->id, StudentAttendanceEnum::TRUE, $courseId)) {

            return response()->json([
                'message' => "Successfully Attend Student",
            ]);

        }

        return response()->json([
            'message' => "Attempting to change attendance for a student who is out of quota",
        ],422);
    }

    public function studentAbsent(Timeslot $timeslot, User $student) {

        $courseId = $timeslot->course_id;

        if ($timeslot->updateAttendance($student->id, StudentAttendanceEnum::FALSE, $courseId)) {

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

    public function studentReviewImages(Timeslot $timeslot, User $student, Request $request) {
        
        if ($request->hasFile('images') && StudentAttendance::where('timeslot_id',$timeslot->id)->where('student_id',$student->id)->get()[0]){
            $images = $request->file('images');

            foreach (StudentAttendance::where('timeslot_id',$timeslot->id)->where('student_id',$student->id)->get()[0]->images as $image) {
                $imagePath = $image->path;
                Storage::disk('public')->delete($imagePath);
                StudentAttendance::where('timeslot_id',$timeslot->id)->where('student_id',$student->id)->get()[0]->images()->delete();
            }

            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $imageName = now()->format('YmdHis') . '-' . $imageName;
                $imagePath = 'uploadReviews/' . $imageName;

                $path = Storage::disk('public')->put($imagePath, file_get_contents($image));
                // $path = Storage::disk('public')->url($path);
                

                
                $image = new Image();
                $image->path = $imagePath;
                $image->student_attendance_id = StudentAttendance::where('timeslot_id',$timeslot->id)->where('student_id',$student->id)->get()[0]->id;
                $image->save();
                
            }
            return StudentAttendance::where('timeslot_id',$timeslot->id)->where('student_id',$student->id)->get()[0]->images;
        }
        return response()->json([
            'message' => "Failed to Review Images Student",
        ],422);


    }



}
