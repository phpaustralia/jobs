<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewCommentNotification
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
     * @param  CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        $comment = $event->comment;

        foreach ($comment->job->watchers as $user) {
            $message = new Message();

            $message->title = "{$comment->user->name} Commented on the job '{$comment->job->title}'";

            $message->to = $user->id;

            $message->link = url("/jobs/{$comment->job->id}");

            $message->save();
        }

        foreach ($comment->job->watchers as $user) {
            $user->notify(new CommentNotification($comment));
        }
    }
}
