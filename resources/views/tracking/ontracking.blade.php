@extends('layouts.app')

@section('content')
<div class="container">
@if(Auth::check())
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Ongoing Tracking</legend>
            @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="panel panel-success">
                    
                    {{ csrf_field() }}
                      <fieldset>
                        <div class="col-md-12">
                          <table class="table">
                            @if ($lists)
                            <thead>
                              <tr>
                                  <th>Truck ID</th>
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($lists as $list)
                                  <tr>
                                    <td>{{$list->truck_id}}</td>
                                    <td>{{$list->depart_from}}</td>
                                    <td>{{$list->arrive_to}}</td>
                                    <td><a href="/ontracking/{{$list->id}}"><button class="btn btn-info" type="button" onclick=""><span>View</span></button></a></td>
                                  </tr>
                              @endforeach
                            </tbody>
                            @else
                              <thead>
                              <tr>
                              <br>
                                No Ongoing Warehouse-to-Warehouse Shipment
                              </tr>
                                  
                              </thead>

                            @endif
                          </table>

                          <div class="text-right">
                            
                          </div>    
                        </div>
                      </fieldset>
                    
                    

            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-info">
        <div class="panel-heading">
          Truck Status
        </div>
        <div class="panel-body">
          <div id="map" style="height: 400px; width: auto; margin: -16px;">
          </div>
        </div>
        </div>
      </div>
    </div>
    
    @endif
    @if(Auth::guest())
              <a href="/login" class="btn btn-warning">You need to login to access this page</a>
    @endif
</div>
<!-- for Maps Google -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiTBGdCMO7HBL3selHgQellXImNHrt1z4"></script>
    <script type="text/javascript">
        var locations = [
            @foreach ($trackings as $tracking)
              @if ($tracking->latitude != 'x')
                [ "{{ $tracking->truck_id }}", "{{ $tracking->time_update }}", "{{ $tracking->latitude }}", "{{ $tracking->longitude }}" ],
              @endif
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
                    infowindow.setContent('Time: '+locations[i][1]);
                    infowindow.open(map, marker);
                  }
              })(marker, i));
          }

          //now fit the map to the newly inclusive bounds
          map.fitBounds(bounds); //auto zoom
          map.panToBounds(bounds); //auto center
    </script>
@endsection