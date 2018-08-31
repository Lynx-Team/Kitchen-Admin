<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 20:51
 */

namespace App\Policies;


use App\KitchenProfile;
use App\User;

class KitchenProfilePolicy
{
    public function view(User $user)
    {
        return $user->is_admin || $user->is_customer;
    }

    public function create(User $user)
    {
        return $user->is_admin || $user->is_customer;
    }

    public function update(User $user, KitchenProfile $kitchenProfile)
    {
        return ($user->is_admin && $user->customer()->id == $kitchenProfile->kitchen->customer()->id) ||
            ($user->is_customer && $kitchenProfile->kitchen->customer()->id == $user->id);
    }

    public function delete(User $user, KitchenProfile $kitchenProfile)
    {
        return ($user->is_admin && $user->customer()->id == $kitchenProfile->kitchen()->customer()->id) ||
            ($user->is_customer && $kitchenProfile->kitchen()->customer()->id == $user->id);
    }
}