<?php

namespace App\Policies;

use App\User;
use App\Supplier;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin;
    }

    public function view_list(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Supplier $supplier)
    {
        return $user->is_admin; // && $supplier->kitchen()->customer()->id == $user->customer()->id;
    }

    public function delete(User $user, Supplier $supplier)
    {
        return $user->is_admin;
    }
}
