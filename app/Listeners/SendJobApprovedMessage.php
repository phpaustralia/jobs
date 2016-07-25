<?php

namespace App\Listeners;

use App\Events\JobApproved;
use App\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendJobApprovedMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  JobCreated  $event
     * @return void
     */
    public function handle(JobApproved $event)
    {
        $message = new Message();

        $message->title = 'New job created: ' . $event->job->title;

        $message->broadcast = true;

        $message->link = url("/jobs/{$event->job->id}");

        $message->save();

    }
}
