<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $fillable = ['name', 'cpu', 'ram', 'video_card', 'capacity', 'manufacture', 'battery', 'display', 'price', 'amount'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function getCharacteristics()
    {
        return [
            'Cpu' => $this->cpu,
            'Ram' => $this->ram . ' Mb',
            'Video Card' => $this->video_card,
            'Storage Capacity' => $this->capacity . ' Gb',
            'Manufacture' => $this->manufacture,
            'Battery' => $this->battery . ' Wth',
            'Display' => $this->display . ' inch',
            'Video' => ($this->video) ? 'Discrete' : 'Integrated',
        ];
    }
}
