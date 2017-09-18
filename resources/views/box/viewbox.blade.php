@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
        <legend style="padding-left:1em; padding-top:0.5em;">Inventory</legend>
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
                                <th>Warehouse</th>
                                <th>Position</th>
                                <th>Expire Date</th>
                                <th>Item</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($boxes as $box)
                                <tr>
                                  <td>{{$box->tag_tag}}</td>
                                  <td>{{$box->name}}</td>
                                  <td>{{$box->warehouse_name}}</td>
                                  <td>
                                  @if ($box->location != null)
                                    Shelf {{$box->location}}
                                  @else
                                    not detected
                                  @endif

                                  </td>
                                  <td>{{$box->expire_date}}</td>
                                  <td style="white-space:pre;">{{$box->barang}}</td>
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