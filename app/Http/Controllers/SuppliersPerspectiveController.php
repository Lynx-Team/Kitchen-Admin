<?php

namespace App\Http\Controllers;

use App\Item;
use App\Mail\SupplierMail;
use App\OrderList;
use App\OrderListItem;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        $pdf = $this->generatePDF($supplier->id, $supplier->name);
        return $pdf->download($supplier->name . '.pdf');
    }

    public function sendEmail($id)
    {
        $supplier = Supplier::findOrFail($id);
        $pdf = $this->generatePDF($supplier->id, $supplier->name);
        Mail::to($supplier->email)->send(new SupplierMail($pdf, $supplier->name));
        return redirect()->back();
    }

    private function generatePDF($id, $name)
    {
        $order_list_items = OrderListItem::where('supplier_id', $id)
            ->where('completed', 0)
            ->with('order_list')
            ->with('supplier')
            ->with('item')
            ->orderBy('supplier_sort_order')
            ->get();

        return PDF::loadView('pdf.supplier', ['supplier_name' => $name,
            'order_list_items' => $order_list_items]);
    }
}
