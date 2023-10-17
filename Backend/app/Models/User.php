<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function enrollments(): HasMany {
        return $this->hasMany(Enrollment::class);
    }

    public function notis(): HasMany {
        return $this->hasMany(UserNoti::class);
    }

    public function studentAttendances(): BelongsToMany {
        return $this->belongsToMany(Timeslot::class, 'student_attendances', 'student_id', 'timeslot_id')->withPivot('has_attended');
    }

    public function teacherAttendances(): BelongsToMany {
        return $this->belongsToMany(Timeslot::class, 'teacher_attendances', 'teacher_id', 'timeslot_id');
    }

    /**
     * Get all the users in database with the specified role
     */
    public static function allWithRole(UserRoleEnum $userRole): Collection {
        return User::where('role', $userRole->name)->get();
    }

    /**
     * Checks whether a $user has the role $userRole
     * @param User $user the user
     * @param UserRoleEnum $userRole the user role to be checked
     * @return bool a boolean value indicating if $user has $userRole
     */
    public static function checkRole(User $user, UserRoleEnum $userRole): bool {
        return $userRole->name == $user->role;
    }

    // Overloading approach, not successfully implemented yet
    // function __call(string $funcName, array $arguments) {
    //     $result = false;
    //     $argc = count($arguments);

    //     switch ($funcName) {
    //         case 'isRole':
    //             if ($arguments[1] instanceof UserRoleEnum) {
    //                 $result = $this->role == $arguments[1]->name;
    //             }
    //             break;
    //         default:
    //             error_log('Method not found for signature', 0);
    //     }

    //     return $result;
    // }
}
