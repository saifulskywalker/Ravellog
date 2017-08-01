<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InboundBox extends Model
{
    protected $table = 'inbound_boxes';
    
    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function box()
    {
    	return $this->belongsTo(Box::class);
    }

}
