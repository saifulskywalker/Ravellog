@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Finished Tracking</legend>
            @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="panel panel-success">
                    @if(Auth::check())
                    
                    {{ csrf_field() }}
                      <fieldset>
                        @if ($lists)
                        <div class="col-md-12">
                          <table class="table">
                            <thead>
                              <tr>
                                  <th>Truck ID</th>
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Arrival Date</th>
                              </tr>
                            </thead>

                            <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                  <td>{{$list->truck_id}}</td>
                                  <td>{{$list->depart_from}}</td>
                                  <td>{{$list->arrive_to}}</td>
                                  <td>{{$list->deleted_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>

                          <div class="text-right">
                            {!! $lists->links(); !!}
                          </div>    
                        </div>
                        @else
                          <div class="alert alert-info">No History</div>
                        @endif
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