<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['order_list_item_id', 'item_id'];

    public function orderListItem()
    {
        return $this->hasOne('App\OrderListItem');
    }

    public function item()
    {
        return $this->hasOne('App\Item');
    }
}
