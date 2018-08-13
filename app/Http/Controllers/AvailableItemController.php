<?php

namespace App\Http\Controllers;

use App\AvailableItem;
use App\Http\Requests\CreateAvailableItemRequest;
use App\Item;
use App\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableItemController extends Controller
{
    public function view(Request $request, $kitchen_id, $order_list_id)
    {
        if (Auth::check() && Auth::user()->can('view', AvailableItem::class) &&
            OrderList::where('id', $order_list_id)->where('kitchen_id', $kitchen_id)->exists())
        {
            return view('pages.available_item', [
                'all_items' => Item::whereDoesntHave('availableItems', function ($q) use($order_list_id) {
                    $q->where('order_list_id', $order_list_id);
                })->get(),
                'items' => AvailableItem::where('order_list_id', $order_list_id)->with('item')->get(),
                'order_list_id' => $order_list_id,
                'kitchen_id' => $kitchen_id,
            ]);
        }

        return redirect()->back();
    }

    public function create(CreateAvailableItemRequest $request)
    {
        AvailableItem::create([
            'order_list_id' => $request->order_list_id,
            'item_id' => $request->item_id
        ]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $availableItem = AvailableItem::findOrFail($request->id);
        if (Auth::user()->can('delete', $availableItem))
            $availableItem->delete();

        return redirect()->back();
    }
}
