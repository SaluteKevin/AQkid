<?php

namespace App\Models;

use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\EnrollmentStatusEnum;
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
    public static function availableSpotCount(int $courseId): int {
        $course = Course::find($courseId);

        if ($course->status != CourseStatusEnum::OPEN)
            return -1;

        return Course::find($courseId)->capacity - Course::studentsIn($courseId)->count();
    }
}
