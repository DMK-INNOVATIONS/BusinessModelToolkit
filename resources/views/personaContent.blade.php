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
							<a href="/bmc/public/bmc/deleteAssignedPersona/'.$bmc_id.','.$project_id.','.$status.','.$assignedPersona["id"].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a> 
						</div>
					</div>
				';
			$empty = false;
		}

	if($empty){
		print '<div>Who are your customers? Coose from your Personas.</div>';	
	}
	?>

</div>