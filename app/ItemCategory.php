<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public $timestamps = false;

    public function Items()
    {
        return $this->hasMany('App\Items');
    }
}
