<?php

namespace App\Managers;

use App\Models\EventAnnouncement;
use App\Models\UserNoti;
use Carbon\Carbon;
use Illuminate\Http\Request;


class NotifyManager {

    public function __construct() {}

    public function userNoti(int $userid, string $type, string $name, string $description) {

        $noti = new UserNoti();
        $noti->user_id = $userid;
        $noti->type = $type;
        $noti->name = $name;
        $noti->description = $description;
        $noti->save();

    }

    public function readNoti(Request $request) {

        $notify = UserNoti::find((int) $request->get('data')['notify_id']);
        $notify->read_at = Carbon::now();
        $notify->save();

    }

    public function removeNotify(Request $request) {
        
        $notify = UserNoti::find((int) $request->get('data')['notify_id']);
        
        if ($notify->delete()) {
            return true;
        }
        return false;
    }


    


}