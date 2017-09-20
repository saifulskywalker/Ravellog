@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
        <legend style="padding-left:1em; padding-top:0.5em;">Resolve ongoing Issue</legend>
            <div class="panel panel-success">
                    @if(Auth::check())
                    <form class="form-horizontal" style="padding:1em" method="POST" action="">
                    {{ csrf_field() }}
                      <fieldset>

                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxTag">Box Tag</label>
                              <select type="text" class="form-control" id="" name='' placeholder="Box Tag" disabled>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxName">Box Name</label>
                              <select type="text" class="form-control" id="" name='' placeholder="Box Name" disabled>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="inputBoxName">Justification</label>
                              <textarea class="form-control" rows="5" id="inputJustify" name='' placeholder="Justification" required>
                              </textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
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