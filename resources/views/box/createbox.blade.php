@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
        <legend style="padding-left:1em; padding-top:0.5em;">Shipping In New Box</legend>
        @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="{{ route('boxes.store') }}">
                    {{ csrf_field() }}
                      <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Box Tag</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                                  <select type="text" class="form-control" id="inputBoxName" name='tag' placeholder="Box Tag" required>
                                  @foreach ($tags as $tags)
                                    <option>{{$tags}}</option>
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Box Name</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="fa fa-cube" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" id="inputBoxName" name='name' placeholder="Name" required>
                                    @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Warehouse</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                  <select type="text" class="form-control" id="inputBoxName" name='warehouse' placeholder="Warehouse" required>
                                  @if (auth()->user()->privilege == 'admin')
                                    @foreach ($warehouses as $warehouse)
                                      <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @endforeach
                                  @else
                                    @foreach ($warehouses as $warehouse)
                                      @if ($warehouse->id == auth()->user()->privilege)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                      @endif
                                    @endforeach
                                  @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Arrival Date</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                  <input type="text" class="form-control" id="datepicker1" name='arrival' placeholder="Arrival Date" required>
                                  @if ($errors->has('arrival'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('arrival') }}</strong>
                                          </span>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Expire Date</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                  <input type="text" class="form-control" id="datepicker2" name='expire' placeholder="Expire Date" required>
                                  @if ($errors->has('expire'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('expire') }}</strong>
                                          </span>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="inputBoxTag">Person in Charge</label>
                                <div class="input-group col-md-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                  <select type="text" class="form-control" id="" name='employee' placeholder="Person in Charge" required>
                                  @foreach ($employees as $id => $name)
                                    <option value="{{$id}}">{{$name}}</option>
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row" style="padding-left: 15px;">
                          <legend style="padding-left: 0.5em;"> Items Inside The Box </legend>
                          <div id="item_fields"></div>
                          <div class="row profile-table">
                            <div class="col-sm-8 profile-table">
                              <div class="col-sm-12 form-group">
                              <label for="inputBoxTag">Item Name</label>
                                <input type="text" class="form-control" id="item-name" name="item_name[]" value="" placeholder="Item Name" required>
                              </div>
                            </div>
                            <div class="col-sm-3 profile-table">
                              <div class="col-sm-12 form-group no-padding">
                                <label for="inputBoxTag">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity[]" value="" placeholder="Quantity" required>
                              </div>
                            </div>
                            <div class="col-sm-1 bottom-column">
                                  <button class="btn btn-success" type="button"  onclick="item_fields();"> <span class="glyphicon glyphicon-plus"></span> </button>
                            </div>
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