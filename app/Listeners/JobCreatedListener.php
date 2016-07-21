<?php

namespace App\Listeners;

use App\Events\JobCreated;
use App\Message;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  JobCreated  $event
     * @return void
     */
    public function handle(JobCreated $event)
    {
        $message = new Message();
        
        $message->title = 'New job created: ' . $event->job->title;
        
        $message->broadcast = true;
        
        $message->link = url("/jobs/{$event->job->id}");
        
        $message->save();

    }
}
