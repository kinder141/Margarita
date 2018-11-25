<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function laptops(){
        return $this->hasMany('App\Laptop');
    }

    public function smartphones(){
        return $this->hasMany('App\Smartphone');
    }

    public function televisions(){
        return $this->hasMany('App\Television');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
