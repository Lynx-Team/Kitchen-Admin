<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany('App\Items');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
