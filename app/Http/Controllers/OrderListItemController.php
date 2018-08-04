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
            'cost' => $request->cost,
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
            'cost' => $request->cost,
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
        OrderListItem::find($request->id)->update([
            'cost' => $request->cost,
            'completed' => $request->completed === 'on' ? 1 : 0,
            'quantity' => $request->quantity,
            'supplier_sort_order' => $request->supplier_sort_order,
            'kitchen_sort_order' => $request->kitchen_sort_order,
            'supplier_id' => $request->supplier_id
        ]);
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
