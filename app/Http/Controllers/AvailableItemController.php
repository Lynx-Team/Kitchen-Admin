<?php

namespace App\Http\Controllers;

use App\AvailableItem;
use App\AvailableItemList;
use App\Http\Requests\CreateAvailableItemRequest;
use App\Http\Requests\CreateItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Item;
use App\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableItemController extends Controller
{
    public function view(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->can('view', AvailableItem::class))
        {
            return view('pages.available_item', ['all_items' => Item::all(),
                'items' => AvailableItem::where('order_list_id', $id)->with('item')]);
        }

        return redirect()->back();
    }

    public function create(CreateAvailableItemRequest $request)
    {
        AvailableItem::create([
            'order_list_item_id' => $request->order_list_item_id,
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
