<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderListRequest;
use App\Http\Requests\UpdateOrderListRequest;
use App\OrderList;
use App\User;
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
        $orderListToUpdate = OrderList::findOrFail($request->id);
        if (Auth::user()->can('finalize', $orderListToUpdate))
            $orderListToUpdate->update(['completed' => true]);
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
            foreach ($orderList->order_list_items as $item)
                $item->update(['quantity' => 0]);
        }
        return redirect()->back();
    }
}
