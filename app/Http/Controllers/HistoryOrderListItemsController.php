<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 23:19
 */

namespace App\Http\Controllers;


use App\HistoryOrderListItem;

class HistoryOrderListItemsController
{

    public function view($kitchen_id, $historyOrderList)
    {
        if (Auth::check() && Auth::user()->can('view', HistoryOrderListItem::class))
            return view('someview', [
                'history_order_list_items' => HistoryOrderListItem::where('history_order_list', $historyOrderList)->get()
            ]);

        return redirect()->back();
    }
}