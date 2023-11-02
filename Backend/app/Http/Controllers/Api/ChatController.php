<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Message;
use App\Events\MyEvent;
use App\Models\ChatMessage;
use App\Models\Enums\ChatMessageStatusEnum;
use App\Models\User;


class ChatController extends Controller
{

     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getStaffChannels','messageStaff','fetchChatStaff','messageStudent','fetchChatStudent','fetchChatStudent']]);
    }

    // staff side
    public function getStaffChannels() {

        return ChatMessage::getStaffChannels();

    }

    public function fetchChatStaff(int $channel) {

        $chats = ChatMessage::where('channel_id', $channel)->get()->sortByDesc('created_at');

        $chats->each(function ($chat) {
            
            $chat->has_read = ChatMessageStatusEnum::TRUE->name;
            $chat->save();
            
        });

        event(new MyEvent());

        return $chats;

    }

    public function messageStaff(Request $request){
        
        $chat = New ChatMessage();
        $chat->channel_id = $request->get('channel_id');
        $chat->sender_id = $request->get('sender_id');
        $chat->message = $request->get('message');
        $chat->has_read = ChatMessageStatusEnum::TRUE->name;

        if ($chat->save()) {
            
            event(new Message($chat->id, $chat->channel_id, $chat->sender_id, $chat->message, $chat->has_read, $chat->created_at, $chat->updated_at));

            event(new MyEvent());

            return response()->json([
                'message' => "Message has been sent",
            ]);

        }

        return response()->json([
            'message' => "Message has not been sent",
        ]);

    }

    // student side

    public function messageStudent(Request $request){
        
        $chat = New ChatMessage();
        $chat->channel_id = $request->get('id');
        $chat->sender_id = $request->get('id');
        $chat->message = $request->get('message');

        if ($chat->save()) {
            
            event(new Message($chat->id, $chat->channel_id, $chat->sender_id, $chat->message, $chat->has_read, $chat->created_at, $chat->updated_at));

            event(new MyEvent());

            return response()->json([
                'message' => "Message has been sent",
            ]);

        }

        return response()->json([
            'message' => "Message has not been sent",
        ]);

    }

    public function fetchChatStudent(int $channel) {

        $chats = ChatMessage::where('channel_id', $channel)->get()->sortByDesc('created_at');

        return $chats;

    }
}