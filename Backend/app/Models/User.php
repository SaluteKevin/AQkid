<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Enums\CourseStatusEnum;
use App\Models\Enums\EnrollmentStatusEnum;
use App\Models\Enums\UserRoleEnum;
use App\Services\FileService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
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

    public function enrollments()
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
        return User::where('role', $userRole->name)->paginate(10);
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
     * Search User by Firstname
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


    //////////////////////////////////////// TEACHER ////////////////////////////////////////


    /**
     * query Teacher Courses
     */
    public static function queryTeacherWithCourses(User $user): User
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





    //////////////////////////////////////// STUDENT ////////////////////////////////////////

    public static function getStudentWithCourses(User $student): User {

        $enrollments = Enrollment::where('student_id', $student->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->get();

        $coursesArray = [];

        foreach ($enrollments as $enrollment) {

            $course = Course::find($enrollment->course_id);

            if ($course != null) {
                $coursesArray[] = $course;
            }
        }

        $student->courses = $coursesArray;

        return $student;

    }

    public static function queryStudentWithCoursesCount(Paginator $students): Paginator {


        foreach ($students as $student) {

            $count = 0;
            $enrollments = Enrollment::where('student_id', $student->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->get();

            foreach ($enrollments as $enrollment) {
                $course = Course::find($enrollment->course_id);

                if ($course != null && $course->status == CourseStatusEnum::ACTIVE->name) {
                    $count += 1;
                }
            }

            $student->courses_count = $count;

        }

        return $students;

    }

    public static function queryStudentWithCoursesCountFilter(string $type) {

        $students = User::select('users.*')
        ->leftJoin('enrollments', 'users.id', '=', 'enrollments.student_id')
        ->leftJoin('courses', 'enrollments.course_id', '=', 'courses.id')
        ->where('enrollments.status', EnrollmentStatusEnum::SUCCESS->name)
        ->where('courses.status', CourseStatusEnum::ACTIVE->name)
        ->groupBy('users.id')
        ->havingRaw('COUNT(courses.id) > 0')
        ->pluck('id');

        if ($type == 'active') {

            $filteredUsers = User::whereIn('id', $students)->paginate(10);

            foreach ($filteredUsers as $student) {

                $count = 0;
                $enrollments = Enrollment::where('student_id', $student->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->get();

                foreach ($enrollments as $enrollment) {
                    $course = Course::find($enrollment->course_id);

                    if ($course != null && $course->status == CourseStatusEnum::ACTIVE->name) {
                        $count += 1;
                    }
                }

                $student->courses_count = $count;

            }

            return $filteredUsers;

        }

        if ($type == 'inactive') {

            $usersNotInQuery = User::whereNotIn('id', $students)->where('role',UserRoleEnum::STUDENT->name)->paginate(10);

            foreach ($usersNotInQuery as $student) {

                $count = 0;
                $enrollments = Enrollment::where('student_id', $student->id)->where('status', EnrollmentStatusEnum::SUCCESS->name)->get();

                foreach ($enrollments as $enrollment) {
                    $course = Course::find($enrollment->course_id);

                    if ($course != null && $course->status == CourseStatusEnum::ACTIVE->name) {
                        $count += 1;
                    }
                }

                $student->courses_count = $count;

            }

            return $usersNotInQuery;


        }

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

        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->id . "/" ."profile_image.jpg",$imagefile);

        if ($image_path != false ) {

            $user->profile_image_path = $image_path;

            $statusOk = $user->save();

        }

        return $statusOk;
    }

    public static function updateUserInfo (User $user, string $firstname, string $middlename = null, string $lastname,
                                           string $birthdate, string $phone_number, string $email = null) {


        $statusOk = false;

        $user->first_name = $firstname;
        $user->middle_name = $middlename;
        $user->last_name = $lastname;
        $user->birthdate = $birthdate;
        $user->phone_number = $phone_number;
        $user->email = $email;


        $statusOk = $user->save();

        return $statusOk;

    }

    public static function changeProfileImage (User $user, UploadedFile $imagefile = null) {

        $statusOk = false;

        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->id . "/" ."profile_image.jpg",$imagefile);

        if ($image_path != false ){

            $user->profile_image_path = $image_path;

            $statusOk = $user->save();

        }

        return $statusOk;

    }

    public static function changeUserPassword (User $user, string $newpassword) {

        $statusOk = false;

        $user->password = $newpassword;

        $statusOk = $user->save();

        return $statusOk;

    }



}
