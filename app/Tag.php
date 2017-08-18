<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{ // or null

	protected $primaryKey = 'tag';
    public $incrementing = false;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function employee()
    {
    	return $this->hasOne(Employee::class);
    }

    public function box()
    {
    	return $this->hasOne(Box::class);
    }
}
