<?php

namespace App\Policies;

use App\OrderList;
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
        return $user->is_kitchen;
    }

    public function update(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager || $user->id == $orderListItem->order_list->kitchen_id;
    }

    public function delete(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager || $user->id == $orderListItem->order_list->kitchen_id;
    }

    public function update_completed(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager;
    }

    public function update_quantity(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager || $user->id == $orderListItem->order_list->kitchen_id;
    }

    public function update_supplier_sort_order(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager;
    }

    public function update_kitchen_sort_order(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager;
    }

    public function update_supplier_id(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager;
    }

    public function finilize(User $user, OrderListItem $orderListItem)
    {
        return $user->is_manager;
    }
}
