<div class="panel-body canvas_box">

	<?php 
	$empty = true;
// 		foreach ($myPersonas as $bmc_persona){
// 			print '	<div class="col-md-12 post_It">
// 						<div class="col-md-6 persona_bmc_view_content">
// 							<div class="persona-bmc-headder">'.$bmc_persona["name"].'</div>
// 							<div>'.$bmc_persona["age"].'</div>
// 							<div>'.$bmc_persona["occupation"].'</div>		
// 						</div>
// 						<div class="col-md-6 persona_bmc_view_img">
// 							<img class="avatarImg" src="'.$bmc_persona["avatarImg"].'" alt="avatarImg">
// 						</div>
// 						<div class="persona-bmc-footer">
// 							<a href=""><span class="glyphicon glyphicon-search" aria-hidden="true"/></a>
// 							<a href=""><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a> 
// 						</div>
// 					</div>
// 				';
// 		}

	if($empty){
		print '<div>Who are your customers? Coose from your Personas.</div>';	
	}
	?>

</div>