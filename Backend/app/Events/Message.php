<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $channel_id;
    public $sender_id;
    public $message;
    public $has_read;
    public $created_at;
    public $updated_at;
    /**
     * Create a new event instance.
     */
    public function __construct($id, $channel_id, $sender_id,  $message, $has_read, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->channel_id = $channel_id;
        $this->sender_id = $sender_id;
        $this->message = $message;
        $this->has_read = $has_read;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        
        return ['chat' . $this->channel_id];
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
