<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderListItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['cost', 'completed', 'quantity', 'supplier_sort_order', 'kitchen_sort_order',
                           'supplier_id', 'order_list_id', 'item_id'];

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
