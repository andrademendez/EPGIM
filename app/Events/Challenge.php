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

class Challenge
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $start;
    public $end;
    public $userEmail;
    public $userName;

    public function __construct(Campanias $campania)
    {
        //
        $this->title = $campania->title;
        $this->start = $campania->start;
        $this->end = $campania->end;
        $this->userEmail = $campania->user->email;
        $this->userName = $campania->user->name;
    }
}