<div class="modal fade" id="addPersonaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a Persona</h4>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" role="form" method="POST" action=" ">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<?php 
				print '<div class="row">';
					foreach ($myPersonas as $myPersona){
						print '
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group col-md-1">
									<div class="checkbox">
									  <label>
									    <input type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
									  </label>
									</div>
								</div>	
								<div class="col-md-2 col-sm-2 col-xs-2">
									<a class="thumbnail">
								      <img src="'.$myPersona["avatarImg"].'" alt="avatarImg">
								    </a>	
								</div>	
								<div class="col-md-2 col-sm-2 col-xs-2">
									'.$myPersona["name"].'	
								</div>	
								<div class="col-md-1 col-sm-1 col-xs-1">
									'.$myPersona["age"].'	
								</div>	
								<div class="col-md-1 col-sm-1 col-xs-1">
									'.$myPersona["gender"].'	
								</div>
								<div class="col-md-3 col-sm-2 col-xs-2">
									'.$myPersona["occupation"].'	
								</div>
								<div class="col-md-1 col-sm-1 col-xs-1">
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myPersona'.$myPersona["id"].'">show</button>
								</div>
							</div>
						';
						
						
					}
					print '</div>';
				?>
			<div class="form-group">
				<div class="col-md-8 col-md-offset-2">
					<button type="submit" class="btn btn-primary">Add Persona/s</button>
					<?php $view_type = 'viewBMC'; print '<a href="/bmc/public/persona/create/'.$view_type.','.$bmc_id.','.$project_id.','.$status.'"><button type="button" class="btn btn-default">Create new Persona</button></a>'; ?>
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
				</div>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>