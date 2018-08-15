<?php

namespace App\Http\Controllers;

use App\AvailableItem;
use App\Http\Requests\CreateOrderListItemRequest;
use App\Http\Requests\UpdateOrderListItemRequest;
use App\OrderList;
use App\OrderListItem;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListItemsController extends Controller
{
    private function _view($kitchen_id, $order_list_id, $orderListItems, $viewName)
    {
        if (Auth::check() && OrderList::where('id', $order_list_id)->where('kitchen_id', $kitchen_id)->exists() &&
            (Auth::user()->can('view', OrderListItem::class) || (Auth::user()->is_kitchen && Auth::user()->id == $kitchen_id)))
        {
            $orderList = OrderList::findOrFail($order_list_id);
            $availableItems = AvailableItem::where('order_list_id', $order_list_id)->with('item')->get();
            return view($viewName, [
                'order_list' => $orderList,
                'available_items' => $availableItems,
                'order_list_items' => $orderListItems,
                'suppliers' => Supplier::all(),
            ]);
        }
        return redirect()->back();
    }

    public function view(Request $request, $kitchen_id, $order_list_id)
    {
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)->orderBy('kitchen_sort_order')
            ->with('item')->with('supplier')->get();
        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_kitchen');
    }

    public function view_categorized(Request $request, $kitchen_id, $order_list_id)
    {
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)
            ->withCount(['category as category_name' => function ($q) {
                $q->select('item_categories.name');
            }])->orderBy('category_name')->with('item')->with('category')->with('supplier')->get();
        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_categorized');
    }

    public function view_grouped_by_supplier(Request $request, $kitchen_id, $order_list_id)
    {
        if (!Auth::check() || !Auth::user()->is_manager)
            return redirect()->back();
        $orderListItems = OrderListItem::where('order_list_id', $order_list_id)
            ->withCount(['supplier as supplier_name' => function ($q) {
                $q->select('suppliers.name');
            }])->orderBy('supplier_name')->with('item')->with('category')->with('supplier')->get();
        return $this->_view($kitchen_id, $order_list_id, $orderListItems, 'pages.order_list_items_supplier');
    }

    public function create(CreateOrderListItemRequest $request)
    {
        OrderListItem::create([
            'quantity' => $request->quantity,
            'supplier_sort_order' => $request->supplier_sort_order,
            'kitchen_sort_order' => $request->kitchen_sort_order,
            'supplier_id' => $request->supplier_id,
            'order_list_id' => $request->order_list_id,
            'item_id' => $request->item_id,
            'available_item_id' => $request->available_item_id,
        ]);
        return redirect()->back();
    }

    public function update(UpdateOrderListItemRequest $request)
    {
        $updatedFields = [];
        $item = OrderListItem::find($request->id);
        if(Auth::user()->can('update_quantity', $item))
            $updatedFields['quantity'] = $request->quantity;
        if(Auth::user()->can('update_supplier_sort_order', $item))
            $updatedFields['supplier_sort_order'] = $request->supplier_sort_order;
        if(Auth::user()->can('update_kitchen_sort_order', $item))
            $updatedFields['kitchen_sort_order'] = $request->kitchen_sort_order;
        if(Auth::user()->can('update_supplier_id', $item))
            $updatedFields['supplier_id'] = $request->supplier_id;

        $item->update($updatedFields);
        return redirect()->back();
    }

    public function finilize(Request $request)
    {
        OrderListItem::find($request->id)->update(['completed' => true]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $orderListItem = OrderListItem::findOrFail($request->id);
        if (Auth::user()->can('delete', $orderListItem))
            $orderListItem->delete();
        return redirect()->back();
    }
}
