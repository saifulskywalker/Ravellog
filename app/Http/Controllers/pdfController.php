<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Issue;
use PDF;
use View;
use Carbon\Carbon;

class pdfController extends Controller
{
	//global variable for all function
	public function __construct()
	{
		$warehouses = Warehouse::get();
		View::share('warehouses',$warehouses);
	}
    public function pdfOngoingIssue()
    {
    	$nowTime = Carbon::now();
        $boxissues = Issue::whereNotIn('category',['truckopen','disabled'])->get();
        $pdf = PDF::loadView('pdf.pdfOngoingIssue',compact('boxissues','warehouses','nowTime'));
        return $pdf->stream('Report_Ongoing_Issue.pdf');
    }
    public function pdfTrackingIssue()
    {
        $nowTime = Carbon::now();
        $trackingissues = Issue::whereIn('category',['truckopen','disabled'])->join('moving_boxes','issues.inout_id','=','moving_boxes.id')->select('issues.*','moving_boxes.depart_from', 'moving_boxes.arrive_to')->get();
        $pdf = PDF::loadView('pdf.pdfTrackingIssue',compact('trackingissues','warehouses','nowTime'));
        return $pdf->stream('Report_Tracking_Issue.pdf');
    }
}
