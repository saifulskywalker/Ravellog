<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\InboundBox;
use App\OutboundBox;
use App\Box;
use App\MovingBox;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::get();
        $boxes = Box::count();
        $inboundboxes = InboundBox::whereNull('act_arrival_date')->join('boxes','inbound_boxes.box_id','=','boxes.id')->get();
        $outboundboxes = OutboundBox::whereNull('act_depart_date')->join('boxes','outbound_boxes.box_id','=','boxes.id')->get();
        $movingboxes = MovingBox::count();
        return view('dashboard',compact('warehouses','boxes','inboundboxes','outboundboxes','movingboxes'));
    }
}
