<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ravellog') }}</title>
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/collapsible-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <style>
        .bottom-column
            {
                float: none;
                display: table-cell;
                vertical-align: bottom;
                padding-bottom: 15px;
            }
        .profile-table {
                display: table;
            }
        .no-padding {
            padding: 0;
        }
        /* Style the buttons that are used to open and close the accordion panel */
        button.accordion {
            cursor: pointer;
            width: 100%;
            border: none;
            outline: none;
            transition: 0.4s;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        button.accordion.active, button.accordion:hover {
        }

        /* Style the accordion panel. Note: hidden by default */
        div.panel-drop {
            text-indent: 3em;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }
    </style>
    <style type="text/css">
    .multiselect-container {
        width: 100% !important;
        text-align: left;
    }
     .multiselect {
        text-align: left;
    }
    </style>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script type='text/javascript'>
      $( function() {
        $( "#datepicker1,#datepicker2,#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
      } );
      $(document).ready(function() {
        $("#multiselect").multiselect({
            buttonWidth: '100%'
        });
        $(".caret").css('float', 'right');
        $(".caret").css('margin', '8px 0'); 
      } );
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{route('/')}}">
                        <img src="{{ asset('img/logo.png') }}">
                        Ravellog
                    </a>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <!-- for all user and admin, can view dashboard layout -->
                    <li class="sidebar-profile">
                        <a href="#">
                            <span class="glyphicon glyphicon-user"></span>
                            </span>{{auth()->user()->name}}
                        </a>
                    </li>
                    <li class="sidebar-menu" style="padding-left: 1em;">
                        MAIN MENU
                    </li>
                    <!-- if user has admin privilege, this menu will appear -->
                    @if (auth()->user()->privilege == 'admin')
                        <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-tags"></span>
                            RFID Tag Management
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>
                            <div class="panel-drop">
                                <a href="{{route('tag.create')}}">Add RFID Tag</a>
                                <a href="{{route('tag.delete')}}">Delete RFID Tag</a>
                            </div>
                        </li>

                        <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-user"></span>
                            Employees
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>
                            <div class="panel-drop">
                                <a href="{{route('employee.index')}}">View Employee List</a>
                                <a href="{{route('employee.create')}}">Register New Employee</a>
                                <a href="{{route('employee.delete')}}">Delete Employee</a>
                            </div>
                        </li>
                    <!-- end of admin only menu -->
                    @else
                    <li>
                        <a href="{{route('/')}}">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('boxes.index')}}">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Inventory
                        </a>
                    </li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-transfer"></span>
                            Shipping Management
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>
                            <div class="panel-drop">
                                <a href="{{route('boxes.create')}}">Shipping In</a>
                                <a href="{{route('boxes.movingbox')}}">Shipping Internal</a>
                                <a href="{{route('boxes.outboundbox')}}">Shipping Out</a>
                            </div>
                    </li>
                    <li>
                        <a href ="#" class="accordion">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        Tracking
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>
                            <div class="panel-drop">
                                <a href="/ontracking/default">Ongoing</a>
                                <a href="{{route('tracking.finishtracking')}}">Finished</a>
                            </div>
                    </li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            Issues
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>
                            <div class="panel-drop">
                                <a href="{{route('issue.onissue')}}">Ongoing</a>
                                <a href="{{route('issue.resolveissue')}}">Resolved</a>
                            </div>
                    </li>
                    <li>
                        <a href ="{{route('asset.index')}}" class="accordion">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Assets
                        </a> 
                    </li>
                    <li>
                        <a href ="{{route('employee.index')}}" class="accordion">
                            <span class="glyphicon glyphicon-user"></span>
                            Employees
                        </a>
                    </li>
                    @endif
                    
                    
                    
                
                
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endif
            </ul> 
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Header Content -->
        <div id="header-content-wrapper">
            <div class="container-fluid" style="padding-top: 0.4em">
                <div><a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a></div><br>
            </div>
        </div>
        <!-- /#header-content-wrapper -->

        <!-- Body Content -->
        <div id="body-content-wrapper">
            <div class="container-fluid" style="margin-top: -15px;">
            @yield('content')
            </div>
        </div>
        <!-- /#body-content-wrapper -->

        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="lef-footer pull-left">
                                    Copyright &copy; PT. Ravelware Technology Indonesia
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="right-footer pull-right">
                                    Version 1.1.1
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </footer>

    </div>
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<!--     <script src="{{ asset('js/app.js') }}"></script> -->
    <script type="text/javascript">
        var room = 1;
        var limit = 20;
        function item_fields() {
            if (room == limit)  {
                alert("You have reached the limit of adding items");
            }
            else {
                room++;
                var objTo = document.getElementById('item_fields')
                var divtest = document.createElement("div");
                divtest.setAttribute("class", "removeclass"+room);
                var rdiv = 'removeclass'+room;
                divtest.innerHTML = '<div class="row profile-table"><div class="col-sm-8 profile-table"><div class="col-sm-12 form-group"><label for="inputBoxTag">Item Name</label>                              <input type="text" class="form-control" id="item-name" name="item_name[]" value="" placeholder="Item Name" required>                            </div>                          </div>                          <div class="col-sm-3 profile-table">                            <div class="col-sm-12 form-group no-padding"><label for="inputBoxTag">Quantity</label>                    <input type="text" class="form-control" id="quantity" name="quantity[]" value="" placeholder="Quantity" required>                          </div>                          </div>                      <div class="col-sm-1 bottom-column">               <button class="btn btn-danger" type="button"  onclick="remove_item_fields('+room+');"> <span class="glyphicon glyphicon-minus"></span> </button>                         </div></div><br>';
                
                objTo.appendChild(divtest)
            }
        }
           function remove_item_fields(rid) {
               $('.removeclass'+rid).remove()
               room--;
           }
    </script>

        <script type="text/javascript">
        var rfid_tag = 1;
        var limit = 20;
        function rfid_tag_fields() {
            if (rfid_tag == limit)  {
                alert("You have reached the limit of adding tags");
            }
            else {
                rfid_tag++;
                var objTo = document.getElementById('rfid_tag_fields')
                var divtest = document.createElement("div");
                divtest.setAttribute("class", "removeclass"+rfid_tag);
                var rdiv = 'removeclass'+rfid_tag;
                divtest.innerHTML = '<div class="row profile-table"><div class="col-sm-11 profile-table"><div class="col-sm-12 form-group"><label for="inputBoxTag">RFID Tag</label><input type="text" class="form-control" id="rfid-tag" name="rfid_tag[]" value="" placeholder="RFID Tag" required></div></div><div class="col-sm-1 bottom-column"><button class="btn btn-danger" type="button"  onclick="remove_tag_fields('+rfid_tag+');"> <span class="glyphicon glyphicon-minus"></span> </button></div></div>';
                
                objTo.appendChild(divtest)
            }
        }
           function remove_tag_fields(rid) {
               $('.removeclass'+rid).remove()
               rfid_tag--;
           }
    </script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].onclick = function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          }
        }
    </script>

</body>



</html>