<?php

namespace App\Policies;

use App\OrderList;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderListPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, OrderList $orderList)
    {
        return $user->is_admin;
    }

    public function finalize(User $user, OrderList $orderList)
    {
        return $user->id === $orderList->kitchen_id;
    }

    public function delete(User $user, OrderList $orderList)
    {
        return $user->is_admin;
    }

    public function reset(User $user, OrderList $orderList)
    {
        return $user->is_manager;
    }
}
