<?php

namespace App\Http\Controllers;

use App\OrderList;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->can('view_kitchen', User::class))
        {
            $grouped = $request->input('grouped', false) === "true";
            $kitchen = User::findOrFail($id);
            $order_lists = OrderList::where('kitchen_id', $kitchen->id)
                ->with(['order_list_items' => function ($q) use ($grouped) {
                    $q->when($grouped, function ($q) {
                        return $q->with(['item' => function ($q) {
                            return $q->with(['category' => function ($q) {
                                return $q->orderBy('name', 'asc');
                            }]);
                        }]);
                    }, function ($q) {
                        return $q->orderBy('kitchen_sort_order', 'asc');
                    })->with('supplier')
                        ->with(['item' => function ($q) {
                            return $q->with('category');
                        }]);
                }])->get();
            return view('pages.kitchen', ['grouped' => $grouped,
                'kitchen' => $kitchen, 'order_lists' => $order_lists, 'suppliers' => Supplier::all()]);
        }
        return redirect()->back();
    }
}
