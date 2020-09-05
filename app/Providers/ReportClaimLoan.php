<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportClaimLoan
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $prestamos;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$prestamos)
    {
        $this->user = $user;

        $this->prestamos = $prestamos;
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