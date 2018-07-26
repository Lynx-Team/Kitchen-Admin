<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public $timestamps = false;

    public function orderListItems()
    {
        return $this->hasMany('App\OrderListItems');
    }
}
