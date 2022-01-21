<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\Confirmation;
use App\Events\Challenge;
use App\Events\Pending;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendConfirmationNotification;
use App\Listeners\SendChallengeNotification;
use App\Listeners\SendPendingNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Confirmation::class => [
            SendConfirmationNotification::class,
        ],
        Pending::class => [
            SendPendingNotification::class,
        ],
        Challenge::class => [
            SendChallengeNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}