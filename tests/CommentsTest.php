<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    
    /**
     * @test
     */
    public function it_allows_users_to_comment_on_jobs()
    {
        $user = factory(\App\User::class)->create();
        
        $job = factory(App\Job::class)->create([
            'user_id' => $user->id
        ]);
        
        $comment = factory(App\Comment::class)->make([
            'job_id' => $job->id
        ]);

        $this->actingAs($user)
            ->post('comments', $comment->toArray())
            ->seeInDatabase('comments', ['job_id' => $job->id]);
    }
    
    /**
     * @test
     */
    public function it_allows_users_to_edit_their_comments()
    {
        $user = factory(\App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'job_id' => $job->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->put("comments/{$comment->id}", ['body' => 'foo bar' ])
            ->seeInDatabase('comments', ['body' => 'foo bar']);
    }

    /**
     * @test
     */
    public function it_prevents_users_from_editing_others_comments()
    {
        $owner = factory(\App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'job_id' => $job->id,
            'user_id' => $owner->id,
        ]);

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->put("comments/{$comment->id}", ['body' => 'foo bar' ])
            ->dontSeeInDatabase('comments', ['body' => 'foo bar']);
    }

    /**
     * @test
     */
    public function it_allows_users_to_delete_their_comments()
    {
        $user = factory(\App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'job_id' => $job->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->delete("comments/{$comment->id}")
            ->dontSeeInDatabase('comments', $comment->toArray());
    }

    /**
     * @test
     */
    public function it_prevents_users_from_deleting_others_comments()
    {
        $owner = factory(\App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'job_id' => $job->id,
            'user_id' => $owner->id,
        ]);

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->delete("comments/{$comment->id}")
            ->seeInDatabase('comments', $comment->toArray());
    }
    
    /**
     * @test
     */
    public function it_allows_admins_to_delete_any_comments()
    {
        $user = factory(\App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'job_id' => $job->id,
            'user_id' => $user->id,
        ]);

        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->delete("comments/{$comment->id}")
            ->dontSeeInDatabase('comments', $comment->toArray());
    }
}
