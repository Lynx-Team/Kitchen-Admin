<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'email', 'kitchen_id', ];

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function orderListItems()
    {
        return $this->hasMany('App\OrderListItem');
    }
}
