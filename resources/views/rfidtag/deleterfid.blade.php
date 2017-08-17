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
                        <legend>Delete RFID Tag</legend>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div id="rfid_tag_fields"></div>
                        <div class="row profile-table">
                          <div class="col-sm-11 profile-table">
                            <div class="col-sm-12 form-group">
                            <label for="inputBoxTag">Delete RFID Tag</label>
                              <select type="text" class="form-control" id="multiselect" multiple="multiple" name='' placeholder="Delete RFID Tag" required>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-1 bottom-column">
                                <button class="btn btn-danger" type="button"  onclick="del_rfid_tag_fields();"><span class="glyphicon glyphicon-minus"></span></button>
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