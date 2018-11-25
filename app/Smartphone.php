<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    protected $fillable = ['name', 'cpu', 'ram', 'capacity', 'manufacture', 'battery', 'display', 'price', 'amount', 'sd_card'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function getCharacteristics()
    {
        return [
            'Cpu' => $this->cpu,
            'Ram' => $this->ram . ' Mb',
            'Storage Capacity' => $this->capacity . ' Gb',
            'Manufacture' => $this->manufacture,
            'Battery' => $this->battery . ' Wth',
            'Display' => $this->display . ' inch',
            'Sd Card' => ($this->sd_card) ? 'Yes' : 'No',
            'Video' => ($this->video) ? 'Discrete' : 'Integrated',
        ];
    }
}
