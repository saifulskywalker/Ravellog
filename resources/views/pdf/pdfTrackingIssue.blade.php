@extends('layouts.pdf')

@section('content')
@if(Auth::check())

{{ csrf_field() }}
    <legend>Tracking Issues</legend>
    <table class="table">
      <thead>
        <tr>
            <th>Truck ID</th>
            <th>From</th>
            <th>To</th>
            <th>Issue</th>
            <th>Created at</th>
        </tr>
      </thead>

      <tbody>
      @if (empty($trackingissues[0]))
            <tr>
              <td>No Issue with trackings</td>
            </tr>
      @else
        @foreach ($trackingissues as $trackissue)
            <tr>
              <td>{{$trackissue->truck_id}}</td>
              <td>{{$trackissue->depart_from}}</td>
              <td>{{$trackissue->arrive_to}}</td>
              <td>{{$trackissue->category}}</td>
              <td>{{$trackissue->created_at}}</td>
            </tr>
        @endforeach
      @endif
      </tbody>
    </table>
@endif
@if(Auth::guest())
  <a href="/login" class="btn btn-warning">You need to login to access this page</a>
@endif
@endsection