<?php

namespace App\Http\Controllers;

use App\Item;
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
        $kitchen = User::findOrFail($id);
        if (Auth::check() && Auth::user()->can('view_kitchen', $kitchen))
        {
            $grouped = $request->input('grouped', false) === "true";
            $items = OrderList::join('order_list_items', 'order_list_items.order_list_id', '=', 'order_lists.id')
                ->join('suppliers', 'suppliers.id', '=', 'order_list_items.supplier_id')
                ->join('items', 'items.id', '=', 'order_list_items.item_id')
                ->join('item_categories', 'item_categories.id', '=', 'items.category_id')
                ->where('order_lists.kitchen_id', '=', $kitchen->id)
                ->orderBy('order_lists.note')
                ->select('*',
                    DB::raw('(select count(*) from order_list_items t where t.order_list_id = `order_lists`.id) as count'));
            $items = ($grouped ? $items->orderBy('item_categories.name', 'asc') : $items);
            $items = $items->orderBy('order_list_items.kitchen_sort_order', 'asc')->get();
            return view('pages.kitchen', ['grouped' => $grouped,
                'kitchen' => $kitchen, 'items' => $items, 'suppliers' => Supplier::all(),
                'all_items' => Item::all()]);
        }
        return redirect()->back();
    }
}
