<?php

namespace App\Http\Controllers;

use App\OrderList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListsController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && (Auth::user()->can('view', OrderList::class) ||
                (Auth::user()->is_kitchen && Auth::user()->id == $id)))
        {
            $kitchen = User::findOrFail($id);
            $orderLists = OrderList::where('kitchen_id', $id)->withCount('order_list_items')->get();
            return view('pages.view_order_lists', ['kitchen' => $kitchen, 'order_lists' => $orderLists]);
        }
        return redirect()->back();
    }
}
