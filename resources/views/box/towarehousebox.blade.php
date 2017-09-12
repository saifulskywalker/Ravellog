@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
        <legend style="padding-left:1em; padding-top:0.5em;">Warehouse to Warehouse Shipping</legend>
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="{{ route('boxes.movingboxes') }}">
                    {{ csrf_field() }}
                      <fieldset>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Boxes</label>
                            <select type="text" class="form-control" id="multiselect" multiple="multiple" name='box_id[]' placeholder="Boxes" required>
                            @if (auth()->user()->privilege == 'superuser')
                              @foreach ($boxes as $box)
                                <option value="{{$box->id}}">{{$box->tag_tag}} , {{$box->name}}</option>
                              @endforeach
                            @else
                              @foreach ($boxes as $box)
                                @if ($box->warehouse == auth()->user()->privilege)
                                  <option value="{{$box->id}}">{{$box->tag_tag}} , {{$box->name}}</option>
                                @endif
                              @endforeach
                            @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Departure From</label>
                            <select type="text" class="form-control" id="" name='from' placeholder="Departure From" required>
                            @if (auth()->user()->privilege == 'superuser')
                              @foreach ($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}|{{$warehouse->name}}">{{$warehouse->name}}</option>
                              @endforeach
                            @else
                              @foreach ($warehouses as $warehouse)
                                @if ($warehouse->id == auth()->user()->privilege)
                                  <option value="{{$warehouse->id}}|{{$warehouse->name}}">{{$warehouse->name}}</option>
                                @endif
                              @endforeach
                            @endif
                            

                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Arrival Destination</label>
                            <select type="text" class="form-control" id="" name='to' placeholder="Arrival Destination" required>
                            @if (auth()->user()->privilege == 'superuser')
                              @foreach ($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}|{{$warehouse->name}}">{{$warehouse->name}}</option>
                              @endforeach
                            @else
                              @foreach ($warehouses as $warehouse)
                                @if ($warehouse->id != auth()->user()->privilege)
                                  <option value="{{$warehouse->id}}|{{$warehouse->name}}">{{$warehouse->name}}</option>
                                @endif
                              @endforeach
                            @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Expected Departure Date</label>
                            <input type="text" class="form-control" id="datepicker1" name='expect_dep_date' placeholder="Expected Departure Date" required>
                            @if ($errors->has('expect_dep_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expect_dep_date') }}</strong>
                                    </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Expected Arrival Date</label>
                            <input type="text" class="form-control" id="datepicker2" name='expect_arr_date' placeholder="Expected Arrival Date" required>
                            @if ($errors->has('expect_arr_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expect_arr_date') }}</strong>
                                    </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Truck</label>
                            <select type="text" class="form-control" id="" name='truck' placeholder="Truck" required>
                            @foreach ($trucks as $id => $name)
                              <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                            
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Person in Charge</label>
                            <select type="text" class="form-control" id="" name='employee' placeholder="Person in Charge" required>
                            @foreach ($employees as $id => $name)
                              <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                          <br>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    @endif
            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-warning">You need to login to access this page</a>
            @endif
        </div>
    </div>
</div>
@endsection
