<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FilePending extends Mailable
{
    use Queueable, SerializesModels;

    public $comentario;

    public function __construct($comentario)
    {
        //
        $this->comentario = $comentario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pending')->subject('Documentos requerida');
    }
}