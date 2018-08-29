<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'short_name', 'full_name', 'default_supplier_id', 'category_id', 'cost',
        'kitchen_id', 'product_code', 'unit',
    ];

    public function category()
    {
        return $this->belongsTo('App\ItemCategory');
    }

    public function defaultSupplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function orderListItems()
    {
        return $this->hasMany('App\OrderListItem');
    }

    public function availableItems()
    {
        return $this->hasMany('App\AvailableItem');
    }

    public function kitchen()
    {
        return $this->belongsTo('App\User');
    }
}
