<?php

namespace App\Http\Controllers;

use App\Item;
use App\OrderList;
use App\OrderListItem;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{
    public function view(Request $request, $id)
    {
        $kitchen = User::findOrFail($id);
        if (Auth::check() && Auth::user()->can('view_kitchen', $kitchen))
        {
            $grouped = $request->input('grouped', false) === "true";
            $order_lists = OrderList::where('kitchen_id', $kitchen->id)
                ->with(['order_list_items' => function ($q) use ($grouped) {
                    $q->when($grouped, function ($q) {
                        return $q->withCount(['category as category_name' => function ($q) {
                            $q->select('item_categories.name');
                        }])->orderBy('category_name');
                    }, function ($q) {
                        return $q->orderBy('kitchen_sort_order', 'asc');
                    })->with('supplier')
                        ->with(['item' => function ($q) {
                            return $q->with('category');
                        }]);
                }])->get();
            return view('pages.kitchen', ['grouped' => $grouped,
                'kitchen' => $kitchen, 'order_lists' => $order_lists, 'suppliers' => Supplier::all(),
                'all_items' => Item::all()]);
        }
        return redirect()->back();
    }
}
