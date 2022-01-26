<?php

namespace App\Mail;

use App\Models\Campanias;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChallengeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $campania;

    public function __construct(Campanias $campania)
    {
        $this->campania = $campania;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send-create-challenge')
            ->with([
                'campaniaTitle' =>  $this->campania->title,
                'campaniaStart' => $this->dateFormato($this->campania->start),
                'campaniaEnd' => $this->dateFormato($this->campania->end),
                'userName' => $this->campania->user->name,
                'userEmail' => $this->campania->user->email,
            ])
            ->subject('Proceso de challenge iniciado');
    }

    public function dateFormato($fecha)
    {
        $date = new DateTime($fecha);
        $dateF = $date->format('Y-m-d');
        return $dateF;
    }
}