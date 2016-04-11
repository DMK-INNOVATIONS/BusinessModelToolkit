@extends('app')

@section('content')

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
									<li>{{{ $error }}}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<?php 
						$posturl = "null";
						$new_bmc_view = 1;
						$bmc_status = 'inWork';
						if(isset($bmc)) : $posturl = $bmc['id']; endif;
					?>
					
					<form class="form-horizontal" role="form" method="POST" action="{{{$path}}}/bmc/save/{{{$project_id}}},{{{$posturl}}},{{{$bmc_status}}},{{{$new_bmc_view}}},true,{{{$owner}}},{{{$view_type}}}">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
						
						<?php 
						
							if($error==true){
								print '<div class="alert alert-danger" role="alert">You <strong>must</strong> insert a Title.</div>';
							}
						
						?>

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<?php if(isset($bmc)) : ?>
									<input type="text" class="form-control" name="title" value="{{{ $bmc['title'] }}}">
								<?php else : ?>
									<input type="text" class="form-control" name="title">
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button></a>
								<?php 
									if($view_type == 'models'){
										print '<a href="'.$path.'/bmc/models"><button type="button" class="btn btn-primary btn-secundar">Back</button></a>';
									}else{
										print '<a href="'.$path.'/projects/showBMCs/'.$project_id.','.$owner.'"><button type="button" class="btn btn-primary btn-secundar">Back</button></a>';
									}
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
