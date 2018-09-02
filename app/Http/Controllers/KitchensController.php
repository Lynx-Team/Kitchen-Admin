<?php

namespace App\Http\Controllers;

use App\CustomerWorker;
use App\Http\Requests\CreateKitchenRequest;
use App\KitchenProfile;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function add_new_kitchen(CreateKitchenRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'kitchen')->get()[0]->id,
        ]);
        KitchenProfile::create([
            'kitchen_id' => $user->id,
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'postal_address' => $request->postal_address,
            'delivery_address' => $request->delivery_address,
            'phone' => $request->phone,
            'delivery_instructions' => $request->delivery_instructions,
        ]);
        CustomerWorker::create([
            'customer_id' => Auth::user()->customer()->id,
            'worker_id' => $user->id,
        ]);
        return redirect()->back();
    }
}
