@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="{{ route('boxes.store') }}">
                    {{ csrf_field() }}
                      <fieldset>
                        <legend>Add New Box</legend>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Box Tag</label>
                            <select type="text" class="form-control" id="inputBoxName" name='tag' placeholder="Box Tag" required>
                            @foreach ($tags as $tags)
                              <option>{{$tags}}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Box Category</label>
                            <input type="text" class="form-control" id="inputBoxName" name='category' placeholder="Category" required>
                            @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Expire Date</label>
                            <input type="text" class="form-control" id="datepicker" name='expire' placeholder="Expire Date" required>
                            @if ($errors->has('expire'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expire') }}</strong>
                                    </span>
                            @endif
                          </div>
                        </div>
                        <legend>Items Inside The Box</legend>
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