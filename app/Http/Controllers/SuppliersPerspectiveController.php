<?php

namespace App\Http\Controllers;

use App\Item;
use App\OrderList;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SuppliersPerspectiveController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->can('view_supplier', User::class))
        {
            $grouped = $request->input('grouped', false) === "true";
            $supplier = Supplier::findOrFail($id);
            $order_lists = OrderList::has('order_list_items')
                ->with(['order_list_items' => function ($q) use ($grouped, $supplier) {
                    $q->where('supplier_id', $supplier->id)->when($grouped, function ($q) use ($supplier) {
                        return $q->with(['item' => function ($q) {
                            return $q->with(['category' => function ($q) {
                                return $q->orderBy('name', 'asc');
                            }]);
                        }]);
                    }, function ($q) {
                        return $q->orderBy('supplier_sort_order', 'asc');
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

    public function downloadPDF($id)
    {
        $order_lists = [];
        $pdf = PDF::loadView('pdf.supplier_view', ['order_lists' => $order_lists]);
        return $pdf->download(Supplier::findOrFail($id)->name . '.pdf');
    }
}
