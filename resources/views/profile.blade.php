@extends('app')

@section('content')

<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
?>

<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
	  <h1>User Profile</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>User Profile</b> <button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
				
				<form class="form-horizontal" role="form" method="POST" action="{{{ $path }}}/profile/save/<?= $user['id'];?>">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
						
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<?php if(isset($user)) : ?>
									<input type="text" class="form-control" name="name" value="{{{ $user['name'] }}}">
								<?php else : ?>
									<input type="text" class="form-control" name="name">
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<?php if(isset($user)) : ?>
									<input type="text" class="form-control" name="email" value="{{{ $user['email'] }}}">
								<?php else : ?>
									<input type="text" class="form-control" name="email">
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" value="{{{ old('password') }}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save Changes</button>
								<a href="{{{ url('/bmc') }}}"><button type="button" class="btn btn-default">Back</button></a>
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
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Profile Help</h4>
      </div>
      <div class="modal-body">
      		<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">The User Profile contains all your User Data.</div>
			</p> 
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">You can change your Name, E-Mail Address and Password by typing in the columns.</div>
			</p>
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">To save changes press the
						<button type="button" class="btn btn-primary">Save Changes</button>
						Button.
				</div>
			</p> 
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection