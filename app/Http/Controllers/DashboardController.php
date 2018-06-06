<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\InboundBox;
use App\OutboundBox;
use App\Box;
use App\MovingBox;
use App\Issue;
use App\Item;
use DB;

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
        $assets = Item::select(DB::raw('name, sum(quantity) as quant'))->join(DB::raw('(select id, warehouse from boxes where warehouse is not null and deleted_at is null) as box'),'box.id','=','items.box_id')->groupBy('name')->get();
        $warehouses = Warehouse::get();
        $boxes = Box::whereNotNull('warehouse')->count();
        $inboundboxes = InboundBox::whereNull('act_arrival_date')->join('boxes','inbound_boxes.box_id','=','boxes.id')->paginate(10);
        $outboundboxes = OutboundBox::whereNull('act_depart_date')->join('boxes','outbound_boxes.box_id','=','boxes.id')->paginate(10);
        $numbermovingboxes = MovingBox::count();
        $movingboxes = MovingBox::get();
        $issues = Issue::count();
        return view('dashboard',compact('warehouses','boxes','inboundboxes','outboundboxes','movingboxes','issues','numbermovingboxes','assets'));
        // return compact('warehouses','boxes','inboundboxes','outboundboxes','movingboxes','issues','numbermovingboxes');
    }
}
