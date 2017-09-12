@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- Dashboard Info -->
            <div class="row">
                <div class="dashboard-info">
                    <div class="col-xs-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Warehouse
                            </div>
                            <div class="panel-body">
                                @if (auth()->user()->privilege == 'superuser')
                                    All Warehouses
                                @else
                                    @foreach ($warehouses as $warehouse)
                                        @if (auth()->user()->privilege == $warehouse->id)
                                            {{$warehouse->name}}
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Number of Boxes
                            </div>
                            <div class="panel-body">
                                {{$boxes}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Vehicle on the Way
                            </div>
                            <div class="panel-body">
                                {{$movingboxes}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                Warning
                            </div>
                            <div class="panel-body">
                                <a href="#">There is no warning</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /dashboard-info -->

            <!-- Dashboard Tracking-->
            <div class="row">
                <div class="dashboard-tracking">
                    <div class="">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Our Warehouses
                            </div>
                            <div class="panel-body">
                                <div id="map" style="height: 400px; width: auto; margin: -16px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /dashboard-tracking -->

            <!-- Dashboard Shippping-->
            <div class="row">
                <div class="dashboard-shipping">

                    <!-- Incoming Box -->
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                Incoming Boxes for Today
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Box Tag</td>
                                        <td>Box Name</td>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /incoming box -->

                    <!-- Outcoming Box -->
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                Shipping Out for Today
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Box Tag</td>
                                        <td>Box Name</td>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /outcoming box -->
                    
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
            zoom: 5,
            center: new google.maps.LatLng(-1.082629, 118.4985576),
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