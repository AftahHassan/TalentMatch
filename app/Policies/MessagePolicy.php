<?php

namespace App\Policies;

use App\Models\User;

class MessagePolicy
{
    public function create(User $user): bool
    {
        return true;
    }
}
