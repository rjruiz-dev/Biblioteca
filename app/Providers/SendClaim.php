<?php

namespace App\Providers;

use App\Providers\LoanClamin;
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
     * @param  LoanClamin  $event
     * @return void
     */
    public function handle(LoanClamin $event)
    {
        Mail::to($event->user)->queue(
            new AlertClaim($event->user)
        );
    }
}
