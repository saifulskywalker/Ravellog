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
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
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
                        Ravellog
                    </a>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <!-- if user has admin privilege, this menu will appear -->
                    @if (auth()->user()->privilege == 'admin')
                        <li>
                        <a href ="#" class="accordion">RFID Tag Management</a>
                            <div class="panel-drop">
                                <a href="#">Add RFID Tag</a>
                                <a href="#">Delete RFID Tag</a>
                            </div>
                        </li>
                    @endif
                    <!-- end of admin only menu -->
                    <li>
                        <a href ="#" class="accordion">Box Management</a>
                            <div class="panel-drop">
                                <a href="#">View Boxes</a>
                                <a href="{{route('boxes.create')}}">Add New Box</a>
                                <a href="{{route('boxes.inboundbox')}}">Inbound Box</a>
                                <a href="#">Outbound Box</a>
                    <!-- if user has admin privilege, this menu will appear -->
                    @if (auth()->user()->privilege == 'admin')
                                <a href="#">Delete Box</a>
                    @endif
                    <!-- end of admin only menu -->
                            </div>
                        
                    </li>
                    <li>
                        <a href ="#" class="accordion">Asset Management</a>
                            <div class="panel-drop">
                                <a href="#">View Assets</a>
                                <a href="#">Register New Asset</a>
                            </div>
                        
                    </li>
                    <li>
                        <a href ="#" class="accordion">Employees</a>
                            <div class="panel-drop">
                                <a href="#">View Employee List</a>
                                <a href="#">Register New Employee</a>
                                <a href="#">Update Employee</a>
                                <a href="#">Delete Employee</a>
                            </div>
                        
                    </li>
                
                
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
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

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div><a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a></div><br>
            @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->

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