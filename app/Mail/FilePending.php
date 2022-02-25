<?php

namespace App\Mail;

use App\Models\Campanias;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;

class FilePending extends Mailable
{
    use Queueable, SerializesModels;

    public $comentario;
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
        return $this->markdown('emails.pending')
            ->with([
                'campaniaTitle' => $this->campania->title,
                'campaniaStart' => $this->campania->start,
                'campaniaEnd' => $this->campania->end,
                'campaniaProcess' => $this->campania->process,
                'comment' => $this->campania->comment,
            ])
            ->subject('Documentos pendientes');
    }

    public function dateFormato($fecha)
    {
        $date = new DateTime($fecha);
        $dateF = $date->format('Y-m-d');
        return $dateF;
    }
}