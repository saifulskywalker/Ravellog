<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Box;
use App\Item;
use App\Tag;
use App\Employee;
use App\InboundBox;
use App\OutboundBox;
use App\Truck;
use App\Warehouse;
use App\Tracking;
use App\MovingBox;
use Session;
use Redirect;
use DB;

class BoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $boxes = Box::orderBy('expire_date', 'asc')->paginate(10);

        $boxes = Box::whereNotNull('warehouse')->join(DB::raw('(select id,name as warehouse_name from warehouses) as whs'),'whs.id','=','boxes.warehouse')->join(DB::raw("(select box_id, GROUP_CONCAT(concat(name,' = ',quantity) SEPARATOR '\n') as barang from items group by box_id) as F"),'F.box_id','=','boxes.id')->paginate(10);
        return view('box.viewbox')->withBoxes($boxes);
    }

    /**
     * Show the form for creating a new inboundbox.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbound()
    {
        $box = Box::doesntHave('inboundbox')->pluck('tag_tag','id');
        $employeeTags = Tag::has('employee')->pluck('tag');
        $employee = Employee::pluck('employee_name','tag_tag');
        return view('box.inboundbox', compact( 'box','employee'));
    }

    public function moving()
    {
        $temp1 = Box::doesntHave('inboundbox')->get();
        $temp2 = Box::doesntHave('outboundbox')->get();
        $boxes = $temp1->intersect($temp2);
        $trucks = Truck::doesntHave('movingbox')->pluck('name','id');
        $employees = Employee::pluck('employee_name','id');
        $warehouses = Warehouse::all();
        return view('box.towarehousebox', compact( 'boxes','employees','warehouses','trucks'));
    }


    /**
     * Show the form for creating a new inboundbox.
     *
     * @return \Illuminate\Http\Response
     */
    public function outbound()
    {
        $inbox = Box::doesntHave('outboundbox')->get();
        $outbox = Box::doesntHave('inboundbox')->get();
        $boxes = $inbox->intersect($outbox);
        $employeeTags = Tag::has('employee')->pluck('tag');
        $employee = Employee::pluck('employee_name','id');
        return view('box.outboundbox', compact( 'boxes','employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boxtag = Tag::doesntHave('box')->pluck('tag');
        $employeetags = Tag::doesntHave('employee')->pluck('tag');
        $tags = $boxtag->intersect($employeetags);
        $employeeTags = Tag::has('employee')->pluck('tag');
        $employees = Employee::pluck('employee_name','id');
        $warehouses = Warehouse::get();
        return view('box.createbox', compact('tags','warehouses','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'tag'       => 'required',
            'name'      => 'required',
            'warehouse'      => 'required',
            'arrival'      => 'required|date',
            'expire' => 'required|date',
            'employee'      => 'required',
            'item_name' => 'required',
            'quantity' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('boxes/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store to boxes column
            $box = new Box;
            $box->tag_tag       = Input::get('tag');
            $box->name      = Input::get('name');
            $box->expire_date   = Input::get('expire');
            $box->save();

            //get the box id that was just stored to database
            $box_id = $box->id;

            //get the post data for the items
            $item = Input::get('item_name');
            $quantity = Input::get('quantity');
            $counting = count($item);

            //concantenate the input redundants
            //if the user input the same item more than once, this script will sum the total of said item
            for ($i = 0; $i < $counting-1; $i++) {
                for ($j = $i+1; $j < $counting; $j++) {
                    if (($item[$i] == $item[$j]) AND $item[$i]!='x') {
                        $quantity[$i] = $quantity[$i] + $quantity[$j];
                        $item[$j] = 'x';
                        $quantity[$j] = 'x';
                    }
                }
            }

            //store the items to the database
            foreach (array_combine($item,$quantity) as $item => $quantity) {
                if ($item != 'x') {
                    $items = new Item;
                    $items->box_id     = $box_id;
                    $items->name   = $item;
                    $items->quantity   = $quantity;
                    $items->save();  
                }
                
            }

            //store box as inbound box
            $expect_arr_date = Input::get('arrival');
            $arrival_destination = Input::get('warehouse');
            $employee = Input::get('employee');
                
                $inbox = new InboundBox;
                $inbox->box_id                = $box_id;
                $inbox->exp_arrival_date      = $expect_arr_date;
                $inbox->arrival_destination   = $arrival_destination;
                $inbox->employee_id           = $employee;
                $inbox->save();

            // redirect
            Session::flash('message', 'Successfully created box!');
            return Redirect::to('boxes/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function inboundboxes(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'box_id'       => 'required',
            'expect_arr_date' => 'required|date',
            'warehouse' => 'required',
            'employee' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('inboundbox')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store to inbound_boxes column
            $inbound = Input::get('box_id');
            $expect_arr_date = Input::get('expect_arr_date');
            $arrival_destination = Input::get('warehouse');
            $employee = Input::get('employee');

            foreach ($inbound as $in) {
                $box = new InboundBox;
                $box->box_id                = $in;
                $box->exp_arrival_date      = $expect_arr_date;
                $box->arrival_destination   = $arrival_destination;
                $box->employee_id           = $employee;
                $box->save();
            }
            

            // redirect
            Session::flash('message', 'Successfully recorded entries for inbound boxes!');
            return Redirect::to('inboundbox');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function outboundboxes(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'box_id'       => 'required',
            'expect_dep_date' => 'required|date',
            'destination' => 'required',
            'employee' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('outboundbox')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store to inbound_boxes column
            $outbound = Input::get('box_id');
            $expect_dep_date = Input::get('expect_dep_date');
            $warehouse = Input::get('warehouse');
            $depart_destination = Input::get('destination');
            $employee = Input::get('employee');

            foreach ($outbound as $out) {
                $box = new OutboundBox;
                $box->box_id                = $out;
                $box->exp_depart_date      = $expect_dep_date;
                $box->depart_destination   = $depart_destination;
                $box->warehouse             = $warehouse;
                $box->employee_id           = $employee;
                $box->save();

                $delete = Box::find($out);
                $delete->item()->delete();
                Box::destroy($outbound);
            }
            

            // redirect
            Session::flash('message', 'Successfully recorded entries for outbound boxes!');
            return Redirect::to('outboundbox');
        }
    }

    public function movingboxes(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'box_id'       => 'required',
            'from'       => 'required',
            'to'       => 'required',
            'expect_dep_date' => 'required|date',
            'expect_arr_date' => 'required|date',
            'truck' => 'required',
            'employee' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('outboundbox')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store to inbound_boxes column
            $boxes = Input::get('box_id');
            $expect_dep_date = Input::get('expect_dep_date');
            $expect_arr_date = Input::get('expect_arr_date');
            $to = Input::get('to');
            $employee = Input::get('employee');
            $truck = Input::get('truck');
            $from = Input::get('from');

            foreach ($boxes as $box) {
                $out = new OutboundBox;
                $out->box_id                = $box;
                $out->exp_depart_date      = $expect_dep_date;
                $out->depart_destination   = $to;
                $out->warehouse             = $from;
                $out->employee_id           = $employee;
                $out->save();

                $in = new InboundBox;
                $in->box_id                = $box;
                $in->exp_arrival_date      = $expect_arr_date;
                $in->arrival_destination   = $to;
                $in->employee_id           = $employee;
                $in->save();
            }

            $move = new MovingBox;
            $move->depart_from          = $from;
            $move->arrive_to            = $to;
            $move->truck_id             = $truck;
            $move->save();
            

            // redirect
            Session::flash('message', 'Successfully recorded entries for warehouse-to-warehouse shipping!');
            return Redirect::to('movingbox');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
    public function delete()
    {
        return view('box.deletebox');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}