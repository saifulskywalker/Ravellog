<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Issue;
use PDF;
use View;
use Carbon\Carbon;
use DB;

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
    public function pdfInbound(request $request){
        $nowTime = Carbon::now();
        if($request->has(['fromDate','toDate'])){
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;

            //to include data on the day of the deadline
            $endDate = $request->toDate.' '.'23:59:59';

            $boxes = DB::table('inbound_boxes')
            ->where('arrival_destination',auth()->user()->privilege)
            ->join('boxes','inbound_boxes.box_id','=','boxes.id')
            ->join('employees','inbound_boxes.employee_id','=','employees.id')
            ->whereBetween('inbound_boxes.created_at',[$fromDate,$endDate])->get();

            $pdf = PDF::loadView('pdf.pdfInbound',compact('boxes','warehouses','nowTime','fromDate','toDate'));
            $fileName = 'Report_Inbound_Box_from'.$fromDate.'_to'.$toDate.'.pdf';
            return $pdf->download($fileName);
        }
    }
}
