<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertRequests extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $mensaje)
    {
        $this->user = $user;

        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.alert-requests')
            ->subject('Estado de Solicitud de Asociamiento a ' . config('app.name'));
        
    }
}
