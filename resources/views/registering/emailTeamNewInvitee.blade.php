<html>
<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet'
	type='text/css'>
<link href="{{ asset('/css/five.css') }}" rel="stylesheet">
<link href="{{ asset('/css/MA_Template.css') }}" rel="stylesheet">
<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
<!--  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script
	src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
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
.text {
	color: #36444b;
	font-weight: 18px;
}

.text .link {
	margin-left: 0;
	text-align: justify;
}

.logo_place {
	margin-bottom: 25px;
	width: 100%;
}

.img_place {
	margin-left: auto !important;
	margin-right: auto !important;
}
</style>
</head>
<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12"
					style="width: 100%; text-align: center; margin: 30px auto;">
					<a class="logo_place" href="http://app.toolkit.builders">
						<img class="img-responsive img_place" alt="toolkit.builders logo"	src="{{{ asset('img/toolkit_builders_logo.png') }}}">
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="text">
						<p>The toolkit.builders User {{{ $inviterMail }}} invited you to his/her Project: {{{ $project_name }}}.</p>
						<p>If you want to answer the invitation, klick this link <a href="{{{ url('/registerInvitee',['email'=>$email]) }}}" class="link">toolkit.builders</a> to create an account.</p>
						<p>If you didn&#8217;t intend to answer the invitation, you can ignore this email.</p>
						<p><b>Your support@toolkit.builders.</b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

