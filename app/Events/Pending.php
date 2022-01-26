<?php

namespace App\Events;

use App\Models\Campanias;
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

    public $campania;
    public $comentario;

    public function __construct(Campanias $campania, $comentario)
    {
        //
        $this->campania = $campania;
        $this->comentario = $comentario;
    }
}