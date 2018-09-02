<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KitchensController extends Controller
{
    public function view()
    {
        if (Auth::check() && Auth::user()->can('view_kitchens', User::class))
        {
            $cutomerId = Auth::user()->customer()->id;
            $kitchens = DB::select("
              select users.id, users.name, count(order_lists.id) as order_lists_number
              from users
              join roles on roles.id = users.role_id 
              left join order_lists on order_lists.kitchen_id = users.id
              join customer_workers cw on (cw.worker_id = users.id and cw.customer_id = {$cutomerId})
              where roles.name = 'kitchen' 
              group by users.id, users.name");
            return view('pages.kitchens', ['kitchens' => $kitchens]);
        }
        return redirect()->back();
    }
}
