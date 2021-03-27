<?php

namespace App\Providers;

use App\Providers\LibraryReport;
use App\Mail\AlertReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReport
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
     * @param  LibraryReport  $event
     * @return void
     */
    public function handle(LibraryReport $event)
    {
         //enviar email de status
         Mail::to($event->user)->queue(
            new AlertReport($event->user,  $event->msj, $event->subject)
        );
    }
}
