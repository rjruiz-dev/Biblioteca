<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertClaim extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $prestamos;

    public $modelo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $prestamos, $modelo)
    {
        $this->user = $user;

        $this->prestamos = $prestamos;

        $this->modelo = $modelo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.alert-claim')
        ->subject('Tus reclamos pendientes' . config('app.name'));
    }
}
