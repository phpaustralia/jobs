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
        if ($user->isAdmin())  return true;
    }
    
    public function show(User $user, Job $job)
    {
        return $job->approved;
    }

    public function update(User $user, Job $job)
    {

        return $user->id == $job->user_id;
    }
    
    public function destroy(User $user, Job $job)
    {
        return $user->id == $job->user_id;
    }
    
    public function approve(User $user, Job $job)
    {
        // Only admins can approve and they pass the before filter, so this condition will not apply to them
        return false;
    }

}
