<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box;
use App\InboundBox;
use App\OutboundBox;

class APIController extends Controller
{
    public function entrancegate(Request $request) {

    	$akey = $request->input('akey');
    	$warehouse = $request->input('warehouse');
    	$string = $request->input('data');
    	$data = explode(" ", $string);
    	$date = date('Y-m-d');
    	$log =[];

    	if ($akey === '$2a$10$WUyUQl8SG0wZjOsCb1UfZe9Q1MfEZTNE/.uYftB75366.ph.u5euy') {
    		foreach ($data as $tag) {
    			$box = Box::where('tag_tag',$tag)->first();
    			if ($box) {
    				$id = $box->id;
    				$box->warehouse = $warehouse;
    				$box->save();
    				$log[$tag][1] = 'saving to box success';

    				$inbox = InboundBox::where('box_id',$id)->whereNull('act_arrival_date')->first();
    				if($inbox) {
    					$inbox->act_arrival_date = $date;
    					$inbox->save();
    					$log[$tag][2] = 'saving to inboundbox success';
    				} else {
    					$log[$tag][2] = 'saving to inboundbox failed';
    				}

    			} else {
    				$log[$tag][1] = 'saving to box fail';
    				$log[$tag][2] = 'saving to inboundbox fail';
    			}
  
    		}
    	}
    	return compact('log');
    }



    public function exitgate(Request $request) {

        $akey = $request->input('akey');
        $warehouse = $request->input('warehouse');
        $string = $request->input('data');
        $data = explode(" ", $string);
        $date = date('Y-m-d');
        $log =[];

        if ($akey === '$2a$10$WUyUQl8SG0wZjOsCb1UfZe9Q1MfEZTNE/.uYftB75366.ph.u5euy') {
            foreach ($data as $tag) {
                $box = Box::where('tag_tag',$tag)->first();
                if ($box) {
                    $id = $box->id;
                    $box->warehouse = $warehouse;
                    $box->save();
                    $log[$tag][1] = 'saving to box success';

                    $outbox = OutboundBox::where('box_id',$id)->whereNull('act_depart_date')->first();
                    if($outbox) {
                        $outbox->act_depart_date = $date;
                        $outbox->save();
                        $log[$tag][2] = 'saving to outboundbox success';
                    } else {
                        $log[$tag][2] = 'saving to outboundbox failed';
                    }

                } else {
                    $log[$tag][1] = 'saving to box fail';
                    $log[$tag][2] = 'saving to inboundbox fail';
                }
  
            }
        }
        return compact('log');
    }
}
