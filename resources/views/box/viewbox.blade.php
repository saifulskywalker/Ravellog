@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                    @if(Auth::check())
                    
                    {{ csrf_field() }}
                      <fieldset>
                        <legend style="padding-left:1em; padding-top:0.5em;">View Boxes</legend>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-12">
                          <table class="table">
                            <thread>
                                <th>Box Tag</th>
                                <th>Box Name</th>
                                <th>Warehouse</th>
                                <th>Position</th>
                                <th>Arrival Date</th>
                                <th>Expire Date</th>
                                <th>Item</th>
                            </thread>

                            <tbody>
                              @foreach($boxes as $box)
                                <tr>
                                  <td>{{$box->tag_tag}}</td>
                                  <td></td>
                                  <td>{{$box->warehouse}}</td>
                                  <td>{{$box->location}}</td>
                                  <td></td>
                                  <td>{{$box->expire_date}}</td>
                                  <td></td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                          <div class="text-right">
                            {!! $boxes->links(); !!}
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