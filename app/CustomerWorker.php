<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerWorker extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'customer_id', 'worker_id' ];

    public function customer() {
        return $this->belongsTo('App\User');
    }

    public function worker() {
        return $this->belongsTo('App\User');
    }
}
