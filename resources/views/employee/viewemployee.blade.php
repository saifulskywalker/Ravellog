@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
        <legend style="padding-left:1em; padding-top:0.5em;">View Employee List</legend>
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
                                <th>Employee Tag</th>
                                <th>Employee Name</th>
                            </tr>
                            </thead>

                            <tbody>
                              @foreach($employees as $employee)
                                <tr>
                                  <td>{{$employee->tag_tag}}</td>
                                  <td>{{$employee->employee_name}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                          <div class="text-right">
                            {!! $employees->links(); !!}
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