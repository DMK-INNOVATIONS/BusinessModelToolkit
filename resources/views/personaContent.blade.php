<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
 
	if($_SERVER['SERVER_NAME']== 'localhost' || $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
		$path = '/bmc/public';
	}else{
		$path = '';
	}
?>

<div class="panel-body canvas_box">

	<?php 
	$empty = true;

		foreach ($myAssignedPersonas as $assignedPersona){
			print '	<div class="col-md-12 col-sm-12 post_It">
						<div class="col-md-6 col-xs-6 col-sm-12 persona_bmc_view_content">
							<div class="persona-bmc-headder">'.$assignedPersona["name"].'</div>
							<div>'.$assignedPersona["age"].'</div>
							<div>'.$assignedPersona["occupation"].'</div>		
						</div>
						<div class="col-md-6 col-xs-6 col-sm-12 persona_bmc_view_img">
							<img class="avatarImg" src="'.$assignedPersona["avatarImg"].'" alt="avatarImg">
						</div>
						<div class="persona-bmc-footer col-md-6 col-sm-12 col-md-offset-6">
							<a data-toggle="modal" data-target="#myPersona'.$assignedPersona['id'].'"><span class="glyphicon glyphicon-search" aria-hidden="true"/></a>
							<a data-toggle="modal" data-target="#deleteModal'.$assignedPersona['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a> 
						</div>
					</div>
				';
			$empty = false;
			
			print '
  					<div class="modal fade" id="deleteModal'.$assignedPersona["id"].'" tabindex="-1" role="dialog">
					  <div class="modal-dialog delete" role="document">
					    <div class="modal-content delete col-md-12">
					      <div class="modal-header col-md-12">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Do you want to remove '.$assignedPersona["name"].' from your BMC?</h4>
					      </div>
					      <div class="modal-footer delete col-md-12">
				      		<div class="col-md-6"><a href="'.$path.'/bmc/deleteAssignedPersona/'.$bmc_id.','.$project_id.','.$status.','.$assignedPersona["id"].','.$owner.'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
			  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
					      </div>
					    </div>
					  </div>
					</div>
  				';
			
			$skills = explode(';',$assignedPersona["skills"]);
			$needs = explode(';',$assignedPersona["needs"]);
				
			print '
				<div class="modal fade" id="myPersona'.$assignedPersona["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Persona Help</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="container-fluid">
				      		<div class="panel panel-default">
				      			<div class="panel-heading">My Persona</div>
				      			<div class="panel-body bmcViewBackground">
				      				<div class="row">
				      					<div class="col-md-4">
				      						<div class="col-md-12 panel panel-default"><b>'.$assignedPersona["name"].'</b></div>
				      						<div class="col-md-12 panel panel-default persona_view_box"><img alt="Persona Avatar" src="'.$assignedPersona["avatarImg"].'" height="125px"></div>
				      					</div>
				      					<div class="col-md-8">
				      						<div class="col-md-12 persona_view_box_quote">
				      							<div class="col-md-12">
				      								<b>"'.$assignedPersona["quote"].'"</b>
				      							</div>
				      						</div>
				      						<div class="col-md-12 panel panel-default">
				      							<div class="col-md-12"><b>Personality</b></div><br>
				      								<p>'.$assignedPersona["personality"].'</p>
				      						</div>
				      					</div>
				      				</div>
				      				<div class="row">
				      					<div class="col-md-4">
					      					<div class="col-md-12 panel panel-default">
					      						<div class="col-md-12 persona_view_box_content"><b>Age:</b> '.$assignedPersona["age"].'</div>
				      							<div class="col-md-12 persona_view_box_content"><b>Gender:</b> '.$assignedPersona["gender"].'</div>
					      						<div class="col-md-12 persona_view_box_content"><b>Marital Status:</b> '.$assignedPersona["marital_status"].'</div>
					      						<div class="col-md-12 persona_view_box_content"><b>Occupation:</b> '.$assignedPersona["occupation"].'</div>
					      						<div class="col-md-12 persona_view_box_content"><b>Nationality:</b> '.$assignedPersona["nationality"].'</div>
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

	if($empty){
		print '<div class="viewBMCEmptyBox">For whom are we creating value?<br>Who are our most important customers?</div>';	
	}
	?>

</div>