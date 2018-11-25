<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'amount', 'payment_method', 'status', 'date'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
