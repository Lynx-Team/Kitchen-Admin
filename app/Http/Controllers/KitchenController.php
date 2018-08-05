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
            $rows = OrderList::join('order_list_items', 'order_list_items.order_list_id', '=', 'order_lists.id')
                ->join('suppliers', 'suppliers.id', '=', 'order_list_items.supplier_id')
                ->join('items', 'items.id', '=', 'order_list_items.item_id')
                ->join('item_categories', 'item_categories.id', '=', 'items.category_id')
                ->orderBy('order_lists.note')
                ->select('*',
                    DB::raw('(select count(*) from order_list_items t where t.order_list_id = `order_lists`.id) as count'));
            $rows = ($grouped ? $rows->orderBy('item_categories.name', 'asc') : $rows);
            $rows = $rows->orderBy('order_list_items.kitchen_sort_order', 'asc')->get();
            return view('pages.kitchen', ['grouped' => $grouped,
                'kitchen' => $kitchen, 'rows' => $rows, 'suppliers' => Supplier::all(),
                'all_items' => Item::all()]);
        }
        return redirect()->back();
    }
}
