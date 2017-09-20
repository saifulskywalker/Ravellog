@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Ongoing Issues -->
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Ongoing Issues</legend>
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
                                  <th>Issue</th>
                                  <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><button class="btn btn-info" data-toggle="modal" data-target="#OngoingIssue">Resolve</button></td>
                                </tr>
                            </tbody>
                          </table>

                          <div class="text-right">
                            
                          </div>    
                        </div>
                      </fieldset>

                      <!-- OngoingIssue Modal -->
                      <div class="modal fade" id="OngoingIssue" tabindex="-1" role="dialog" 
                           aria-labelledby="Issuelabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                      <button type="button" class="close" 
                                         data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                             <span class="sr-only">Close</span>
                                      </button>
                                      <h4 class="modal-title" id="Issuelabel">
                                          Resolve
                                      </h4>
                                  </div>
                                  
                                  <!-- Modal Body -->
                                  <div class="modal-body">
                                      <fieldset>
                                        <form role="form">
                                          <div class="form-group">
                                            <label for="inputBoxTag">Box Tag</label>
                                              <select type="text" class="form-control" id="" name='' placeholder="Box Tag" disabled>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputBoxName">Box Name</label>
                                              <select type="text" class="form-control" id="" name='' placeholder="Box Name" disabled>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputBoxName">Justification</label>
                                              <textarea class="form-control" rows="5" id="inputJustify" name='' placeholder="Justification" required>
                                              </textarea>
                                          </div>
                                          <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                      </fieldset>  
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endif

            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-warning">You need to login to access this page</a>
            @endif
        </div>
    </div><!-- end of ongoing issue -->

    <!-- Tracking Issues -->
    <div class="row no-gutters">
        <div class="col-md-10 col-md-offset-1">
            <legend style="padding-left:1em; padding-top:0.5em;">Tracking Issues</legend>
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
                                  <th>Truck ID</th>
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Issue</th>
                                  <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><button class="btn btn-info" data-toggle="modal" data-target="#TrackingIssue">Resolve</button></td>
                                </tr>
                            </tbody>
                          </table>

                          <div class="text-right">
                            
                          </div>    
                        </div>
                      </fieldset>

                      <!-- TrackingIssue Modal -->
                      <div class="modal fade" id="TrackingIssue" tabindex="-1" role="dialog" 
                           aria-labelledby="Issuelabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                      <button type="button" class="close" 
                                         data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                             <span class="sr-only">Close</span>
                                      </button>
                                      <h4 class="modal-title" id="Issuelabel">
                                          Resolve
                                      </h4>
                                  </div>
                                  
                                  <!-- Modal Body -->
                                  <div class="modal-body">
                                      <fieldset>
                                        <form role="form">
                                          <div class="form-group">
                                            <label for="inputBoxTag">Truck ID</label>
                                              <select type="text" class="form-control" id="" name='' placeholder="Truck ID" disabled>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputBoxName">From</label>
                                              <select type="text" class="form-control" id="" name='' placeholder="From" disabled>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputBoxName">To</label>
                                              <select type="text" class="form-control" id="" name='' placeholder="To" disabled>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputBoxName">Justification</label>
                                              <textarea class="form-control" rows="5" id="inputJustify" name='' placeholder="Justification" required>
                                              </textarea>
                                          </div>
                                          <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                      </fieldset>  
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endif

            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-warning">You need to login to access this page</a>
            @endif
        </div>
    </div><!-- end of tracking issue -->
</div>
@endsection