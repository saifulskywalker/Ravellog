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
                                Warehouse Name
                            </div>
                            <div class="panel-body">
                                Cikarang
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Number of Boxes
                            </div>
                            <div class="panel-body">
                                103
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Vehicle on the Way
                            </div>
                            <div class="panel-body">
                                7 <small>of</small> 15
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
                    <div class="panel">
                        <div class="panel-heading">
                            Tracking for Trucks
                        </div>
                        <div class="panel-body">
                            
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
                                        <td>Box Name</td>
                                        <td>Item</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /incoming box -->

                    <!-- Outcoming Box -->
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                Outcoming Boxes for Today
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Box Name</td>
                                        <td>Item</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /outcoming box -->
                    
                </div>
            </div><!-- /dashboard-shipping -->
        </div>
    </div>
</div>
@endsection