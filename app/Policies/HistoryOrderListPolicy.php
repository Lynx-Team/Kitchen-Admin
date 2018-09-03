<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 22:47
 */

namespace App\Policies;


use App\HistoryOrderList;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryOrderListPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->is_admin || $user->is_manager;
    }
}