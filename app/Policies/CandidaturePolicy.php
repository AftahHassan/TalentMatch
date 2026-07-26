<?php

namespace App\Policies;

use App\Models\Candidature;
use App\Models\User;

class CandidaturePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Candidature $candidature): bool
    {
        return $candidature->analyse
            && $user->id === $candidature->analyse->offre->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
