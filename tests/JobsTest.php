<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JobsTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseTransactions;

    /**
     * @test
     */
    public function it_shows_all_approved_jobs()
    {
        $user = factory(App\User::class)->create();

        $approvedJob = factory(App\Job::class)->create([
            'user_id' => $user->id,
            'approved' => true,
        ]);

        $unapprovedJob = factory(App\Job::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->visit('/jobs')
            ->see($approvedJob->title)
            ->dontSee($unapprovedJob->title);
    }

    /**
     * @test
     */
    public function it_allows_admin_to_approve_job()
    {
        $this->expectsEvents(App\Events\JobApproved::class);

        $user = $this->createAdmin();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get("/jobs/{$job->id}/approve/1")
            ->seeInDatabase('jobs', [
                'id' => $job->id,
                'approved' => true
            ]);
    }

    public function it_prevents_non_admin_from_approving_jobs()
    {
        $user = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get("/jobs/{$job->id}/approve/1")
            ->assertResponseStatus(403)
            ->seeInDatabase('jobs', [
                'id' => $job->id,
                'approved' => false
            ]);
    }

    /**
     * @test
     */
    public function it_allows_user_to_create_jobs()
    {
        $this->expectsEvents(App\Events\JobCreated::class);

        $user = factory(App\User::class)->create();

        $job = factory(App\Job::class)->make();

        $data = $job->toArray();

        $this->actingAs($user)
            ->post('/jobs', $data)
            ->seeInDatabase('jobs', ['title' => $job->title, 'description' => $job->description]);
    }

    /**
     * @test
     */
    public function it_allows_owner_to_edit_job()
    {
        $user = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id,
            'approved' => true,
        ]);

        $newJob = factory(App\Job::class)->make();

        $this->actingAs($user)
            ->put("/jobs/{$job->id}", $newJob->toArray());

        $this->seeInDatabase('jobs', ['id' => $job->id, 'title' => $newJob->title, 'description' => $newJob->description]);
    }

    /**
     * @test
     */
    public function it_blocks_non_owner_from_editing_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $user = factory(App\User::class)->create();

        $newJob = factory(App\Job::class)->make();

        $this->actingAs($user)
            ->put("/jobs/{$job->id}", $newJob->toArray());

        $this->assertResponseStatus(403);

//        $this->seeInDatabase('jobs', ['id' => $job->id, 'title' => $newJob->title, 'description' => $newJob->description]);
    }

    /**
     * @test
     */
    public function it_allows_admin_to_edit_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $admin = $this->createAdmin();

        $newJob = factory(App\Job::class)->make();

        $this->actingAs($admin)
            ->put("/jobs/{$job->id}", $newJob->toArray());

        $this->seeInDatabase('jobs', ['id' => $job->id, 'title' => $newJob->title, 'description' => $newJob->description]);
    }

    /**
     * @test
     */
    public function it_allows_owner_to_delete_job()
    {
        $user = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $user->id,
            'approved' => true,
        ]);

        $this->actingAs($user)
            ->delete("/jobs/{$job->id}");

        $this->dontSeeInDatabase('jobs', $job->toArray());
    }

    /**
     * @test
     */
    public function it_blocks_non_owner_from_deleting_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->delete("/jobs/{$job->id}")
            ->assertResponseStatus(403)
            ->seeInDatabase('jobs', $job->toArray());
    }

    /**
     * @test
     */
    public function it_allows_admin_to_delete_job()
    {
        $owner = factory(App\User::class)->create();

        $job = factory(App\Job::class)->create([
            'user_id' => $owner->id,
            'approved' => true,
        ]);

        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->delete("/jobs/{$job->id}")
            ->dontSeeInDatabase('jobs', $job->toArray());
    }
}
