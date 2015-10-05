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
			print'
				<div class="panel-body primary">
					<h4>'.$assignedPersona["name"].'</h4>
						<div class="col-md-6 col-xs-6 col-sm-12 persona_bmc_view_content">
							<div>'.$assignedPersona["age"].'</div>
							<div>'.$assignedPersona["occupation"].'</div>		
						</div>
						<div class="col-md-6 col-xs-6 col-sm-12 persona_bmc_view_img">
							<img class="avatarImg" src="'.$assignedPersona["avatarImg"].'" alt="avatarImg">
						</div>
					<a class="search-icon" data-toggle="modal" data-target="#myPersona'.$assignedPersona['id'].'"><span class="glyphicon glyphicon-search" aria-hidden="true"/></a>
					<a class="delete-icon" data-toggle="modal" data-target="#deleteModal'.$assignedPersona['id'].'"></a>
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
				      		<div class="col-md-6"><a href="'.$path.'/bmc/deleteAssignedPersona/'.$bmc_id.','.$project_id.','.$status.','.$assignedPersona["id"].','.$owner.',viewBMC"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
			  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
					      </div>
					    </div>
					  </div>
					</div>
  				';
		}

// 	if($empty){
// 		print '<div class="viewBMCEmptyBox">For whom are we creating value?<br>Who are our most important customers?</div>';	
// 	}
	?>

</div>