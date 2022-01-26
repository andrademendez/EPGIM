<?php

namespace App\Mail;

use App\Models\Campanias;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;

class NotificacionConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $campania;

    public function __construct(Campanias $campania)
    {
        //
        $this->campania = $campania;
    }


    public function build()
    {
        return $this->markdown('emails.notificar-confirmacion')
            ->with([
                'campaniaTitle' => $this->campania->title,
                'campaniaStart' => $this->dateFormato($this->campania->start),
                'campaniaEnd' => $this->dateFormato($this->campania->end),
            ])
            ->subject('Notificación de confirmacion');
    }
    public function dateFormato($fecha)
    {
        $date = new DateTime($fecha);
        $dateF = $date->format('d-m-Y');
        return $dateF;
    }
}