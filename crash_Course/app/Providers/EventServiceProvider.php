<?php

namespace App\Providers;

use App\Events\NewCustomerCreated;
use App\Listeners\WelcomeNewCustomer;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\NewCustomerCreatedNotify;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NewCustomerCreated::class => [
            WelcomeNewCustomer::class,
            NewCustomerCreatedNotify::class,
        ],

        \App\Events\OrderShipped::class => [
            \App\Listeners\NotifyCustomer::class,
            \App\Listeners\DeleteOrderFromWaitingShipping::class,
        ],
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