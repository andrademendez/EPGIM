<?php

namespace App\Listeners;

use App\Events\Pending;
use App\Mail\FilePending;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPendingNotification
{

    public function handle(Pending $event)
    {
        Mail::to($event->email)->send(
            new FilePending($event->comentario)
        );
    }
}