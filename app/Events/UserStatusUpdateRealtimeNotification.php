<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatusUpdateRealtimeNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $id;
    public $authorize;
    public $created_at;



    public function __construct($id, $authorize, $created_at )
    {
        $this->id = $id;
        $this->authorize = $authorize;
        $this->created_at = $created_at;

    }
    public function broadcastOn()
    {
        return ['my-user-status-update-channel'];
    }

    public function broadcastAs()
    {
        return 'my-user-status-update-event';
    }
}
