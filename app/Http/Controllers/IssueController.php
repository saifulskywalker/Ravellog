<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Issue;
use App\InboundBox;
use App\OutboundBox;
use Session;
use Redirect;
use DB;

class IssueController extends Controller
{
    public function onissue()
    {
    	$boxissues = Issue::whereNotIn('category',['truckopen','disabled'])->get();
    	$trackingissues = Issue::whereIn('category',['truckopen','disabled'])->join('moving_boxes','issues.inout_id','=','moving_boxes.id')->get();
    	return view('issue.onissue', compact('boxissues','trackingissues'));
    }
    public function resolveissue()
    {
    	return view('issue.resolveissue');
    }

    public function onboxissue($id) 
    {
    	$issue = Issue::find($id);
    	return view('issue.solveongoingissue',compact('issue'));
    }

    public function storeboxissue(Request $request) 
    {
    	// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'id'       => 'required',
            'justification'       => 'required',
            'category' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('onissue')
                ->withErrors($validator)
                ->withInput();
        } else {
        	$id = Input::get('id');
        	$cat = Input::get('category');
        	$inout = Input::get('inout_id');
        	$justification = Input::get('justification');

        	return $id;
        	// $issue = Issue::find($id);
        	// $issue->justification = Input::get('justification');
        	// $issue->user = Input::get('user');
        	// $issue->save();
        	// $issue->delete();

        	// if ($cat == 'latein') {
        	// 	InboundBox::destroy($inout);
        	// } elseif ($cat == 'lateout') {
        	// 	OutboundBox::destroy($inout);
        	// }

        	// // redirect
         //    Session::flash('message', 'Successfully recorded justification!');
         //    return Redirect::to('onissue');
        }
    }
}
