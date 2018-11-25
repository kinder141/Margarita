<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Television extends Model
{
    protected $fillable = ['name', 'cpu', 'frequency', 'manufacture', 'display', 'price', 'amount'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function getCharacteristics()
    {
        return [
            'Cpu' => $this->cpu,
            'Frequency' => $this->frequency . ' GHz',
            'Manufacture' => $this->manufacture,
            'Display' => $this->display . ' inch',
        ];
    }
}
