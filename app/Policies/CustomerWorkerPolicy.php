<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 21:20
 */

namespace App\Policies;


use App\CustomerWorker;
use App\User;

class CustomerWorkerPolicy
{
    public function view(User $user)
    {
        return $user->is_admin || $user->is_customer;
    }

    public function create(User $user)
    {
        return $user->is_admin || $user->is_customer;
    }

    public function delete(User $user, KitchenProfile $kitchenProfile)
    {
        return ($user->is_admin && $user->customer()->id == $kitchenProfile->kitchen()->customer()->id) ||
            ($user->is_customer && $kitchenProfile->kitchen()->customer()->id == $user->id);
    }
}