<?php

namespace App\Policies;

use App\OrderListItem;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderListItemPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }

    public function create(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }

    public function update(User $user, OrderListItem $orderListItem)
    {
        return $user->is_admin || $user->is_manager;
    }

    public function delete(User $user, OrderListItem $orderListItem)
    {
        return $user->is_admin || $user->is_manager;
    }
}
