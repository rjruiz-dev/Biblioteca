<?php

namespace App\Providers;

use App\Providers\Requests;
use App\Mail\AlertRequests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequests
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Requests  $event
     * @return void
     */
    public function handle(Requests $event)
    {
        //enviar email de asociamiento
        Mail::to($event->user)->queue(
            new AlertRequests($event->user, $event->mensaje)
        );
    }
}
