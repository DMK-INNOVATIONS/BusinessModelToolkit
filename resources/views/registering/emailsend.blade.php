<html>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #36444b;
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

			.text {
				color: #36444b;
				font-weight: 18px;
			}
		</style>
	</head>
	<body>
	<div class="container">
			<div class="content">
				<div class="row">
					<div clas="col-md-12">
						<div class="text">You&#8217;re one click away. Please verify your email address <?php echo $email; ?>.
						 <a href="{{ url('/authentificate',['token'=>$token,'email'=>$email]) }}">Link App Toolkit Builders</a>
						<p>You&#8217;ve received this email because you requested an app.toolkit.builders account with this email address. If you didn&#8217;t intend to, you can ignore this email—the account hasn&#8217;t been created yet.
Having trouble? Copy and paste this link into your browser and start verification process manually.</p>
<p>Your support@toolkit.builders.</p>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
