<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutboundBox extends Model
{
    protected $table = 'outbound_boxes';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function box()
    {
    	return $this->belongsTo(Box::class);
    }

}
