<?php

namespace App\Models;

use App\Models\Enums\UserRequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Enums\UserRequestTypeEnum;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;

class UserRequest extends Model
{
    use HasFactory;

    public function originator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public static function createUserRequest(int $originatorId, int $courseId, string $title, 
                                             string $imagePath) {
        
        $statusOk = false;

        $userRequest = new UserRequest();
        $userRequest->originator_id = $originatorId;

        $courseIdinput = $courseId;

        if (Course::find($courseId) == null) {
            $courseIdinput = null;
        }

        $userRequest->course_id = $courseIdinput;
        $userRequest->type = UserRequestTypeEnum::REFUND->name;
        $userRequest->title = $title;
        $userRequest->description = $imagePath;
        $userRequest->status = UserRequestStatusEnum::PENDING->name;
        $userRequest->review_comment = null;

        $statusOk = $userRequest->save();

        return $statusOk;

    }

    public static function createJoinClass(int $originatorId, int $courseId, string $title, int $timeslotId) {

        $statusOk = false;

        $userRequest = new UserRequest();
        $userRequest->originator_id = $originatorId;
        $userRequest->course_id = $courseId;
        $userRequest->type = UserRequestTypeEnum::GENERAL->name;
        $userRequest->title = $title;
        $userRequest->description = "Submitted for general";
        $userRequest->status = UserRequestStatusEnum::PENDING->name;
        $userRequest->review_comment = null;
        $userRequest->timeslot_id = $timeslotId;

        $statusOk = $userRequest->save();

        return $statusOk;

    }

    public static function createMakeUpClass(int $originatorId, int $courseId, string $title, string $datetime) {

        $statusOk = false;

        $userRequest = new UserRequest();
        $userRequest->originator_id = $originatorId;
        $userRequest->course_id = $courseId;
        $userRequest->type = UserRequestTypeEnum::GENERAL->name;
        $userRequest->title = $title;
        $userRequest->description = "Submitted for general";
        $userRequest->status = UserRequestStatusEnum::PENDING->name;
        $userRequest->review_comment = null;
        $userRequest->datetime = $datetime;

        $statusOk = $userRequest->save();

        return $statusOk;

    }

    public static function getUserRequestWithUser(UserRequest $userRequest): UserRequest
    {
        $user = User::find($userRequest->originator_id);
        $userRequest->user = $user;

        return $userRequest;
    }

    // refund
    public static function getUserRequestsWithUserPaginate(Paginator $userRequests): Paginator
    {

        foreach ($userRequests as $userRequest) {

            $user = User::find($userRequest->originator_id);

            $userRequest->user = $user;
        }

        return $userRequests;

    }

    public static function getUserRequests(): Paginator 
    {
        $userRequests = UserRequest::where('type',UserRequestTypeEnum::REFUND->name)->where('status',UserRequestStatusEnum::PENDING->name)->orderBy('created_at', 'desc')->paginate(5);

        return $userRequests;

    }

    public static function getUserRequestHistories(): Paginator 
    {
        $userRequestsId = UserRequest::where('type',UserRequestTypeEnum::REFUND->name)->where('status',UserRequestStatusEnum::PENDING->name)->pluck('id');

        $userRequestsNotInQuery = UserRequest::where('type',UserRequestTypeEnum::REFUND->name)->whereNotIn('id', $userRequestsId)->orderBy('created_at', 'desc')->paginate(5);

        return $userRequestsNotInQuery;

    }

    // makeup
    public static function getMakeupWithUser(UserRequest $userRequest): UserRequest
    {
        $user = User::find($userRequest->originator_id);
        $userRequest->user = $user;

        if ($userRequest->timeslot_id != null) {
            $userRequest->datetime = Timeslot::find($userRequest->timeslot_id)->datetime;
        }
        

        return $userRequest;
    }

    public static function getMakeupWithUserPaginate(Paginator $userRequests): Paginator
    {

        foreach ($userRequests as $userRequest) {

            $user = User::find($userRequest->originator_id);

            $userRequest->user = $user;
        }

        return $userRequests;

    }

    public static function getMakeup(): Paginator 
    {
        $userRequests = UserRequest::where('type',UserRequestTypeEnum::GENERAL->name)->where('status',UserRequestStatusEnum::PENDING->name)->orderBy('created_at', 'desc')->paginate(5);

        return $userRequests;

    }

    public static function getMakeupHistories(): Paginator 
    {
        $userRequestsId = UserRequest::where('type',UserRequestTypeEnum::GENERAL->name)->where('status',UserRequestStatusEnum::PENDING->name)->pluck('id');

        $userRequestsNotInQuery = UserRequest::where('type',UserRequestTypeEnum::GENERAL->name)->whereNotIn('id', $userRequestsId)->orderBy('created_at', 'desc')->paginate(5);

        return $userRequestsNotInQuery;

    }

    public function updateStatus(UserRequestStatusEnum $userRequestStatusEnum, string $reviewComment = null): bool
    {
        if ($this->status == $userRequestStatusEnum->name) {
            error_log('Error attempting to change with same status');
            return false;
        } else if (
            $userRequestStatusEnum == UserRequestStatusEnum::REJECTED
            && $reviewComment == null
        ) {
            error_log('Comments required for request rejection');
            return false;
        }

        $statusOk = false;

        $this->status = $userRequestStatusEnum->name;
        $this->review_comment = $reviewComment;

        $statusOk = $this->save();

        return $statusOk;
    }
}
