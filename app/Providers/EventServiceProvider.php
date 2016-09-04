<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\JobCreated' => [
            'App\Listeners\RequestJobApproval'
        ],
        'App\Events\JobApproved' => [
            'App\Listeners\BroadcastNewJobMessage',
            'App\Listeners\SendJobApprovedMessage'
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomeMessage',
            'App\Listeners\SubscribeToMailingList',
            'App\Listeners\SendSlackInvite'
        ],
        'App\Events\CommentCreated' => [
            'App\Listeners\SendNewCommentNotification'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
