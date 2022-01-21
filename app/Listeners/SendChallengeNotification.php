<?php

namespace App\Listeners;

use App\Events\Challenge;
use App\Mail\ChallengeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendChallengeNotification
{
    public function handle(Challenge $event)
    {
        Mail::to('jandrade@delking.mx')->send(
            new ChallengeNotification(
                $event->nombre,
                $event->correo,
                $event->mensaje
            )
        );
    }
}