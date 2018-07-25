<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    public function orderList()
    {
        return $this->belongsTo('App\OrderList');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
