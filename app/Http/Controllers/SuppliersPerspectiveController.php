<?php

namespace App\Http\Controllers;

use App\Item;
use App\OrderList;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuppliersPerspectiveController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->can('view_kitchen', User::class))
        {
            $grouped = $request->input('grouped', false) === "true";
            $supplier = Supplier::findOrFail($id);
            $order_lists = OrderList::has('order_list_items')
                ->with(['order_list_items' => function ($q) use ($grouped, $supplier) {
                    $q->when($grouped, function ($q) use ($supplier) {
                        return $q->with(['item' => function ($q) {
                            return $q->with(['category' => function ($q) {
                                return $q->orderBy('name', 'asc');
                            }]);
                        }])->where('supplier_id', $supplier->id);
                    }, function ($q) {
                        return $q->orderBy('kitchen_sort_order', 'asc');
                    })->with('supplier')
                        ->with(['item' => function ($q) {
                            return $q->with('category');
                          }]);
                }])->with('kitchen')->get();
            return view('pages.suppliers_perspective', ['grouped' => $grouped,
                'supplier' => $supplier, 'order_lists' => $order_lists, 'suppliers' => Supplier::all(),
                'all_items' => Item::all()]);
        }
        return redirect()->back();
    }
}