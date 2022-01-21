<?php

namespace App\Mail;

use App\Models\Campanias;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;

class NotificarAdministrador extends Mailable
{
    use Queueable, SerializesModels;

    public $campania;
    public $action;

    public function __construct(Campanias $campania)
    {
        //
        $this->campania = $campania;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificar-administrador')
            ->with([
                'campaniaTitle' =>  $this->campania->title,
                'campaniaStart' => $this->dateFormato($this->campania->start),
                'campaniaEnd' => $this->dateFormato($this->campania->end),
                'campaniaUser' => $this->campania->user->name,
                'campaniaCliente' => $this->campania->cliente->nombre,
            ])
            ->subject('Nueva campaña por revisar');
    }

    public function dateFormato($fecha)
    {
        $date = new DateTime($fecha);
        $dateF = $date->format('Y-m-d');
        return $dateF;
    }
}