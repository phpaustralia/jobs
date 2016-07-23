<?php

namespace App\Listeners;

use App\Events\JobApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastNewJobMessage
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
     * @param  JobApproved  $event
     * @return void
     */
    public function handle(JobApproved $event)
    {
        //
    }
}
