<?php

namespace App\Listeners;

use App\Mail\NewCustomerCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCustomerCreatedNotify implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        sleep(10);
        dump('Admins have been notified');
        # Mail::to('customers.departement@website.com')->send(new NewCustomerCreatedMail($event->customer));
    }
}