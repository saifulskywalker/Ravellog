<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function inbound(Request $request){
    	if ($request->has(['fromDate','toDate'])){
    		$fromDate = $request->fromDate;
            $toDate = $request->toDate;
            
            //to include data on the day of the deadline
            $endDate = $request->toDate.' '.'23:59:59';

    		$boxes = DB::table('inbound_boxes')
	    	->where('arrival_destination',auth()->user()->privilege)
	    	->join('boxes','inbound_boxes.box_id','=','boxes.id')
	    	->join('employees','inbound_boxes.employee_id','=','employees.id')
	    	->whereBetween('inbound_boxes.created_at',[$fromDate,$endDate])->paginate(10)
	    	->appends('fromDate',request('fromDate'))
	    	->appends('toDate',request('toDate'));

    	}else{
	    	$boxes = DB::table('inbound_boxes')
	    	->where('arrival_destination',auth()->user()->privilege)
	    	->join('boxes','inbound_boxes.box_id','=','boxes.id')
	    	->join('employees','inbound_boxes.employee_id','=','employees.id')
	       	->paginate(10);
    	}
    	return view('report.inbound',compact('boxes'));
    }
}
