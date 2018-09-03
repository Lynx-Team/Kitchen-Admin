<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderListItemRequest;
use App\Http\Requests\UpdateOrderListItemRequest;
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

class OrderListItemsController extends Controller
{
    private function _view($kitchen_id, $order_list_id, $orderListItems, $viewName, $is_hide_quantity_0 = false)
    {
        if (Auth::check() && OrderList::where('id', $order_list_id)->where('kitchen_id', $kitchen_id)->exists() &&
            (Auth::user()->can('view', OrderListItem::class) || (Auth::user()->is_kitchen && Auth::user()->id == $kitchen_id)))
        {
            $orderList = OrderList::findOrFail($order_list_id);
            $availableItems = Item::where('kitchen_id', $kitchen_id)->get();
            $orderListItems = Auth::user()->is_kitchen ? $orderListItems->where('one_off', false) : $orderListItems;
            return view($viewName, [
                'order_list' => $orderList,
                'available_items' => $availableItems,
                'order_list_items' => $orderListItems->get(),
                'suppliers' => Supplier::all(),
                'is_hide_quantity_0' => $is_hide_quantity_0,
            ]);
        }
        return redirect()->back();
    }

    public function view(Request $request, $kitchen_id, $order_list_id)
    {
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)->orderBy('kitchen_sort_order')
            ->with('item')->with('supplier');

        $is_hide_quantity_0 = $request->is_hide_quantity_0 ?? 'off';
        if ($is_hide_quantity_0 == 'on')
            $orderListItems = $orderListItems->where('quantity', '!=', 0);

        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_kitchen', $is_hide_quantity_0);
    }

    public function view_categorized(Request $request, $kitchen_id, $order_list_id)
    {
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)
            ->withCount(['category as category_name' => function ($q) {
                $q->select('item_categories.name');
            }])->orderBy('category_name')->with('item')->with('category')->with('supplier');
        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_categorized');
    }

    public function view_grouped_by_supplier(Request $request, $kitchen_id, $order_list_id)
    {
        if (!Auth::check() || !Auth::user()->is_manager)
            return redirect()->back();
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)
            ->withCount(['supplier as supplier_name' => function ($q) {
                $q->select('suppliers.name');
            }])->orderBy('supplier_name')->with('item')->with('category')->with('supplier');
        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_supplier');
    }

    public function create(CreateOrderListItemRequest $request)
    {
        OrderListItem::create([
            'quantity' => 0,
            'supplier_sort_order' => $request->supplier_sort_order,
            'kitchen_sort_order' => $request->kitchen_sort_order,
            'supplier_id' => $request->supplier_id,
            'order_list_id' => $request->order_list_id,
            'item_id' => $request->item_id,
            'one_off' => $request->one_off,
        ]);
        return redirect()->back();
    }

    public function update(UpdateOrderListItemRequest $request)
    {
        $updatedFields = [];
        $item = OrderListItem::findOrFail($request->id);
        $orderList = OrderList::findOrFail($item->order_list_id);
        if ($orderList->completed && !Auth::user()->is_manager)
            return;
        if(Auth::user()->can('update_quantity', $item))
            $updatedFields['quantity'] = $request->quantity;
        if(Auth::user()->can('update_supplier_sort_order', $item))
            $updatedFields['supplier_sort_order'] = $request->supplier_sort_order;
        if(Auth::user()->can('update_kitchen_sort_order', $item))
            $updatedFields['kitchen_sort_order'] = $request->kitchen_sort_order;
        if(Auth::user()->can('update_supplier_id', $item))
            $updatedFields['supplier_id'] = $request->supplier_id;

        $item->update($updatedFields);
    }

    public function delete(Request $request)
    {
        $orderListItem = OrderListItem::findOrFail($request->id);
        if (Auth::check() && Auth::user()->can('delete', $orderListItem))
            $orderListItem->delete();
        return redirect()->back();
    }

    public function downloadPDF($orderListId, $supplierId = null)
    {
        $orderList = OrderList::findOrFail($orderListId);
        if (Auth::check() && Auth::user()->can('download_pdf', $orderList))
        {
            $kitchen = User::where('id', $orderList->kitchen_id)->with('kitchenProfile')->get()[0];
            $pdf = $this->generatePDF($orderListId, $orderList->note, $kitchen, $supplierId);
            return $pdf->download($orderList->note . '.pdf');
        }
        return redirect()->back();
    }

    public function sendEmail($orderListId, $supplierId = null)
    {
        $orderList = OrderList::findOrFail($orderListId);
        if (Auth::check() && Auth::user()->can('send_email', $orderList))
        {
            $supplierIds = $supplierId === null ? DB::table('order_list_items')->select('supplier_id')->
                where('order_list_id', $orderListId)->groupBy('supplier_id')->get() :
                [ (object) ['supplier_id' => $supplierId] ];

            $kitchen = User::where('id', $orderList->kitchen_id)->with('kitchenProfile')->get()[0];
            foreach($supplierIds as $supplierId)
            {
                $supplier = Supplier::findOrFail($supplierId->supplier_id);
                $pdf = $this->generatePDF($orderListId, $orderList->note, $kitchen, $supplier->id);
                Mail::to($supplier->email)->from($kitchen->email, $kitchen->kitchenProfile->company_name)
                    ->send(new SupplierMail($pdf, $orderList->note));
            }
        }
        return redirect()->back();
    }

    private function generatePDF($orderListId, $orderListName, $kitchen, $supplierId = null)
    {
        if (\is_null($supplierId))
        {
            $orderListItems = OrderListItem::where('order_list_id', $orderListId)->
                with('item')->with('supplier')->orderBy('supplier_id')->orderBy('supplier_sort_order')->get();
            return PDF::loadView('pdf.suppliers', [
                'kitchen' => $kitchen,
                'order_list_name' => $orderListName,
                'order_list_items' => $orderListItems
            ]);
        }
        else
        {
            $supplier = Supplier::findOrFail($supplierId);
            $orderListItems = OrderListItem::where('order_list_id', $orderListId)->
                where('supplier_id', $supplierId)->with('item')->orderBy('supplier_sort_order')->get();
            return PDF::loadView('pdf.supplier', [
                'kitchen' => $kitchen,
                'order_list_name' => $orderListName,
                'supplier_name' => $supplier->name,
                'order_list_items' => $orderListItems
            ]);
        }
    }
}
