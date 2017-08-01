<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{ // or null

	protected $primaryKey = 'tag';
    public $incrementing = false;

    public function employee()
    {
    	return $this->hasOne(Employee::class);
    }

    public function box()
    {
    	return $this->hasOne(Box::class);
    }
}
