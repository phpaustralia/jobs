<?php

namespace App\Listeners;

use App\Events\JobCreated;
use App\Notifications\RequestJobApprovalNotification;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RequestJobApproval
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
     * @param  JobCreated  $event
     * @return void
     */
    public function handle(JobCreated $event)
    {
        $admins = User::getAdmins();

        foreach ($admins as $admin) {
            $admin->notify(new RequestJobApprovalNotification($event->job));
        }
    }
}
