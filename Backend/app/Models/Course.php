<?php

namespace App\Models;

use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function timeslots(): HasMany
    {
        return $this->hasMany(Timeslot::class);
    }

    public static function createCourse(array $courseAttributes): bool
    {
        if (!User::where('id', $courseAttributes['teacher_id'])->exists()) {
            error_log('Teacher \'' . $courseAttributes['teacher_id'] . '\' not found');
            return false;
        } else if (User::find($courseAttributes['teacher_id'])->role != UserRoleEnum::TEACHER->name) {
            error_log('User must be a teacher');
            return false;
        }

        $course = new Course();
        $course->teacher_id = $courseAttributes['teacher_id'];
        $course->title = $courseAttributes['title'];
        $course->description = $courseAttributes['description'];
        $course->quota = $courseAttributes['quota'];
        $course->capacity = $courseAttributes['capacity'];
        $course->min_age = $courseAttributes['min_age'] == null ? 0 : $courseAttributes['min_age'];
        $course->max_age = $courseAttributes['max_age'];
        $course->duration = $courseAttributes['duration'] == null ? 60 : $courseAttributes['duration'];
        $course->opens_on = date(env('APP_DATETIME_FORMAT'), $courseAttributes['opens_on']);
        $course->opens_until = date(env('APP_DATETIME_FORMAT'), $courseAttributes['opens_until']);
        $course->starts_on = date(env('APP_DATETIME_FORMAT'), $courseAttributes['starts_on']);
        $course->status = $courseAttributes['status'] == null ? CourseStatusEnum::PENDING->name : $courseAttributes['status']->name;
        $course->price = $courseAttributes['price'];

        return $course->save();
    }

    /**
     * A App\Models\Enrollment::studentsIn wrapper
     */
    public static function studentsIn(int $courseId, EnrollmentStatusEnum $enrollmentStatus = EnrollmentStatusEnum::SUCCESS): Collection
    {
        return Enrollment::studentsIn($courseId, $enrollmentStatus);
    }

    /**
     * Count available spots in a course
     * @return int If the course is currently not OPEN for more students, -1 is returned.
     */
    public static function availableSpotCount(int $courseId): int
    {
        $course = Course::find($courseId);

        if ($course->status != CourseStatusEnum::OPEN)
            return -1;

        return Course::find($courseId)->capacity - Course::studentsIn($courseId)->count();
    }
}
