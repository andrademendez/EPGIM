<?php

namespace App\Notifications;

use App\Models\Operaciones\OrdenesServicios;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidacionOrdenServicio extends Notification
{
    use Queueable;

    public $orden;

    public function __construct(OrdenesServicios $orden)
    {
        $this->orden = $orden;
    }


    public function via($notifiable)
    {
        return ['mail', 'database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Orden de servicio')
            ->greeting('Hola, ' . $this->orden->campania->user->name)
            ->line('Tu orden de servicio ha sido validado por el administrador. Puedes ver los cambios en la plataforma')
            ->action('Ir a EPGIM', url('https://ep.grupogim.com.mx/ordenes'))
            ->line('Administrador: ' . $this->orden->validacion->comentarios);
    }
}