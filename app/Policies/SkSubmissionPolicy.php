<?php

namespace App\Policies;

use App\Models\SkSubmission;
use App\Models\User;

class SkSubmissionPolicy
{
    public function view(User $user, SkSubmission $submission): bool
    {
        return !$user->hasRole('admin_kelurahan')
            || $submission->kelurahan_id === $user->id;
    }

    public function update(User $user, SkSubmission $submission): bool
    {
        return $user->hasRole('admin_kelurahan')
            && $submission->kelurahan_id === $user->id;
    }

    public function submit(User $user, SkSubmission $submission): bool
    {
        return $this->update($user, $submission);
    }
}
