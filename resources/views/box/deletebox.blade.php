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
                        <legend>Delete Box</legend>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div id="del_tag_fields"></div>
                        <div class="row profile-table">
                          <div class="col-sm-11 profile-table">
                            <div class="col-sm-12 form-group">
                            <label for="inputBoxTag">Delete Box</label>
                              <select type="text" class="form-control" id="" name='' placeholder="Delete Box" required>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-1 bottom-column">
                                <button class="btn btn-warning" type="button"  onclick="del_box_fields();"> </button>
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