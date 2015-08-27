<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
 
	if($_SERVER['REMOTE_ADDR']=='127.0.0.1'){
		$path = '/bmc/public';
	}else{
		$path = '';
	}
?>

<div class="modal fade" id="addPersonaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a Persona</h4>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" role="form" method="POST" action="<?php print $path;?>/bmc/addPersona/<?php print $bmc_id.','.$owner; ?>">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="persona-View-table">
					  <div class="panel-body table_text">
					    <p>Choose one or more personas from the list.</p>
					  </div>
					  
					  <div class="row table_head table_center">
					  		<div class="col-md-1"></div>
					  		<div class="col-md-2">Avatar</div>
					  		<div class="col-md-3">Name</div>
					  		<div class="col-md-1">Age</div>
					  		<div class="col-md-3">Occupation</div>
					  		<div class="col-md-1"></div>
					  </div>
				
					<?php 
						$count = 0;
						foreach ($myPersonas as $myPersona){
							print '<div class="row table_body table_center">';
							print '
									<div class="col-md-1">
										<div class="checkbox">
										  <label>
										    <input type="checkbox" name="selectedPersona[]" value="'.$myPersona['id'].'" aria-label="...">
										  </label>
										</div>
									</div>	
									<div class="col-md-2 col-sm-2 col-xs-2">
								    	<img class="avatarImg" src="'.$myPersona["avatarImg"].'" alt="avatarImg">	
									</div>	
									<div class="col-md-3 col-sm-3 col-xs-3">
										'.$myPersona["name"].'	
									</div>	
									<div class="col-md-1 col-sm-1 col-xs-1">
										'.$myPersona["age"].'	
									</div>
									<div class="col-md-3 col-sm-2 col-xs-2">
										'.$myPersona["occupation"].'	
									</div>
									<div class="col-md-1 col-sm-1 col-xs-1">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myPersona'.$myPersona["id"].'">show</button>
									</div>
							';
							print '</div>';
							$count = $count+1;							
						}
					?>
				</div>
			<div class="form-group">
				<div class="col-md-8 col-md-offset-2">
					<button type="submit" class="btn btn-primary">Add Persona/s</button>
					<?php $view_type = 'viewBMC'; print '<a href="'.$path.'/persona/create/'.$view_type.','.$bmc_id.','.$project_id.','.$status.','.$owner.'"><button type="button" class="btn btn-default">Create new Persona</button></a>'; ?>
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
				</div>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>