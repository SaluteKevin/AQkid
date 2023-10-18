<?php

namespace App\Models;

use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\StudentAttendanceEnum;
use App\Models\Enums\TimeslotTypeEnum;
use App\Models\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeslot extends Model
{
    use HasFactory, SoftDeletes;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function studentAttendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_attendances', 'timeslot_id', 'student_id')->withPivot('has_attended');
    }

    public function teacherAttendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_attendances', 'timeslot_id', 'teacher_id');
    }

    public static function createTimeslot(int $courseId, int $dateTime, TimeslotTypeEnum $timeslotTypeEnum = TimeslotTypeEnum::UNDEFINED): bool
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

        return $timeslot->save();
    }

    public static function deleteTimeslot(int $timeslotId)
    {
        if (Timeslot::find($timeslotId)->studentAttendances()->where('has_attended', StudentAttendanceEnum::TRUE->name)->exists() != null) {
            error_log('Attempting to delete Timeslot already attended by Students');
            return false;
        }

        return Timeslot::find($timeslotId)->delete();
    }

    public function attachStudents(StudentAttendanceEnum $studentAttendanceEnum = StudentAttendanceEnum::FALSE, int ...$studentIds): bool
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

        $this->studentAttendances()->attach($studentIds, ['has_attended' => $studentAttendanceEnum->name]);
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

    public function updateAttendance(int $studentId, StudentAttendanceEnum $studentAttendance): bool
    {
        if ($this->studentAttendances()->find($studentId) == null) {
            error_log('Student \'' . $studentId . '\' has not been attached');
            return false;
        } else if ($this->studentAttendances()->find($studentId)->pivot->has_attended == $studentAttendance->name) {
            error_log('Attempting to change attendance to the same value');
            return false;
        }

            $this->studentAttendances()->updateExistingPivot($studentId, ['has_attended' => $studentAttendance->name]);

        return true;
    }
}
