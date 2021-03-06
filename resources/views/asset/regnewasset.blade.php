@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
        <legend style="padding-left:1em; padding-top:0.5em;">Register New Asset</legend>
        @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="{{ route('boxes.store') }}">
                    {{ csrf_field() }}
                      <fieldset>
                        
                        <div id="rfid_tag_fields"></div>
                        <div class="row profile-table">
                          <div class="col-sm-11 profile-table">
                            <div class="col-sm-12 form-group">
                            <label for="inputBoxTag">Item Name</label>
                              <input type="text" class="form-control" id="item-name" name="item_name_fields[]" value="" placeholder="Item Name" required>
                            </div>
                          </div>
                          <div class="col-sm-1 bottom-column">
                                <button class="btn btn-success" type="button"  onclick="item_name();"> <span class="glyphicon glyphicon-plus"></span> </button>
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