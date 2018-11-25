<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['price', 'amount', 'product_id'];

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
