<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemCategoryController extends Controller
{
    public function view()
    {
        if (Auth::user()->can('view', ItemCategory::class))
            return view('pages.item_categories', ['item_categories' => ItemCategory::all()]);

        return redirect()->back();
    }

    public function create(CreateItemCategoryRequest $request)
    {
        ItemCategory::create(['name' => $request->name]);
        return redirect()->back();
    }

    public function update(UpdateItemCategoryRequest $request)
    {
        ItemCategory::find($request->id)->update(['name' => $request->name]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $itemCategoryToDelete = ItemCategory::findOrFail($request->id);
        if (Auth::user()->can('delete', $itemCategoryToDelete))
            $itemCategoryToDelete->delete();

        return redirect()->back();
    }
}
