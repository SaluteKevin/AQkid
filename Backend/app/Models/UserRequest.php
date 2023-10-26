<?php

namespace App\Models;

use App\Models\Enums\UserRequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Enums\UserRequestTypeEnum;
use Illuminate\Contracts\Pagination\Paginator;

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
