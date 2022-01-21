<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChallengeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $nombre;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->view('view.name')->subject('Notificación de cambio de estatus de campaña');
    }
}