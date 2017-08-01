<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
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
