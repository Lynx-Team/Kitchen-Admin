<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOrderList extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'note', 'kitchen_name', 'last_update_date', 'order_list_id', 'customer_id' ];

    public function orderList()
    {
        $this->belongsTo('App\OrderList', 'order_list_id');
    }

    public function kitchen()
    {
        $this->belongsTo('App\User', 'kitchen_id');
    }
}
