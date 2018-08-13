<?php

namespace App\Http\Controllers;

use App\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListsController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->can('view', OrderList::class))
        {
            $orderLists = OrderList::where('kitchen_id', $id)->withCount('order_list_items')->get();
            return view('pages.view_order_lists', ['order_lists' => $orderLists]);
        }
    }
}
