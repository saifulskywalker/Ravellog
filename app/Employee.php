<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
