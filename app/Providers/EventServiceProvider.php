<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\Confirmation;
use App\Events\Challenge;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendConfirmationNotification;
use App\Listeners\SendChallengeNotification;
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