@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Ongoing Tracking</legend>
            <div class="panel panel-success">
                    @if(Auth::check())
                    
                    {{ csrf_field() }}
                      <fieldset>
                        
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-12">
                          <table class="table">
                            <thead>
                              <tr>
                                  <th>Truck ID</th>
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><button class="btn btn-info" type="button" onclick=""><span>View</span></button></td>
                                </tr>
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