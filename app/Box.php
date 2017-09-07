<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function tag() 
    {
    	return $this->belongsTo(Tag::class);
    }

    public function inboundBox()
    {
    	return $this->hasMany(InboundBox::class);
    }

    public function outboundBox()
    {
    	return $this->hasMany(OutboundBox::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
