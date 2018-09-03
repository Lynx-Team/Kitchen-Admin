<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function view($kitchenId)
    {
        if (Auth::check() && Auth::user()->can('view', Supplier::class))
            return view('pages.suppliers', ['suppliers' => Supplier::where('kitchen_id', $kitchenId)->get()]);

        return redirect()->back();
    }

    public function create(CreateSupplierRequest $request)
    {
        Supplier::create($request->all());
        return redirect()->back();
    }

    public function update(UpdateSupplierRequest $request)
    {
        Supplier::find($request->id)->update(['name' => $request->name, 'email' => $request->email]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $supplierToDelete = Supplier::findOrFail($request->id);
        if (Auth::user()->can('delete', $supplierToDelete))
            $supplierToDelete->delete();

        return redirect()->back();
    }
}
