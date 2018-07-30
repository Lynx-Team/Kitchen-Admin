<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public $timestamps = false;

    protected $fillable = ['note', 'kitchen_id', 'completed'];

    public function orderListItems()
    {
        return $this->hasMany('App\OrderListItem');
    }

    public function kitchen()
    {
        return $this->belongsTo('App\User');
    }
}
