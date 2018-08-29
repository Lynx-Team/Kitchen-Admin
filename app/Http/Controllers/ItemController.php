<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Item;
use App\ItemCategory;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function view(Request $request, $kitchen_id)
    {
        if (Auth::check() && Auth::user()->can('view', Item::class))
            return view('pages.items', [
                'items' => Item::where('kitchen_id', $kitchen_id)->get(),
                'suppliers' => Supplier::all(),
                'categories' => ItemCategory::where('kitchen_id', $kitchen_id)->get()
            ]);
        return redirect()->back();
    }

    public function create(CreateItemRequest $request)
    {
        Item::create([
            'short_name' => $request->short_name,
            'full_name' => $request->full_name,
            'default_supplier_id' => $request->default_supplier,
            'category_id' => $request->category,
            'cost' => $request->cost,
            'kitchen_id' => $request->kitchen_id,
            'product_code' => $request->product_code,
            'unit' => $request->unit,
        ]);
        return redirect()->back();
    }

    public function update(UpdateItemRequest $request)
    {
        Item::find($request->id)->update([
            'short_name' => $request->short_name,
            'full_name' => $request->full_name,
            'default_supplier_id' => $request->default_supplier,
            'category_id' => $request->category,
            'cost' => $request->cost,
            'product_code' => $request->product_code,
            'unit' => $request->unit,
        ]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $itemToDelete = Item::findOrFail($request->id);
        if (Auth::user()->can('delete', $itemToDelete))
            $itemToDelete->delete();
        return redirect()->back();
    }
}
