@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<legend>Dashboard 
		<span style="font-size: 14px;">
			@if (auth()->user()->privilege == 'superuser')
                | All Warehouses
            @else
                @foreach ($warehouses as $warehouse)
                    @if (auth()->user()->privilege == $warehouse->id)
                        | {{$warehouse->name}}
                    @endif
                @endforeach
            @endif
		</span>
	</legend>
    <div class="row">
        <div class="dashboard-info">
            <!-- Dashboard Info -->
            <div class="row">

				<div class="col-md-8">
					<div class="row">
		                <div class="">
		                    <div class="col-xs-4">
		                        <div class="panel panel-1">
		                            <div class="panel-heading">
		                                Vehicle on the Way
		                            </div>
		                            <div class="panel-body">
		                                {{$numbermovingboxes}}
		                                <span class="pull-right">
		                                	<i class="fa fa-truck" aria-hidden="true"></i>
		                                </span>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-xs-4">
		                        <div class="panel panel-2">
		                            <div class="panel-heading">
		                                Number of Boxes
		                            </div>
		                            <div class="panel-body">
		                                {{$boxes}}
		                                <span class="pull-right">
		                                	<i class="fa fa-cube" aria-hidden="true"></i>
		                                </span>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-xs-4">
		                        <div class="panel panel-3">
		                            <div class="panel-heading">
		                                Number of Assets
		                            </div>
		                            <div class="panel-body">
                                        {{sizeof($assets)}}
		                                <span class="pull-right">
		                                	<i class="fa fa-dropbox" aria-hidden="true"></i>
		                                </span>
		                            </div>
		                        </div>
		                    </div>
		                    
		                </div>
		            </div>
		        </div>
		        <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                        	<span class="glyphicon glyphicon-warning-sign"></span>
                            Warning
                        </div>
                        <div class="panel-body">
                        @if ($issues == 0)
                            <a href="#">There is no warning</a>
                        @else
                            <a href="{{route('issue.onissue')}}">There is {{$issues}} warning</a>
                        @endif
                        </div>
                    </div>
		        </div>

            </div><!-- /dashboard-info -->

            <!-- Dashboard Tracking-->
            <div class="row">
                <div class="dashboard-tracking">
                    <div class="col-md-8">
                    	<div class="panel-title">
	                    	<i class="fa fa-map-o" aria-hidden="true"></i>
	                            Our Warehouses
	                    </div>
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <div id="map" style="height: 300px; width: auto; margin: -16px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<div class="panel-title">
		                	<span class="glyphicon glyphicon-road"></span>
		        			Latest Outgoing Trucks
		        		</div>
                    	<div class="panel panel-info">
                    		<table class="table">
	                    		<thead>
	                    			<tr>
	                    				<th>Truck ID</th>
	                    				<th>Destination</th>
	                    			</tr>
	                    		</thead>
	                    		<tbody>
                                @if (empty($movingboxes[0]))
                                    <tr>
                                        <td>No Ongoing W2W Shipment</td>
                                    </tr>
                                @else
                                    @foreach ($movingboxes as $move)
                                    <tr>
                                        <td>{{$move->truck_id}}</td>
                                        <td>{{$move->arrive_to}}</td>
                                    </tr>
                                    @endforeach
                                @endif
	                    		</tbody>
	                    	</table>
                    	</div>
                    	
                    </div>
                </div>
            </div><!-- /dashboard-tracking -->

            <!-- Dashboard Shippping-->
            <div class="row">
                <div class="dashboard-shipping">

                    <!-- Incoming Box -->
                    <div class="col-md-4">
                    	<div class="panel-title">
	                    	<span class="glyphicon glyphicon-import"></span>
	                            Incoming Boxes for Today
	                    </div>
                        <div class="panel panel-default">	
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Box Tag</td>
                                        <td>Box Name</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (empty($inboundboxes[0]))
                                    <tr>
                                        <td>No Incoming Box</td>
                                    </tr>
                                @else
                                    @if ((auth()->user()->privilege == 'superuser') or (auth()->user()->privilege == 'admin'))
                                        @foreach ($inboundboxes as $in)
                                        <tr>
                                            <td>{{$in->tag_tag}}</td>
                                            <td>{{$in->name}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        @foreach ($inboundboxes as $in)
                                            @if (auth()->user()->privilege == $in->arrival_destination)
                                            <tr>
                                                <td>{{$in->tag_tag}}</td>
                                                <td>{{$in->name}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>   
                        </div>
                        </div>
                    </div><!-- /incoming box -->

                    <!-- Outcoming Box -->
                    <div class="col-md-4">
                    	<div class="panel-title">
	                    	<span class="glyphicon glyphicon-export"></span>
	                        Shipping Out for Today
	                    </div>
                        <div class="panel panel-default">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Box Tag</td>
                                        <td>Box Name</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (empty($outboundboxes[0]))
                                    <tr>
                                            <td>No Outgoing Box</td>
                                    </tr>
                                @else
                                    @if ((auth()->user()->privilege == 'superuser') or (auth()->user()->privilege == 'admin'))
                                        @foreach ($outboundboxes as $out)
                                        <tr>
                                            <td>{{$out->tag_tag}}</td>
                                            <td>{{$out->name}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        @foreach ($outboundboxes as $out)
                                            @if (auth()->user()->privilege == $out->warehouse)
                                            <tr>
                                                <td>{{$out->tag_tag}}</td>
                                                <td>{{$out->name}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /outcoming box -->
                    
					<!-- Latest Added Inventory -->
					<div class="col-md-4">
						<div class="panel-title">
	                    	<span class="glyphicon glyphicon-th-list"></span>
							Latest Added Inventory
						</div>
						<div class="panel panel-default">
							<table class="table">
								<thead>
									<tr>
										<th>Box Name</th>
										<th>Position</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><!-- end of latest added inventory -->

                </div>
            </div><!-- /dashboard-shipping -->
        </div>
    </div>
</div>

<!-- for Maps Google -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiTBGdCMO7HBL3selHgQellXImNHrt1z4"></script>
    <script type="text/javascript">
        var locations = [
            @foreach ($warehouses as $warehouse)
                [ "{{ $warehouse->name }}", "{{ $warehouse->address }}", "{{ $warehouse->latitude }}", "{{ $warehouse->longitude }}" ],
            @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

		//create empty LatLngBounds object
		var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) { 
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map
            });

            //extend the bounds to include each marker's position
  			bounds.extend(marker.position);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
            })(marker, i));
        }

        //now fit the map to the newly inclusive bounds
		map.fitBounds(bounds); //auto zoom
		map.panToBounds(bounds); //auto center
    </script>
@endsection