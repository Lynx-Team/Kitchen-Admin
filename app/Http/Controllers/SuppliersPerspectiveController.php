<?php

namespace App\Http\Controllers;

use App\Item;
use App\OrderList;
use App\OrderListItem;
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
        $supplier = Supplier::findOrFail($id);
        if (Auth::check() && Auth::user()->can('view_supplier', User::class))
        {
            $grouped = $request->input('grouped', false) === "true";
            $rows = OrderList::join('order_list_items', 'order_list_items.order_list_id', '=', 'order_lists.id')
                ->join('suppliers', 'suppliers.id', '=', 'order_list_items.supplier_id')
                ->join('items', 'items.id', '=', 'order_list_items.item_id')
                ->join('item_categories', 'item_categories.id', '=', 'items.category_id')
                ->where('suppliers.id', '=', $supplier->id)
                ->orderBy('order_lists.note')
                ->select('*',
                    DB::raw('(select count(*) from order_list_items t where t.order_list_id = `order_lists`.id) as count'));
            $rows = ($grouped ? $rows->orderBy('item_categories.name', 'asc') : $rows);
            $rows = $rows->orderBy('order_list_items.supplier_sort_order', 'asc');
            $sql = $rows->toSql();
            return view('pages.suppliers_perspective', ['grouped' => $grouped,
                'supplier' => $supplier, 'rows' => $rows, 'suppliers' => Supplier::all(),
                'all_items' => Item::all()]);
        }
        return redirect()->back();
    }

    public function downloadPDF($id)
    {

        $supplier = Supplier::findOrFail($id);
        $order_lists = OrderListItem::where('supplier_id', '=', $supplier->id)
            ->where('completed', '=', 0)
            ->with('order_list')
            ->with('supplier')
            ->orderBy('supplier_sort_order')
            ->get();
//        $order_lists = [];
        $pdf = PDF::loadView('pdf.supplier_view', ['order_lists' => $order_lists]);
        return $pdf->download(Supplier::findOrFail($id)->name . '.pdf');
    }
}
