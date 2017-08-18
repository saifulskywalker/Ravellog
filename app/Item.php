<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function box()
    {
    	return $this->belongsTo(Box::class);
    }

    public function asset()
    {
    	return $this->belongsTo(Asset::class);
    }

    //
}
