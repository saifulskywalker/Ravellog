@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                    @if(Auth::check())
                    
                    {{ csrf_field() }}
                      <fieldset>
                        <legend style="padding-left:1em; padding-top:0.5em;">View Assets</legend>
                        @if (Session::has('message'))
                          <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-12">
                          <table class="table">
                            <thread>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </thread>

                            <tbody>
                              @foreach($assets as $asset)
                                <tr>
                                  <td>{{$asset->name}}</td>
                                  <td>
                                  @if ($asset->quant == '1')
                                  {{$asset->quant}} piece
                                  @else
                                  {{$asset->quant}} pieces
                                  @endif
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                          <div class="text-right">
                            {!! $assets->links(); !!}
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