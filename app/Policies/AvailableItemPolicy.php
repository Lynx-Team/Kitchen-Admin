<?php

namespace App\Policies;

use App\User;
use App\AvailableItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvailableItemPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function delete(User $user, AvailableItem $availableItem)
    {
        return $user->is_admin;
    }
}
