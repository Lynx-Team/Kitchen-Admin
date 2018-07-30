<?php

namespace App\Policies;

use App\User;
use App\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
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

    public function update(User $user, Item $item)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Item $item)
    {
        return $user->is_admin;
    }
}
