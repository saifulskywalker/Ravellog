@extends('layouts.pdf')

@section('content')
@if(Auth::check())

{{ csrf_field() }}
    <legend>Ongoing Issues</legend>
    <table class="table">
      <thead>
        <tr>
            <th>Box Tag</th>
            <th>Box Name</th>
            <th>Issue</th>
            <th>Created at</th>
            <th>Tes</th>
        </tr>
      </thead>

      <tbody>
      @if (empty($boxissues[0]))
            <tr>
              <td>No Issue with boxes</td>
            </tr>
      @else
        @foreach ($boxissues as $boxissue)
            <tr>
              <td>{{$boxissue->box_tag}}</td>
              <td>{{$boxissue->box_name}}</td>
              <td>{{$boxissue->category}}</td>
              <td>{{$boxissue->created_at}}</td>
              <td>tes</td>
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