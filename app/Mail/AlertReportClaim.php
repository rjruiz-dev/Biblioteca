<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertReportClaim extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $prestamos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $prestamos)
    {
        $this->user = $user;

        $this->prestamos = $prestamos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.alert-report-claim')
        ->subject('Informe de reclamos' . config('app.name'));
    }
}
