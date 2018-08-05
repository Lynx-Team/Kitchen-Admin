<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Support\Facades\Auth;

class SuppliersViewController extends Controller
{
    public function view()
    {
        if(Auth::user()->can('view_list', Supplier::class))
        {
            return view('pages.suppliers_view', ['suppliers' => Supplier::all()]);
        }
        return redirect()->back();
    }
}
