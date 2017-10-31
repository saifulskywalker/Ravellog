@extends('layouts.pdf')

@section('content')
@if(Auth::check())

{{ csrf_field() }}
    <legend>Inbound Box</legend>
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
@endif
@if(Auth::guest())
  <a href="/login" class="btn btn-warning">You need to login to access this page</a>
@endif
@endsection