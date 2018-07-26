<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\ItemCategory');
    }

    public function defaultSupplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
