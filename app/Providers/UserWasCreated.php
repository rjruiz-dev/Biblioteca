<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;



    public $password;

    public $accion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $password, $accion)
    {
        $this->user = $user;

        $this->password
        
        
        
                
        
        
        = $password;

        $this->accion = $accion;
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
