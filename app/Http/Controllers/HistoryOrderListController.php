<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 22:55
 */

namespace App\Http\Controllers;


use App\HistoryOrderList;
use Illuminate\Support\Facades\Auth;

class HistoryOrderListController extends Controller
{
    public function view($kitchen_id)
    {
        if (Auth::check() && Auth::user()->can('view', HistoryOrderList::class))
            return view('pages.reporting', [
                'reports' => HistoryOrderList::where('kitchen_id', $kitchen_id)->get()
            ]);
        return redirect()->back();
    }
}