@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
        <legend style="padding-left:1em; padding-top:0.5em;">Shipping In
        	<span id="control-panel">
        	  <a title="Export as pdf" data-toggle="modal" data-target="#exportModal"><button class="btn btn-info btn-sm">Export</button></a>
        	</span>
        </legend>
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
                                <th>Box Tag</th>
                                <th>Box Name</th>
                                <th>Arrival Date</th>
                                <th>Person in Charge</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($boxes as $box)
                                <tr>
                                  <td>{{$box->tag_tag}}</td>
                                  <td>{{$box->name}}</td>
                                  <td>{{$box->exp_arrival_date}}</td>
                                  <td>{{$box->employee_name}}</td>
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

	<!-- exportModal -->
	<div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Report Range
	      </div>
	      <div class="modal-body">
	        <fieldset>
	          <form role="form" action="{{route('pdfInbound')}}" method="GET">
	            <div class="col-sm-5">
	              <div class="form-group">
	                <input type="text" name="fromDate" id="datepicker1" class="form-control" placeholder="From" placeholder="From" required>
	              </div>
	            </div>
	            <div class="col-sm-5">
	              <div class="form-group">
	                <input type="text" name="toDate" id="datepicker2" class="form-control" placeholder="To" placeholder="To" required>
	              </div>
	            </div>
	            <div class="col-sm-2">	
		            <div class="form-group">
		              <button type="submit" class="btn btn-primary">Export</button>
		            </div>
		        </div>
	          </form>
	        </fieldset>
	      </div>
	    </div>
	  </div>
	</div>

</div>
@endsection