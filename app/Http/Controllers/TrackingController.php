<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovingBox;
use App\Tracking;
use App\Warehouse;

class TrackingController extends Controller
{
    public function ontracking($id)
    {
    	$warehouse = Warehouse::get();
    	if ($id == 'default') {
    		$lists = MovingBox::orderBy('created_at','asc')->first();
            if ($lists) {
                $trackings = MovingBox::orderBy('created_at','asc')->first()->tracking;
            } else {
                $trackings = [];
            }
    	} else {
    		$lists = MovingBox::orderBy('created_at','asc')->get();
    		$trackings = MovingBox::find($id)->tracking;
    	}
    	return view('tracking.ontracking',compact('lists','trackings'));
    }
    public function finishtracking()
    {
        $lists =  MovingBox::withTrashed()->orderBy('created_at','asc')->paginate(20);
    	return view('tracking.finishtracking',compact('lists'));
    }
}
