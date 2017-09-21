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
    	$trackingissues = Issue::whereIn('category',['truckopen','disabled'])->join('moving_boxes','issues.inout_id','=','moving_boxes.id')->select('issues.*','moving_boxes.depart_from', 'moving_boxes.arrive_to')->get();
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

    public function ontrackingissue($id) 
    {
    	$issues = Issue::whereIn('category',['truckopen','disabled'])->where('issues.id',$id)->join('moving_boxes','issues.inout_id','=','moving_boxes.id')->select('issues.*','moving_boxes.depart_from', 'moving_boxes.arrive_to')->get();
    	return view('issue.solvetrackingissue',compact('issues'));
        // return compact('issues');
    }

    public function storeboxissue(Request $request) 
    {

    	// validate
     //    read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'justification'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('onissue')
                ->withErrors($validator)
                ->withInput();
        } else {
        	$id = Input::get('id');
        	$cat = Input::get('cat');
        	$inout = Input::get('inout_id');
        	$justification = Input::get('justification');


        	if ($cat == 'latein') {
        		InboundBox::destroy($inout);
        	} elseif ($cat == 'lateout') {
        		OutboundBox::destroy($inout);
        	}

        	$issue = Issue::find($id);
        	$issue->justification = Input::get('justification');
        	$issue->user = Input::get('user');
        	$issue->save();
        	$issue->delete();

        	// redirect
            Session::flash('message', 'Successfully recorded justification!');
            return Redirect::to('onissue');
        }
    }

    public function storetrackingissue(Request $request) 
    {

        // validate
     //    read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'justification'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // validation for the post data
        if ($validator->fails()) {
            return Redirect::to('onissue')
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = Input::get('id');
            $cat = Input::get('cat');
            $inout = Input::get('inout_id');
            $justification = Input::get('justification');


            $issue = Issue::find($id);
            $issue->justification = Input::get('justification');
            $issue->user = Input::get('user');
            $issue->save();
            $issue->delete();

            // redirect
            Session::flash('message', 'Successfully recorded justification!');
            return Redirect::to('onissue');
        }
    }
}
