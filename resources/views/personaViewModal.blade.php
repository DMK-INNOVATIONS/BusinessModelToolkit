<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
?>

<div class="modal fade" id="addPersonaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a Persona</h4>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" role="form" method="POST" action="{{{$path}}}/bmc/addPersona/{{{$bmc_id}}},{{{$owner}}},viewBMC">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
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
										<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#myPersona'.$myPersona["id"].'">show</button>
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
					<a href="<?=$path ?>/persona/create/viewBMC,{{{$bmc_id}}},{{{$project_id}}},{{{$status}}},{{{$owner}}},viewBMC"><button type="button" class="btn btn-default">Create new Persona</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
				</div>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>

<?php 

foreach($myPersonas as $myPersona){
	$skills = explode(';',$myPersona["skills"]);
	$needs = explode(';',$myPersona["needs"]);
		
	print '
		<div class="modal fade" id="myPersona'.$myPersona["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Show Persona</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">
		      		<div class="panel panel-default">
		      			<div class="panel-heading">My Persona</div>
		      			<div class="panel-body bmcViewBackground">
		      				<div class="row">
		      					<div class="col-md-4">
		      						<div class="col-md-12 panel panel-default"><b>'.$myPersona["name"].'</b></div>
		      						<div class="col-md-12 panel panel-default persona_view_box"><img alt="Persona Avatar" src="'.$myPersona["avatarImg"].'" height="125px"></div>
		      					</div>
		      					<div class="col-md-8">
		      						<div class="col-md-12 persona_view_box_quote">
		      							<div class="col-md-12">
			      								<b>"'.$myPersona["quote"].'"</b>
			      							</div>
			      						</div>
			      						<div class="col-md-12 panel panel-default">
			      							<div class="col-md-12"><b>Personality</b></div><br>
			      								<p>'.$myPersona["personality"].'</p>
			      						</div>
			      					</div>
			      				</div>
			      				<div class="row">
			      					<div class="col-md-4">
				      					<div class="col-md-12 panel panel-default">
				      						<div class="col-md-12 persona_view_box_content"><b>Age:</b> '.$myPersona["age"].'</div>
			      							<div class="col-md-12 persona_view_box_content"><b>Gender:</b> '.$myPersona["gender"].'</div>
				      						<div class="col-md-12 persona_view_box_content"><b>Marital Status:</b> '.$myPersona["marital_status"].'</div>
				      						<div class="col-md-12 persona_view_box_content"><b>Occupation:</b> '.$myPersona["occupation"].'</div>
				      						<div class="col-md-12 persona_view_box_content"><b>Nationality:</b> '.$myPersona["nationality"].'</div>
				      					</div>
			      					</div>
			      					<div class="col-md-4">
				      					<div class="col-md-12 panel panel-default persona_view_box_content">
				      						<div class="col-md-12"><b>Skills</b></div><br>
				      						<ul>';
												foreach ($skills as $skill){
													print '<li>'.$skill.'</li>';
												}
												print '</ul>
				      					</div>
			      					</div>
			      					<div class="col-md-4">
				      					<div class="col-md-12 panel panel-default persona_view_box_content">
				      						<div class="col-md-12"><b>Needs</b></div><br>
				      						<ul>';
												foreach ($needs as $need){
													print '<li>'.$need.'</li>';
												}
												print '</ul>
				      					</div>
			      					</div>
			      				</div>
					      	</div>
			      		</div>
					</div>
			      </div>
			      <div class="modal-footer">
				    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#addPersonaModal">Show Persona Selection View</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		';
}

?>