<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserAdded;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\ContactController;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeUserContact implements ShouldQueue
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
     * @param  UserAdded  $event
     * @return void
     */
    public function handle(UserAdded $event)
    {
        $event->user->contact()->create($event->contact_data);
        // User::where('id', $event->user_id)->first()->contact()->create($event->contact_data);
    }
}