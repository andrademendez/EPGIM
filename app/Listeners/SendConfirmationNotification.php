<?php

namespace App\Listeners;

use App\Events\Confirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendConfirmationNotification
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
     * @param  \App\Events\Confirmation  $event
     * @return void
     */
    public function handle(Confirmation $event)
    {
        //
    }
}
