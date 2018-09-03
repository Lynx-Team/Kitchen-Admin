<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 23:18
 */

namespace App\Policies;


use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryOrderListItemPolicy
{

    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }
}