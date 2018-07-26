<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public $timestamps = false;

    public function order_list()
    {
        return $this->hasMany('App\Item');
    }
}
