<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 22:55
 */

namespace App\Http\Controllers;


use App\HistoryOrderList;

class HistoryOrderListController extends Controller
{
    public function view($kitchen_id)
    {
        if (Auth::check() && Auth::user()->can('view', HistoryOrderList::class))
            return view('someview', [
                'history_order_lists' => HistoryOrderList::where('kitchen_id', $kitchen_id)->get()
            ]);

        return redirect()->back();
    }
}