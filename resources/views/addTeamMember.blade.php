@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">add Team Member</div>
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
						$posturl = "";
						if(isset($project)) : $posturl = $project['id']; endif;
					?>
					
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/projects/save/'.$posturl) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Adress</label>
							<div class="col-md-6">
								<?php if(isset($project)) : ?>
									<input type="text" class="form-control" name="title" value="{{ $project['title'] }}">
								<?php else : ?>
									<input type="text" class="form-control" name="title">
								<?php endif; ?>
							</div>
						</div>
						
						<div class="form-group">
						 	<label for="marital_status" class="col-md-4 control-label">Project</label>
						 	<div class="col-md-6">
							  <select class="form-control" id="marital_status" name="marital_status">
							  	<?php 
							  		foreach ($myProjects as $project){
							  			print '<option>'.$project['title'].'</option>';
							  		}
							  	
							  	?>
							  </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button>
								<a href="{{ url('/team') }}"><button type="button" class="btn btn-default">Back</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
