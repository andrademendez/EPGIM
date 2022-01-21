<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Pending
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $comentario;

    public function __construct($email, $comentario)
    {
        //
        $this->email = $email;
        $this->comentario = $comentario;
    }
}