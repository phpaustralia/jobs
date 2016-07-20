<?php

namespace App\Policies;

use App\Job;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function update(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }
    
    public function destroy(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }

}
