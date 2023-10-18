<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Enums\UserRoleEnum;
use DateTime;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use App\Services\FileService;
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

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function notis(): HasMany
    {
        return $this->hasMany(UserNoti::class);
    }

    public function studentAttendances(): BelongsToMany
    {
        return $this->belongsToMany(Timeslot::class, 'student_attendances', 'student_id', 'timeslot_id')->withPivot('has_attended');
    }

    public function teacherAttendances(): BelongsToMany
    {
        return $this->belongsToMany(Timeslot::class, 'teacher_attendances', 'teacher_id', 'timeslot_id');
    }

    /**
     * Get all the users in database with the specified role
     */
    public static function allWithRole(UserRoleEnum $userRole): Collection
    {
        return User::where('role', $userRole->name)->get();
    }

    /**
     * Get all the users in database with the specified role
     */
    public static function allWithRolePaginate(UserRoleEnum $userRole): Paginator
    {
        return User::where('role', $userRole->name)->paginate(5);
    }

    /**
     * Checks whether a $user has the role $userRole
     * @param User $user the user
     * @param UserRoleEnum $userRole the user role to be checked
     * @return bool a boolean value indicating if $user has $userRole
     */
    public static function checkRole(User $user, UserRoleEnum $userRole): bool
    {
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

    /**
     * Search Teacher by Firstname
     * 
     * @return collection
     */
    public static function searchUser(string $search, UserRoleEnum $userRole): Collection
    {

        return User::where('role', $userRole->name)
            ->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', '%' . $search . '%');
            })
            ->get();
    }

    /**
     * query Teacher Courses
     */
    public static function getTeacherWithCourses(User $user): User
    {

        $courses = Course::where('teacher_id', $user->id)->get();

        $user->courses = $courses;

        return $user;
    }

    /**
     * Take Collection of Teacher and queryCourseCount then return Collection Type
     */

    public static function queryWithCoursesCountCollection(Collection $teachers): Collection
    {

        foreach ($teachers as $teacher) {

            $courses = Course::where('teacher_id', $teacher->id)->count();

            $teacher->course_count = $courses;
        }

        return $teachers;
    }

    /**
     * Take Collection of Teacher and queryCourseCount then return Paginator Type
     */
    public static function queryWithCoursesCountPaginate(Paginator $teachers): Paginator
    {

        foreach ($teachers as $teacher) {

            $courses = Course::where('teacher_id', $teacher->id)->count();

            $teacher->course_count = $courses;
        }

        return $teachers;
    }


    /**
     * 
     * Create User ['STAFF','STUDENT']
     */
    public static function createUser(string $username, string $password, UserRoleEnum $userRole,
                                      string $firstname, string $middlename = null , string $lastname,
                                      string $birthdate, string $phone_number, string $email = null,
                                      UploadedFile $imagefile = null): bool {

        $statusOk = false;

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->role = $userRole->name;
        $user->first_name = $firstname;
        $user->middle_name = $middlename;
        $user->last_name = $lastname;
        $user->birthdate = $birthdate;
        $user->phone_number = $phone_number;
        $user->email = $email;
        $user->profile_image_path = "DEFAULT";

        $statusOk = $user->save();

        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->id . "/" ."profile.jpg",$imagefile);

        if ($image_path != false ) {

            $user->profile_image_path = $image_path;

            $statusOk = $user->save();

        }

        return $statusOk;
    }
}
