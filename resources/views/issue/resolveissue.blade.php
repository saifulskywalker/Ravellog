@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Resolved Issues</legend>
            @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="panel panel-success">
                    @if(Auth::check())
                    
                    {{ csrf_field() }}
                      <fieldset>
                        <div class="col-md-12">
                          <table class="table">
                            <thead>
                              <tr>
                                  <th>Box Tag/Truck ID</th>
                                  <th>Issue</th>
                                  <th>Justification</th>
                                  <th>User</th>
                              </tr>
                            </thead>

                            <tbody>
                            @if (empty($issues[0]))
                                <tr>
                                  <td>No Resolved Issue</td>
                                </tr>
                            @else
                              @foreach ($issues as $issue)
                                @if ($issue->category == 'truckopen' || $issue->category == 'disabled')
                                <tr>
                                  <td>{{$issue->truck_id}}</td>
                                  <td>{{$issue->category}}</td>
                                  <td>{{$issue->justification}}</td>
                                  <td>{{$issue->user}}</td>
                                </tr>
                                @else
                                <tr>
                                  <td>{{$issue->box_tag}}</td>
                                  <td>{{$issue->category}}</td>
                                  <td>{{$issue->justification}}</td>
                                  <td>{{$issue->user}}</td>
                                </tr>
                                @endif
                              @endforeach
                            @endif
                            </tbody>
                          </table>

                          <div class="text-right">
                            
                          </div>    
                        </div>
                      </fieldset>
                    
                    @endif

            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-warning">You need to login to access this page</a>
            @endif
        </div>
    </div>
</div>
@endsection