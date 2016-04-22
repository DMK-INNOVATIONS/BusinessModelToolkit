@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form id="complexify" class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password">
							</div>
							<div class="col-sm-6 col-sm-offset-4">
                    				<div class="progress">
										<div role="progressbar" class="progress-bar" id="complexity-bar"></div>
									</div>
									<h1 class="pull-right" id="complexity" class="hidden">0</h1>
									<div class="error hidden">Password  is not strenght enough</div>
                			</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../js/jquery.complexify.js"></script>

<script>
function passwordStrength(){
	$('#complexify #password').complexify({}, function (valid, complexity) {
		var progressBar = $('#complexify #complexity-bar');
		progressBar.toggleClass('progress-bar-success', valid);
		progressBar.toggleClass('progress-bar-danger', !valid);
		progressBar.css({'width': complexity});
		$('#complexify #complexity').text(Math.round(complexity));
	});
}
$(".progress").addClass("hidden");
var valid = false;
$( "#password" ).keyup(function() {
	var value=$("#password").val();
	$(".error").addClass("hidden");
	if(value.length > 0){
		$(".progress").removeClass("hidden");
		passwordStrength();
		var procent=$("h1#complexity").text();
		if(procent>41){
			valid=true;
		}else{
			valid=false;
		}
	}else{
		$(".progress").addClass("hidden");
	}
});

$( "#complexify").submit(function( event ) {
	//$msg=$(".alert alert-danger").append('<div class="error">Password  is not strenght enough</div>');
	if(valid){
		return;
	}
	event.preventDefault();
	$(".error.hidden").removeClass("hidden");
});

</script>

@endsection