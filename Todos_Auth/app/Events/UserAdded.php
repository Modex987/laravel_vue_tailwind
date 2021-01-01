<?php

namespace App\Events;

use Illuminate\Http\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contact_data;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $contact_data, $user_id)
    {
        $this->contact_data = $contact_data;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}