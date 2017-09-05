<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Truck extends Model
{
    public $timestamps = false;
    public function movingBox()
    {
    	return $this->hasMany(MovingBox::class);
    }

    public function tracking()
    {
    	return $this->hasMany(Tracking::class);
    }

}
