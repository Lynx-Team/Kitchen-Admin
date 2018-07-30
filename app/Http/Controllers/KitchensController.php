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
            $kitchens = DB::select("
              select users.name, count(order_lists .id) as order_lists_number
              from users
              join roles on roles.id = users.id 
              join order_lists on order_lists .kitchen_id = users.id 
              where roles.name = 'kitchen' 
              group  by users.name");
            return view('pages.kitchens', ['kitchens' => $kitchens]);
        }
        return redirect()->back();
    }
}
