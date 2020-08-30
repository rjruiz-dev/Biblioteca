<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VisitorRequestNotice extends Mailable
{
    use Queueable, SerializesModels;

    
    public $caso;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($caso)
    {
        $this->caso = $caso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.visitorRequestNotice')
            ->subject('Has solicitado asociarte a  ' . config('app.name'));
    }
}
