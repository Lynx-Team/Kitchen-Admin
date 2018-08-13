<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderListItemRequest;
use App\Http\Requests\CreateOrderListRequest;
use App\Http\Requests\UpdateOrderListItemRequest;
use App\Http\Requests\UpdateOrderListRequest;
use App\OrderList;
use App\OrderListItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListItemController extends Controller
{

    private function fill(Request $request)
    {
        return [
            'completed' => $request->completed === 'on' ? 1 : 0,
            'quantity' => $request->quantity,
            'supplier_sort_order' => $request->supplier_sort_order,
            'kitchen_sort_order' => $request->kitchen_sort_order,
            'supplier_id' => $request->supplier_id,
            'order_list_id' => $request->order_list_id,
            'item_id' => $request->item_id,
        ];
    }

    public function create(CreateOrderListItemRequest $request)
    {
        OrderListItem::create([
            'completed' => $request->completed === 'on' ? 1 : 0,
            'quantity' => $request->quantity,
            'supplier_sort_order' => $request->supplier_sort_order,
            'kitchen_sort_order' => $request->kitchen_sort_order,
            'supplier_id' => $request->supplier_id,
            'order_list_id' => $request->order_list_id,
            'item_id' => $request->item_id,
        ]);
        return redirect()->back();
    }

    public function update(UpdateOrderListItemRequest $request)
    {
        $updatedFields = [];
        $itemToUpdate = OrderListItem::findOrFail($request->id);
        if(Auth::user()->can('update_cost', $itemToUpdate))
            $updatedFields['cost'] = $request->cost;
        if(Auth::user()->can('update_completed', $itemToUpdate))
            $updatedFields['completed'] = $request->completed === 'on';
        if(Auth::user()->can('update_quantity', $itemToUpdate))
            $updatedFields['quantity'] = $request->quantity;
        if(Auth::user()->can('update_supplier_sort_order', $itemToUpdate))
            $updatedFields['supplier_sort_order'] = $request->supplier_sort_order;
        if(Auth::user()->can('update_kitchen_sort_order', $itemToUpdate))
            $updatedFields['kitchen_sort_order'] = $request->kitchen_sort_order;
        if(Auth::user()->can('update_supplier_id', $itemToUpdate))
            $updatedFields['supplier_id'] = $request->supplier_id;

        $itemToUpdate->update($updatedFields);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $order_list_item = OrderListItem::findOrFail($request->id);
        if (Auth::user()->can('delete', $order_list_item))
            $order_list_item->delete();
        return redirect()->back();
    }
}
