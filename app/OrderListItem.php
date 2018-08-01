<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderListItem extends Model
{
    public $timestamps = false;

    public function order_list()
    {
        return $this->belongsTo('App\OrderList');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
