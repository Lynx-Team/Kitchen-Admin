<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function update(User $user, User $model)
    {
        return $user->is_admin;
    }

    public function delete(User $user, User $model)
    {
        return $user->is_admin;
    }
}
