<?php

namespace App\Providers;

use App\Providers\ClaimLoan;
use App\Mail\AlertClaim;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClaim
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
     * @param  ClaimLoan  $event
     * @return void
     */
    public function handle(ClaimLoan $event)
    {
        //enviar email con las credenciales del login
        Mail::to($event->user)->queue(
            new AlertClaim($event->user, $event->prestamos, $event->modelo)
        );
    }
}
