<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['channel_id','sender_id','message']; 

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
    
    public static function getStaffChannels() {

        $uniqueSenderIds = ChatMessage::where('sender_id', '!=', 1)->distinct()->pluck('sender_id');

        $users = User::whereIn('id', $uniqueSenderIds)->get();

        $users->each(function ($user) {
            
            $user->last_message = ChatMessage::where('channel_id',$user->id)->get()->sortByDesc('created_at')->first();

        });

        return $users;
    }
}