<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    public function tag() {
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
}
