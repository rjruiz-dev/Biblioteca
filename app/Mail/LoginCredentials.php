<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $password;

    public $accion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $accion)
    {
        $this->user = $user;

        $this->password = $password;

        $this->accion = $accion;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.login-credentials')
            ->subject('Tus credenciales de acceso a ' . config('app.name'));
    }
}
