<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function getIsAdminAttribute() {
        return $this->role->name === 'admin';
    }

    public function getIsKitchenAttribute() {
        return $this->role->name === 'kitchen';
    }

    public function getIsManagerAttribute()  {
        return $this->role->name === 'manager';
    }

    public function orderLists() {
        return $this->hasMany('App\OrderList');
    }

    public function items() {
        return $this->hasMany('App\Item');
    }
}
