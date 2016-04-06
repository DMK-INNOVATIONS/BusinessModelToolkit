<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
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
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 26px;
				margin-bottom: 40px;
				color: #36444b;
			}
			.text {
				color: #36444b;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
								
				<div class="title">Thank you for your registration.</div>
				<div class="text"> Please check your email and click activate account link in the message we just sent to <?php echo $email; ?>. Once your account is activated, you are able to use our service.</div>
					
			</div>
		</div>
	</body>
</html>
