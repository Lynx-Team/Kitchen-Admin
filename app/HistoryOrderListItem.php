<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOrderListItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'short_name', 'long_name', 'supplier_name', 'quantity', 'total_cost', 'product_code', 'unit',
        'quantity', 'history_order_list_id'
    ];

    public function orderList()
    {
        $this->belongsTo('App\OrderList', 'order_list_id');
    }
}
