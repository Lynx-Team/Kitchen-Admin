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

    public function getIsCustomerAttribute() {
        return $this->role->name === 'customer';
    }

    public function getIsSuperuserAttribute() {
        return $this->role->name === 'superuser';
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

    public function categories() {
        return $this->hasMany('App\ItemCategory');
    }

    public function kitchenProfile() {
        return $this->hasOne('App\KitchenProfile', 'kitchen_id');
    }

    public function customerWorkers() {
        return $this->hasMany('App\CustomerWorker', 'customer_id');
    }

    public function worker() {
        return $this->hasOne('App\CustomerWorker', 'worker_id');
    }

    public function customer() {
        return $this->worker->customer()->get()[0];
    }

    public function kitchen() {
        $this->hasMany('App\HistoryOrderList', 'kitchen_id');
    }
}
