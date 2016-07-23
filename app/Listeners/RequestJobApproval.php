<?php

namespace App\Listeners;

use App\Events\JobCreated;
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
        Mail::send('emails.newJob', ['job' => $event->job] , function ($message) {

            $message->to('foo@example.com');
            
            $message->subject('new job created.');
        });
    }
}
