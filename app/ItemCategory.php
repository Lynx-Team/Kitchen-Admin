<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function Items()
    {
        return $this->hasMany('App\Items');
    }
}
