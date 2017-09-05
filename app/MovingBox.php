<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovingBox extends Model
{
    protected $table = 'moving_boxes';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function truck()
    {
    	return $this->belongsTo(Truck::class);
    }

    public function tracking()
    {
    	return $this->hasMany(Tracking::class);
    }

}
