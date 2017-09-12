@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
        <legend style="padding-left:1em; padding-top:0.5em;">Shipping Out</legend>
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="{{ route('boxes.outboundboxes') }}">
                    {{ csrf_field() }}
                      <fieldset>
                        
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Box Tag</label>
                            <select type="text" class="form-control" id="multiselect" multiple="multiple" name='box_id[]' placeholder="Box Tag" required>
                            @if (auth()->user()->privilege == 'superuser')
                              @foreach ($boxes as $box)
                                <option value="{{$box->id}}">{{$box->tag_tag}}</option>
                              @endforeach
                            @else
                              @foreach ($boxes as $box)
                                @if ($box->warehouse == auth()->user()->privilege)
                                  <option value="{{$box->id}}">{{$box->tag_tag}}</option>
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
                            @if ($errors->has('expire'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expire') }}</strong>
                                    </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Departure Destination</label>
                            <input type="text" class="form-control" id="" name='destination' placeholder="Departure Destination" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Person in Charge</label>
                            <select type="text" class="form-control" id="" name='employee' placeholder="Person in Charge" required>
                            @foreach ($employee as $id => $name)
                              <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name='warehouse' value = "{{auth()->user()->privilege}}">
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
