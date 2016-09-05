<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    /**
     * @test
     */
    public function it_watches_a_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->get("/jobs/{$job->id}/watch")
            ->seeInDatabase('job_user', [ 'user_id' => $user->id, 'job_id' => $job->id ]);
    }

    /**
     * @test
     */
    public function it_unwatches_a_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $user = factory(App\User::class)->create();

        $user->watching()->attach($job);

        $this->actingAs($user)
            ->get("/jobs/{$job->id}/unwatch")
            ->dontSeeInDatabase('job_user', [ 'user_id' => $user->id, 'job_id' => $job->id ]);
    }
}
