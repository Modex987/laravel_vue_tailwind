<?php

namespace App\Listeners;

use App\Mail\NewCustomerCreatedMail;
use App\Mail\WelcomeNewCustomerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewCustomer  implements ShouldQueue
{
    public $delay = 5;
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        sleep(15);
        dump('New User Has Been Created');
        # Mail::to($event->customer->email)->send(new WelcomeNewCustomerMail);
    }
}