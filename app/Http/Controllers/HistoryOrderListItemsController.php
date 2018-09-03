<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 23:19
 */

namespace App\Http\Controllers;


use App\HistoryOrderListItem;
use Illuminate\Support\Facades\Auth;

class HistoryOrderListItemsController
{

    public function view($kitchen_id, $historyOrderList)
    {
        if (Auth::check() && Auth::user()->can('view', HistoryOrderListItem::class))
            return view('pages.reporting_items', [
                'items' => HistoryOrderListItem::where('history_order_list_id', $historyOrderList)->get()
            ]);

        return redirect()->back();
    }
}