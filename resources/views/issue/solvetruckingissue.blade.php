@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
        <legend style="padding-left:1em; padding-top:0.5em;">Resolve Trucking Issue</legend>
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="">
                    {{ csrf_field() }}
                      <fieldset>

                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                            <label for="inputBoxTag">Truck ID</label>
                              <select type="text" class="form-control" id="" name='' placeholder="Truck ID" disabled>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="inputBoxName">From</label>
                              <select type="text" class="form-control" id="" name='' placeholder="From" disabled>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="inputBoxName">To</label>
                              <select type="text" class="form-control" id="" name='' placeholder="To" disabled>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="inputBoxName">Justification</label>
                              <textarea class="form-control" rows="5" id="inputJustify" name='' placeholder="Justification" required>
                              </textarea>
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
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