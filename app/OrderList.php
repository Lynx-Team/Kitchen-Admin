<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public $timestamps = false;

    protected $fillable = ['note', 'kitchen_id', 'completed'];

    public function order_list_items()
    {
        return $this->hasMany('App\OrderListItem');
    }

    public function kitchen()
    {
        return $this->belongsTo('App\User');
    }

    public function availableItems()
    {
        return $this->hasMany('App\AvailableItem');
    }
}
