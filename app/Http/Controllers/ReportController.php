<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function inbound(){
    	$boxes = DB::table('inbound_boxes')
    	->where('arrival_destination',auth()->user()->privilege)
    	->join('boxes','inbound_boxes.box_id','=','boxes.id')
    	->join('employees','inbound_boxes.employee_id','=','employees.id')
       	->paginate(10);
    	return view('report.inbound',compact('boxes'));
    }
}
