<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function tag()
    {
    	return $this->belongsTo(Tag::class);
    }

    public function outbondBox()
    {
    	return $this->hasOne(OutboundBox::class);
    }

    public function InboundBox()
    {
    	return $this->hasOne(InboundBox::class);
    }
    
}
