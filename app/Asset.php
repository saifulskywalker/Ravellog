<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function item()
    {
    	return $this->hasMany(Item::class);
    }
}
