<!-- Kontaktadresse: support@toolkit.builders  -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Business Model Toolkit</title>

	<!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->
	<link href="{{ asset('/css/five.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/MA_Template.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
	<!--  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">-->
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<!-- Fonts -->
	<!-- <link href='https://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css'> 
	<link href='https://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css'>-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->	
</head>
<body data-spy="scroll" data-target=".navbar-default">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12 header_nav">
						<a class="navbar-brand" href="http://app.toolkit.builders"><img class="img-responsive" alt="DMK E-Bussiness" src="{{ asset('img/toolkit_builders_logo.png') }}"></a>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-6">
					<ul class="nav navbar-nav">
						<li class="dropdown_project {{{ (Request::is('projects') ? 'active' : '') }}}">
							<h3 class="header_drop">
								<a href="{{ url('/projects') }}">Projects</a>
							</h3>
							<div class="divider_vertical"></div>
							@if(isset($myProjects))
							 <button type="button" id="dropdown_navbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
							  <ul class="dropdown-menu" aria-labelledby="dropdown_navbar">
							    @foreach($myProjects as $p)
							      <li><a href="/projects/showBMCs/{{ $p['id'] }},1">{{ $p['title'] }}</a></li>
							    @endforeach
							  </ul>
							@endif
						</li>
	<!--					<li class="{{{ (Request::is('bmc/models') ? 'active ' : '') }}}" ><h3><a href="{{ url('/bmc/models') }}">Models</a></h3></li>-->
	<!-- 					<li><a href="{{ url('/cSegments') }}">Customer Segments</a></li> -->
						<li class="{{{ (Request::is('persona') ? 'active' : '') }}}" ><h3><a href="{{ url('/persona') }}">Personas</a></h3></li>
						<li class="{{{ (Request::is('team') ? 'active' : '') }}}" ><h3><a href="{{ url('/team') }}">Team</a></h3></li>
					</ul>
					</div>
					<div class="col-md-3 col-sm-12 header_nav col-xs-6">
					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@else
							<li class="dropdown">
								<a class="loggin" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h3 class="logged">You are logged in as {{ Auth::user()->name }} </h3><span class="icon_more"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/profile') }}">User Profile</a></li>
									<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
								</ul>
							</li>
						@endif
					</ul>
					</div>
				</div>	
			</div>
			@if (!Auth::guest())
				@if (Auth::user()->is_Admin)
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 adminMenu">
					<ul class="nav nav-tabs">
						<li class="{{{ (Request::is('adminDashboard') ? 'active' : '') }}}" role="presentation"><a href="{{ url('/adminDashboard') }}">Dashboard</a></li>
<!-- 						<li class="{{{ (Request::is('adminNewUser') ? 'active' : '') }}}" role="presentation"><a href="{{ url('/adminNewUser') }}">New User</a></li> -->
					</ul>
				</div>
				@endif
			@endif
		</div>
		<div class="divider_style_2 no_space"></div>
		<div class="divider_style_1 no_space"></div>
	</nav>
		@yield('content')
	<!-- Scripts -->
	<script>
		function showStuff(id, btn) {
			if(document.getElementById(id).style.display == 'block'){
				document.getElementById(id).style.display = 'none';
			}else{
				document.getElementById(id).style.display = 'block';
			}
		}
	  </script>
</body>
</html>
