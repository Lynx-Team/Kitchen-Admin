<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function view()
    {
        if (Auth::user()->can('view', Supplier::class))
            return view('pages.suppliers', ['suppliers' => Supplier::all()]);

        return view('errors.403');
    }

    public function create(Request $request)
    {
        if (Auth::user()->can('create', Supplier::class))
        {
            Supplier::updateOrCreate(['email' => $request->email], ['name' => $request->name]);
            return redirect()->back();
        }

        return view('errors.403');
    }

    public function update(Request $request)
    {
        $supplierToUpdate = Supplier::where('id', $request->id)->firstOrFail();
        if (Auth::user()->can('update', $supplierToUpdate))
        {
            Supplier::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email]);
            return redirect()->back();
        }

        return view('errors.403');
    }

    public function delete(Request $request)
    {
        $supplierToDelete = Supplier::where('id', $request->id)->firstOrFail();
        if (Auth::user()->can('delete', $supplierToDelete))
        {
            Supplier::where('id', $request->id)->delete();
            return redirect()->back();
        }

        return view('errors.403');
    }
}
