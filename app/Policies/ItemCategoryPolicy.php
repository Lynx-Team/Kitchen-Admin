<?php

namespace App\Policies;

use App\User;
use App\ItemCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemCategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->isAdmin;
    }

    public function create(User $user)
    {
        return $user->isAdmin;
    }

    public function update(User $user, ItemCategory $itemCategory)
    {
        return $user->isAdmin;
    }

    public function delete(User $user, ItemCategory $itemCategory)
    {
        return $user->isAdmin;
    }
}
