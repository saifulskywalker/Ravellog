<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function ontracking()
    {
    	return view('tracking.ontracking');
    }
    public function finishtracking()
    {
    	return view('tracking.finishtracking');
    }
}
