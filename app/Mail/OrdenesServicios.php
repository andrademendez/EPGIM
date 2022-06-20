<?php

namespace App\Mail;

use App\Models\Operaciones\OrdenesServicios as OperacionesOrdenesServicios;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdenesServicios extends Mailable
{
    use Queueable, SerializesModels;


    public $orden;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OperacionesOrdenesServicios $ordenes)
    {
        //
        $this->orden = $ordenes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.OrdenServicio')
            ->subject('Orden de servicios');
    }
}