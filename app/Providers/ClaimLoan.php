<?php

namespace App\Providers;
 
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClaimLoan
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $prestamos;

    public $modelo;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$prestamos, $modelo) 
    {
        $this->user = $user;

        $this->prestamos = $prestamos;

        $this->modelo = $modelo;
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
