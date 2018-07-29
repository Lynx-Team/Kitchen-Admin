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

    public function update_profile(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    public function change_password(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    public function view_kitchens(User $user)
    {
        return $user->isAdmin || $user->isManager;
    }
}
