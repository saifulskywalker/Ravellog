<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ravellog UTC') }}</title>
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
        $( "#datepicker1,#datepicker2,#datepicker3,#datepicker4" ).datepicker({ dateFormat: 'yy-mm-dd' });
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
                        Ravellog UTC
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
                        <a href="{{route('/')}}">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Tracking Movement
                        </a>
                    </li>
                    <li>RFID Tag Management</li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Shop Order
                        </a> 
                    </li>
                    <li>RFID Reader Management</li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Gate Function
                        </a> 
                    </li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Handheld Function
                        </a> 
                    </li>
                    <li>Location Management</li>
                    <li>
                        <a href ="#" class="accordion">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Locations
                        </a> 
                    </li>

                    <!-- end of admin only menu -->
                    @else
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
                                    Version 1.0.0
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