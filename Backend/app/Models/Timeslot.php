<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeslot extends Model
{
    use HasFactory;

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function student_attendances(): BelongsToMany {
        return $this->belongsToMany(User::class, 'student_attendances', 'timeslot_id', 'student_id')->withPivot('has_attended');
    }

    public function teacher_attendances(): BelongsToMany {
        return $this->belongsToMany(User::class, 'teacher_attendances', 'timeslot_id', 'teacher_id');
    }
}
