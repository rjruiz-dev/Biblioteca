<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertReport extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $msj;

    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $msj, $subject)
    {
        $this->user = $user;

        $this->msj = $msj;

        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.alert-report')
        ->subject('Informe' . config('app.name'));

        
    }
}
