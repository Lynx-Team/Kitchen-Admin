<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitchenProfile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'kitchen_id', 'company_name', 'contact_name', 'postal_address', 'delivery_address',
        'phone', 'delivery_instructions',
    ];

    public function kitchen()
    {
        return $this->belongsTo('App\User');
    }
}
