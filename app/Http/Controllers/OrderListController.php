<?php

namespace App\Http\Controllers;

use App\HistoryOrderList;
use App\HistoryOrderListItem;
use App\Http\Requests\CreateOrderListRequest;
use App\Http\Requests\UpdateOrderListRequest;
use App\OrderList;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListController extends Controller
{
    public function view()
    {
        if (Auth::check() && Auth::user()->can('view', OrderList::class))
            return view('pages.order_lists', ['order_lists' => OrderList::all(),
                'kitchens' => User::whereHas('role', function($query) {
                    $query->where('name', 'kitchen');
                })->get()]);
        return redirect()->back();
    }

    public function create(CreateOrderListRequest $request)
    {
        OrderList::create([
            'note' => $request->note,
            'kitchen_id' => $request->kitchen_id,
        ]);
        return redirect()->back();
    }

    public function update(UpdateOrderListRequest $request)
    {
        OrderList::find($request->id)->update([
            'note' => $request->note,
            'kitchen_id' => $request->kitchen_id,
        ]);
        return redirect()->back();
    }

    public function finalize(Request $request)
    {
        $orderList = OrderList::findOrFail($request->id);
        if (Auth::user()->can('finalize', $orderList))
        {
            $orderList->update(['completed' => true]);
            $hol = HistoryOrderList::create([
                'note' =>  $orderList->note,
                'last_update_date' => Carbon::now()->toDateString(),
                'order_list_id' => $orderList->id,
                'kitchen_id' => $orderList->kitchen_id,
                'customer_id' => Auth::user()->customer()->id
            ]);

            foreach ($orderList->order_list_items as $item)
            {
                HistoryOrderListItem::create([
                    'short_name' => $item->item->short_name,
                    'long_name' => $item->item->full_name,
                    'supplier_name' => $item->supplier->name,
                    'quantity' => $item->quantity,
                    'total_cost' => $item->quantity * $item->item->cost,
                    'product_code' => $item->item->product_code,
                    'unit' => $item->item->unit,
                    'history_order_list_id' => $hol->id
                ]);
            }
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $orderListToDelete = OrderList::findOrFail($request->id);
        if (Auth::user()->can('delete', $orderListToDelete))
            $orderListToDelete->delete();
        return redirect()->back();
    }

    public function reset(Request $request)
    {
        $orderList = OrderList::findOrFail($request->id);
        if (Auth::user()->can('reset', $orderList))
        {
            $orderList->update(['completed' => false]);
            $historyOrderLists = HistoryOrderList::where('order_list_id', $orderList->id)->get();
            foreach ($historyOrderLists as $hol)
                $hol->update([ 'order_list_id' => null ]);
            foreach ($orderList->order_list_items as $item)
                if ($item->one_off)
                    $item->delete();
                else
                    $item->update(['quantity' => 0]);
        }
        return redirect()->back();
    }
}
