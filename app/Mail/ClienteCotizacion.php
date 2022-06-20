<?php

namespace App\Mail;

use App\Models\Campanias;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClienteCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    public $campanias;

    public function __construct(Campanias $campania)
    {
        $this->campanias = $campania;
    }

    public function build()
    {
        return $this->view('emails.cliente-cotizacion')
            ->subject('Cotización cliente')
            ->attach(base_path() . '/public' . $this->campanias->cotizacion->archivo);
    }
}