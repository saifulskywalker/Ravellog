<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Box;
use App\Item;
use App\Tag;
use Session;
use Redirect;

class BoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::doesntHave('box')->pluck('tag');
        return view('box.createbox', compact('tags'));
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
            'category'      => 'required',
            'expire' => 'required|date',
            'item_name' => 'required',
            'quantity' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('boxes/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $box = new Box;
            $box->tag_tag       = Input::get('tag');
            $box->category      = Input::get('category');
            $box->expire_date   = Input::get('expire');
            $box->save();

            $box_id = $box->id;

            $item = Input::get('item_name');
            $quantity = Input::get('quantity');
            $counting = count($item);

            for ($i = 0; $i < $counting-1; $i++) {
                for ($j = $i+1; $j < $counting; $j++) {
                    if (($item[$i] == $item[$j]) AND $item[$i]!='x') {
                        $quantity[$i] = $quantity[$i] + $quantity[$j];
                        $item[$j] = 'x';
                        $quantity[$j] = 'x';
                    }
                }
            }


            foreach (array_combine($item,$quantity) as $item => $quantity) {
                if ($item != 'x') {
                    $items = new Item;
                    $items->box_id     = $box_id;
                    $items->asset_id   = $item;
                    $items->quantity   = $quantity;
                    $items->save();  
                }
                
            }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function outboundboxes(Request $request)
    {
        //
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
}
