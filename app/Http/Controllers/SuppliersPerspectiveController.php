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
            $order_lists = OrderList::with(['order_list_items' => function ($q) use ($supplier, $grouped) {
                    $q->where('supplier_id', $supplier->id)->when($grouped, function ($q) {
                        return $q->withCount(['category as category_name' => function ($q) {
                            $q->select('item_categories.name');
                        }])->orderBy('category_name');
                    }, function ($q) {
                        return $q->orderBy('supplier_sort_order', 'asc');
                    })->with('supplier')
                        ->with(['item' => function ($q) {
                            return $q->with('category');
                        }]);
                }])->get();
            return view('pages.suppliers_perspective', ['grouped' => $grouped,
                'supplier' => $supplier, 'order_lists' => $order_lists, 'suppliers' => Supplier::all(),
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
