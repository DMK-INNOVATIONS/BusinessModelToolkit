@extends('app')

@section('content')

<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">User Profile <button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
				
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<?php if(isset($user)) : ?>
									<input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
								<?php else : ?>
									<input type="text" class="form-control" name="name">
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<?php if(isset($user)) : ?>
									<input type="text" class="form-control" name="email" value="{{ $user['email'] }}">
								<?php else : ?>
									<input type="text" class="form-control" name="email">
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="password" value="{{ old('password') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save Changes</button>
								<a href="{{ url('/bmc') }}"><button type="button" class="btn btn-default">Back</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Profile Help</h4>
      </div>
      <div class="modal-body">
        ... Hier muss noch Text rein ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
