<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutboundBox extends Model
{
    protected $table = 'outbound_boxes';

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function box()
    {
    	return $this->belongsTo(Box::class);
    }

}
