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
							<a href=""><span class="glyphicon glyphicon-search" aria-hidden="true"/></a>
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
				      		<div class="col-md-6"><a href="/bmc/public/bmc/deleteAssignedPersona/'.$bmc_id.','.$project_id.','.$status.','.$assignedPersona["id"].','.$owner.'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
			  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
					      </div>
					    </div>
					  </div>
					</div>
  				';
		}

	if($empty){
		print '<div>Who are your customers? Coose from your Personas.</div>';	
	}
	?>

</div>