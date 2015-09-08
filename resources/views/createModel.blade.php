@extends('app')

@section('content')
<?php 
		if($_SERVER['SERVER_NAME']== 'localhost' || $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
			$path = '/bmc/public';
		}else{
			$path = '';
		}
	?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New Model</div>
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
					
					<?php 
						$posturl = "null";
						$new_bmc_view = 1;
						$bmc_status = 'inWork';
					?>
					
					<form class="form-horizontal" role="form" method="POST" action="<?php print $path.'/bmc/saveModel'; ?>">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
									<input type="text" class="form-control" name="title">
							</div>
						</div>
						
						<div class="form-group">
						 	<label for="projects" class="col-md-4 control-label">Project</label>
						 	<div class="col-md-6">
							  <select class="form-control" name="projects">
							  	<?php 
							  		foreach ($myProjects as $project){
							  			print '<option value="'.$project['id'].'">'.$project['title'].'</option>';
							  		}
							  	?>
							  </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button></a>
								<?php 
									print '<a href="'.$path.'/bmc/models"><button type="button" class="btn btn-default">Back</button></a>';
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
