<?php

namespace App\Models;

use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\StudentAttendanceEnum;
use App\Models\Enums\TimeslotTypeEnum;
use App\Models\Enums\UserRoleEnum;
use App\Models\Enums\EnrollmentStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Timeslot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['course_id','datetime','type','created_at','updated_at'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function studentAttendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_attendances', 'timeslot_id', 'student_id')->withPivot('has_attended','review_comment','course_joint_id');
    }

    public function teacherAttendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_attendances', 'timeslot_id', 'teacher_id');
    }

    public static function createTimeslot(int $courseId, int $dateTime, TimeslotTypeEnum $timeslotTypeEnum = TimeslotTypeEnum::UNDEFINED)
    {
        if (Timeslot::where('datetime', date(env('APP_DATETIME_FORMAT'), $dateTime))->exists()) {
            error_log('Timeslot has been taken');
            return false;
        }

        if (!Course::where('id', $courseId)->exists()) {
            error_log('Course \'' . $courseId . '\' not found');
            return false;
        }

        switch (Course::find($courseId)->status) {
            case CourseStatusEnum::ENDED->name:
            case CourseStatusEnum::CANCELLED->name:
                error_log('Attempting to update status on inactive course');
                return false;
            case CourseStatusEnum::PENDING->name:
            case CourseStatusEnum::OPEN->name:
            case CourseStatusEnum::FULL->name:
            case CourseStatusEnum::ACTIVE->name:
                break;
            default:
                error_log('Unknown error occured while attempting to update course status');
                return false;
        }

        $timeslot = new Timeslot();
        $timeslot->course_id = $courseId;
        $timeslot->datetime = date(env('APP_DATETIME_FORMAT'), $dateTime);
        $timeslot->type = $timeslotTypeEnum->name;

        if ($timeslot->save()) {
            return $timeslot->id;
        }
        return false;
    }

    public static function deleteTimeslot(int $timeslotId)
    {
        if (Timeslot::find($timeslotId)->studentAttendances()->where('has_attended', StudentAttendanceEnum::TRUE->name)->exists() != null) {
            error_log('Attempting to delete Timeslot already attended by Students');
            return false;
        }

        return Timeslot::find($timeslotId)->delete();
    }

    public function attachStudents(StudentAttendanceEnum $studentAttendanceEnum = StudentAttendanceEnum::FALSE,  int $course_joint_Id = null, int ...$studentIds): bool
    {
        foreach ($studentIds as $studentId) {
            if (
                ($student = User::find($studentId)) == null
                || $student->role != UserRoleEnum::STUDENT->name
            ) {
                error_log('Invalid argument Student \'' . $studentId . '\', no students attached');
                return false;
            }
        }

        $this->studentAttendances()->attach($studentIds, ['has_attended' => $studentAttendanceEnum->name, 'course_joint_id'=> $course_joint_Id]);
        return true;
    }

    public function detachStudents(int ...$studentIds): bool
    {
        foreach ($studentIds as $studentId) {
            if (!$this->studentAttendances()->where('student_id', $studentId)->exists()) {
                error_log('Student \'' . $studentId . '\' has not been attached, no students detached');
                return false;
            }
        }

        $this->studentAttendances()->detach($studentIds);
        return true;
    }

    public function updateAttendance(int $studentId, StudentAttendanceEnum $studentAttendance, int $courseId)
    {
        if ($this->studentAttendances()->find($studentId) == null) {
            error_log('Student \'' . $studentId . '\' has not been attached');
            return false;
        } else if ($this->studentAttendances()->find($studentId)->pivot->has_attended == $studentAttendance->name) {
            error_log('Attempting to change attendance to the same value');
            return false;
        } else if ($studentAttendance == StudentAttendanceEnum::TRUE && User::find($studentId)->remainingQuota($courseId) < 1) {
            error_log('Attempting to change attendance for a student who is out of quota');
            return StudentAttendanceEnum::QUOTA;
        }

            $this->studentAttendances()->updateExistingPivot($studentId, ['has_attended' => $studentAttendance->name]);

        return true;
    }

    public static function getTimeslotStudents(Timeslot $timeslot) {

        $studentsId = $timeslot->studentAttendances->pluck('id');


        $makeupStudents = User::whereNotIn('id',$studentsId)->where('role', UserRoleEnum::STUDENT->name)->get();

        $makeupStudents = $makeupStudents->filter(function ($user) {
            return $user->studentQuota() > 0;
        });

        $studentIn = User::whereIn('id',$studentsId)->get();

        $mergeStudents = $makeupStudents->concat($studentIn);

        $mergeStudents->each(function ($student) use ($studentsId) {
            $student->expect = in_array($student->id, $studentsId->toArray());
        });

        return $mergeStudents;

    }


    public static function queryTimeslotCourseTitle(Collection $timeslots) {

        foreach ($timeslots as $timeslot) {

            $timeslot->title = Course::find($timeslot->course_id)->title;

        }

        return $timeslots;

    }

    public static function getStudentClasses(User $user) {

        // $classes = Timeslot::whereIn(
        //     'course_id',
        //     Course::whereIn('id', Enrollment::where('student_id', $user->id)
        //         ->where('status', EnrollmentStatusEnum::SUCCESS->name)
        //         ->pluck('course_id'))
        //     ->where('status', CourseStatusEnum::ACTIVE->name)
        //     ->pluck('id')
        // )->where('datetime', '>=', Carbon::now())
        // ->get()->sortby('datetime');

        $classes = $user->studentAttendances->where('datetime', '>=', Carbon::now())->where('pivot.has_attended',StudentAttendanceEnum::FALSE->name);
        
        foreach($classes as $class) {
            $class->title = Course::find($class->course_id)->title;
            $class->duration = Course::find($class->course_id)->duration;
        }

        return $classes;

    }

    public static function addStudentTimeslots(int $courseId, int $studentId) {

        try {
            
            $course = Course::find($courseId);
            $student = User::find($studentId);

            foreach($course->timeslots as $timeslot) {

                $timeslot->studentAttendances()->attach($student, ['has_attended' => 'FALSE']);
            }


            return true;

        } catch (\Exception $e) {
            
            return false;
        }
    

    }

    public function updateReview(int $studentId, string $reviewText): bool
    {
        if ($this->studentAttendances()->find($studentId) == null) {
            error_log('Student \'' . $studentId . '\' has not been attached');
            return false;
        }

            $this->studentAttendances()->updateExistingPivot($studentId, ['review_comment' => $reviewText]);

        return true;
    }

}
