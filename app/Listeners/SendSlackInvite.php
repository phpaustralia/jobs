<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\SlackInviteNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSlackInvite
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $event->user->notify(new SlackInviteNotification($event->user));
    }
}
