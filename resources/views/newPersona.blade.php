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
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">New Persona</div>
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
						if(isset($persona)) : $posturl = $persona['id']; endif;						
					?>
			
				<div class="row">
					<div class="col-md-2 col-md-offset-1">
						<?php if(isset($persona)) : ?>
							<a class="thumbnail">
						      <img src="{{ $persona['avatarImg'] }}" alt="avatarImg">
						    </a>
						<?php else : ?>
							<div class="thumbnail">
						      <img src="{{ asset('img/male_persona_default_bg.png') }}" alt="avatarImg"> <!-- noch gegen default bild austauschen -->
						    </div>
						<?php endif; ?>
					</div>
					<div class="col-md-9">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/persona/save/'.$posturl.','.$view_type.','.$bmc_id.','.$project_id.','.$bmc_status.','.$owner.','.$view_type_main) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
							<div class="form-group">
								<label class="col-md-2 control-label">Name</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="name" value="{{ $persona['name'] }}">
									<?php else : ?>
										<input type="text" class="form-control" name="name">
									<?php endif; ?>
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-2 control-label">Persona Image</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="avatarImg" value="{{ $persona['avatarImg'] }}">
									<?php else : ?>
										<div class="input-group">
											<input type="text" class="form-control" name="avatarImg">
											<span class="input-group-addon glyphicon glyphicon-question-sign persona_formular_help" data-toggle="tooltip" data-placement="right" title="Please add a url of your favorite image."/>	
										</div>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Age</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="age" value="{{ $persona['age'] }}">
									<?php else : ?>
										<input type="text" class="form-control" name="age">
									<?php endif; ?>
								</div>
							</div>
							
							 <div class="form-group">
							 	<label for="gender" class="col-md-2 control-label">Gender</label>
							 	<div class="col-md-8">
								  <select class="form-control" id="gender" name="gender">
								    <option>male</option>
								    <option>female</option>
								    <option>other</option>
								  </select>
								</div>
							</div>
							
							<div class="form-group">
							 	<label for="marital_status" class="col-md-2 control-label">Marital Status</label>
							 	<div class="col-md-8">
								  <select class="form-control" id="marital_status" name="marital_status">
								    <option>single</option>
								    <option>in a relationship</option>
								    <option>long-term relationship</option>
								    <option>married</option>
								    <option>widowed</option>
								    <option>divorced</option>
								    <option>other</option>
								  </select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Occupation</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="occupation" value="{{ $persona['occupation'] }}">
									<?php else : ?>
										<input type="text" class="form-control" name="occupation">
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Nationality</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="nationality" value="{{ $persona['nationality'] }}">
									<?php else : ?>
										<input type="text" class="form-control" name="nationality">
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Quote</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<input type="text" class="form-control" name="quote" value="{{ $persona['quote'] }}">
									<?php else : ?>
										<div class="input-group">
											<input type="text" class="form-control" name="quote">
											<span class="input-group-addon glyphicon glyphicon-question-sign persona_formular_help" data-toggle="tooltip" data-placement="right" title="Please divide your inserts with a semicolon."/>	
										</div>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Personality</label>
								<div class="col-md-8">								
									<?php if(isset($persona)) : ?>
										<textarea type="text" class="form-control" rows="3" name="personality" ><?php print $persona['personality'];?></textarea>
									<?php else : ?>
										<div class="input-group col-md-12">
											<textarea type="text" class="form-control" rows="3" name="personality"></textarea>
										</div>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Skills</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<textarea type="text" class="form-control" rows="3" name="skills" ><?php print $persona['skills']; ?></textarea>
									<?php else : ?>
										<div class="input-group">
											<textarea type="text" class="form-control" rows="3" name="skills"></textarea>
											<span class="input-group-addon glyphicon glyphicon-question-sign persona_formular_help" data-toggle="tooltip" data-placement="right" title="Please divide your inserts with a semicolon."/>	
										</div>
									<?php endif; ?>
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-2 control-label">Needs</label>
								<div class="col-md-8">
									<?php if(isset($persona)) : ?>
										<textarea type="text" class="form-control" rows="3" name="needs"><?php print $persona['needs'];?></textarea>
									<?php else : ?>
										<div class="input-group">
											<textarea type="text" class="form-control" rows="3" name="needs"></textarea>
											<span class="input-group-addon glyphicon glyphicon-question-sign persona_formular_help" data-toggle="tooltip" data-placement="right" title="Please divide your inserts with a semicolon."/>	
										</div>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-8 col-md-offset-2">
									<button type="submit" class="btn btn-primary">Save</button>
									<?php 
										if($view_type == "viewBMC"){
											print '<a href="/bmc/public/bmc/viewBMC/'.$bmc_id.$project_id.$bmc_status.$owner.'"><button type="button" class="btn btn-default">Back</button></a>';	
										}else{
											print '<a href="'.$path.'/persona"><button type="button" class="btn btn-default">Back</button></a>';
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
</div>
@endsection
