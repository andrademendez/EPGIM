<?php

namespace App\Listeners;

use App\Events\Challenge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChallengeNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Challenge  $event
     * @return void
     */
    public function handle(Challenge $event)
    {
        //
    }
}
