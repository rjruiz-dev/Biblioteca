<?php

namespace App\Providers;

use App\Providers\ReportClaimLoan;
use App\Mail\AlertReportClaim;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReportClaim
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
     * @param  ReportClaimLoan  $event
     * @return void
     */
    public function handle(ReportClaimLoan $event)
    {
         //enviar email con las credenciales del login
         Mail::to($event->user)->queue(
            new AlertReportClaim($event->user, $event->prestamos)
        );
    }
}
