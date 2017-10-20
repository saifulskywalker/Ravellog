<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <style type="text/css">
    	html {
    		margin: 60px;
    	}
    	header { 
    		position: fixed; 
    		top: -30px; 
    		left: 0px; 
    		right: 0px;
    		height: 20px;
    		font-size: 10px; 
    		text-align: right;
    	}
    	footer { 
    		position: fixed; 
    		bottom: -60px; 
    		left: 0px; 
    		right: 0px;
    		height: 50px;
    		font-size: 10px; 
    		text-align: right;
    	}
		#report-header {
			font-size: 14px;
		}
		#report-header .logo,
		#report-header .text,
		#report-header .text .left-text,
		#report-header .text .right-text {
			display: inline-block;
		}
		#report-header .text .left-text, {
			width: 450px;
			margin-left: 15px;
		}
    	.title {
    		text-align: center;
    		font-size: 18px;
    	}
    	.table {
    	  width: 100%;
    	  max-width: 100%;
    	  margin-bottom: 20px;
    	}
    	.table > thead > tr > th,
    	.table > tbody > tr > th,
    	.table > tfoot > tr > th,
    	.table > thead > tr > td,
    	.table > tbody > tr > td,
    	.table > tfoot > tr > td {
    	  padding: 4px;
    	  line-height: 1.42857143;
    	  vertical-align: top;
    	  border-top: 1px solid #ddd;
    	  font-size: 12px;
    	}
    	.table > thead > tr > th {
    	  vertical-align: bottom;
    	  border-bottom: 2px solid #ddd;
    	}
    </style>
</head>

<body>
	<script type="text/php">
	    if ( isset($pdf) ) {
	        $x = 540;
	        $y = 760;
	        $text = "Page "."{PAGE_NUM} of {PAGE_COUNT}";
	        $font = $fontMetrics->get_font("serif");
	        $size = 8;
	        $color = array(0,0,0);
	        $word_space = 0.0;  //  default
	        $char_space = 0.0;  //  default
	        $angle = 0.0;   //  default
	        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
	    }
	</script>
	<header>
		Created at : {{$nowTime}}
	</header>
		
	<div id="report-header">
		<div class="logo">			
			<img src="c:/xampp/htdocs/ravellog/public/img/logo.png" alt="logo" height="42px">
		</div>
		<div class="text">
			<div class="title">Report Ravellog</div>
			<div class="left-text">
				<div>Warehouse : 
							@if (auth()->user()->privilege == 'superuser')
				                All Warehouses
				            @else
				                @foreach ($warehouses as $warehouse)
				                    @if (auth()->user()->privilege == $warehouse->id)
				                        {{$warehouse->name}}
				                    @endif
				                @endforeach
				            @endif
				</div>
				<div>User : {{auth()->user()->name}}</div>
			</div>
			<div class="right-text">
				<div>Date : {{$fromDate}} to {{$toDate}}</div>
			</div>
		</div>
		<hr>
		<br>
	</div>

	<div id="content">
		@yield('content')
	</div>
</body>

</html>