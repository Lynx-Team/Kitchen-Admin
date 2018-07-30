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

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Supplier $supplier)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Supplier $supplier)
    {
        return $user->is_admin;
    }
}
