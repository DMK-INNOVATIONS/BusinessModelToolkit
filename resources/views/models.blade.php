@extends('app') @section('content')

<?php 

	if($_SERVER['SERVER_NAME']== 'localhost' || $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
		$path = '/bmc/public';
	}else{
		$path = '';
	}
?>

<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
	  <h1>Model View <br><small>View, add and edit all your Models.</small></h1>
	</div>
	<div class="row">
	
		<!-- User Models Table - Start -->
		
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>My Models</b> <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
					
					<div class="panel panel-default">
					  
					  <div class="row table_head" style="text-align: center;">
					  	<div class="col-md-2 col-sm-6 col-xs-6 ">Project</div>
					  	<div class="col-md-10 col-md-10 col-md-10">
					  		<div class="col-md-2 col-sm-6 col-xs-6 ">Title</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Status</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Created at</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Updated at</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Tools</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Business Models</div>
					  	</div>
					  </div>
					  
					  <?php 
					  	foreach($projects as $project){
					  		print '
								<div class="row table_body" style="text-align: center;">
								  	<div class="col-md-2 col-sm-12 col-xs-12">'.$project['title'].'</div>
								  	<div class="col-md-10 col-md-12 col-md-12">';
	  									foreach($bmcs as $bmcs_pack){
	  										$anz_elemente = 1;
	  										
	  										foreach($bmcs_pack as $bmc){
	  											
	  											if(count($bmcs_pack) == $anz_elemente){
	  												$table_class = 'table_body_last';	
	  											}else{
	  												$table_class = 'table_body';
	  											}
	  											
	  											
	  											$created_at = explode(' ', $bmc["created_at"]);
	  											$created_at_date = $created_at[0];
	  											$created_at_time = $created_at[1];
	  												
	  											$updated_at = explode(' ', $bmc["updated_at"]);
	  											$updated_at_date = $updated_at[0];
	  											$updated_at_time = $created_at[1];
	  											
	  											if($bmc['project_id'] == $project['id']){
	  												print '
														<div class="row '.$table_class.'">
												  			<div class="col-md-2 col-sm-6 col-xs-6 ">'.$bmc['title'].'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">';
				  												switch ($bmc ["status"]) {
				  													case 'inWork' :
				  														print '<button type="button" class="btn btn-warning showBMCStatus disabled">inProgress</button>';
				  														break;
				  													case 'approved' :
				  														print '<button type="button" class="btn btn-success showBMCStatus disabled">approved</button>';
				  														break;
				  													case 'rejected' :
				  														print '<button type="button" class="btn btn-danger showBMCStatus disabled">rejected</button>';
				  														break;
				  												}
					  								print '	</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">'.$created_at_date.', '.$created_at_time.'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">'.$updated_at_date.', '.$updated_at_time.'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">
	  															<a href="'.$path.'/bmc/edit/' . $bmc ["id"] . ',1,models">
																		<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"/>
																</a>   
																<a href="'.$path.'/bmc/copyBmc/' . $bmc ["id"] . ',' . $project['id'] . ',1,models">
																		<span class="glyphicon glyphicon-file" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="duplicate"/>
																</a>   
																<a href="'.$path.'/export/'.$bmc ["id"]. ',' . $project['id'].',1,models">
																		<span class="glyphicon glyphicon-export" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="export"/>
																</a> 
																<a data-toggle="modal" data-target="#deleteModal' . $bmc ['id'] . '">
																		<span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/>
																</a>
	  														</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">';
								  								$temp_status;
								  								
								  								if ($bmc ["status"] == 'inWork') {
								  									$temp_status = 1;
								  								} elseif ($bmc ["status"] == 'approved') {
								  									$temp_status = 2;
								  								} elseif ($bmc ["status"] == 'rejected') {
								  									$temp_status = 3;
								  								}
								  								print '<a href="'.$path.'/bmc/viewBMC/' . $bmc ["id"] . ',' . $project['id'] . ',' . $temp_status . ',1,models"><button type="button" class="btn btn-default">Show Model</button></a>';
  													print'</div>
														</div>
													';
					  								print '
										  					<div class="modal fade" id="deleteModal' . $bmc ["id"] . '" tabindex="-1" role="dialog">
															  <div class="modal-dialog delete" role="document">
															    <div class="modal-content delete col-md-12">
															      <div class="modal-header col-md-12">
															        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															        <h4 class="modal-title">Do you want to delete ' . $bmc ["title"] . '?</h4>
															      </div>
															      <div class="modal-footer delete col-md-12">
														      		<div class="col-md-6"><a href="'.$path.'/bmc/delete/' . $bmc ["id"] . ',' . $project['id'] . ',1,models"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
													  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
															      </div>
															    </div>
															  </div>
															</div>
										  				';
	  											}	
	  											$temp = $anz_elemente +1;
	  											$anz_elemente = $temp;
	  										}
	  									}
						print '		</div>
								 </div>
							';	
					  	}
					  	
					  ?>
					</div>
					
					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="<?php print $path.'/bmc/createModel';?>"><button type="button" class="btn btn-primary">New Model</button></a>
					</div>
				</div>
			</div> 
		</div>
		
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>My assigned Models</b></div>
				<div class="panel-body">
					
					<div class="panel panel-default">
					  
					  <div class="row table_head" style="text-align: center;">
					  	<div class="col-md-2 col-sm-6 col-xs-6 ">
					  		<div class="col-md-6 col-sm-6 col-xs-6 ">Project</div>
					  		<div class="col-md-6 col-sm-6 col-xs-6 ">Owner</div>
					  	</div>
					  	<div class="col-md-10 col-md-10 col-md-10">
					  		<div class="col-md-2 col-sm-6 col-xs-6 ">Title</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Status</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Created at</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Updated at</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Tools</div>
							<div class="col-md-2 col-sm-6 col-xs-6 ">Business Models</div>
					  	</div>
					  </div>
					  
					  <?php 
					  	foreach($my_assigned_Projects as $my_assigned_Project){
					  		print '
								<div class="row table_body" style="text-align: center;">
								  	<div class="col-md-2 col-sm-12 col-xs-12">
										<div class="col-md-6 col-sm-6 col-xs-6 ">'.$my_assigned_Project['title'].'</div>
					  					<div class="col-md-6 col-sm-6 col-xs-6 ">';
					  		
					  						$anz = 0;
											foreach($my_assigned_Projects_Owners as $owner){
												if($my_assigned_Project['assignee_id'] == $owner['id'] ){
													if($anz < 1){
														print $owner['name'];
													}
													$temp = $anz+1;
													$anz = $temp;
												}	
											}	
							print '		</div>
									</div>
								  	<div class="col-md-10 col-md-12 col-md-12">';
	  									foreach($my_assigned_BMCs as $my_assigned_BMCs_pack){
	  										$anz_elemente = 1;
	  										
	  										foreach($my_assigned_BMCs_pack as $bmc){
	  											
	  											if(count($bmcs_pack) == $anz_elemente){
	  												$table_class = 'table_body_last';	
	  											}else{
	  												$table_class = 'table_body';
	  											}
	  											
	  											
	  											$created_at = explode(' ', $bmc["created_at"]);
	  											$created_at_date = $created_at[0];
	  											$created_at_time = $created_at[1];
	  												
	  											$updated_at = explode(' ', $bmc["updated_at"]);
	  											$updated_at_date = $updated_at[0];
	  											$updated_at_time = $created_at[1];
	  											
	  											if($bmc['project_id'] == $my_assigned_Project['id']){
	  												print '
														<div class="row '.$table_class.'">
												  			<div class="col-md-2 col-sm-6 col-xs-6 ">'.$bmc['title'].'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">';
				  												switch ($bmc ["status"]) {
				  													case 'inWork' :
				  														print '<button type="button" class="btn btn-warning showBMCStatus disabled">unclear</button>';
				  														break;
				  													case 'approved' :
				  														print '<button type="button" class="btn btn-success showBMCStatus disabled">validated</button>';
				  														break;
				  													case 'rejected' :
				  														print '<button type="button" class="btn btn-danger showBMCStatus disabled">invalidated</button>';
				  														break;
				  												}
					  								print '	</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">'.$created_at_date.', '.$created_at_time.'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">'.$updated_at_date.', '.$updated_at_time.'</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">  
																<a href="'.$path.'/export/'.$bmc ["id"]. ',' . $project['id'].',1,models">
																		<span class="glyphicon glyphicon-export" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="export"/>
																</a> 
	  														</div>
															<div class="col-md-2 col-sm-6 col-xs-6 ">';
								  								$temp_status;
								  								
								  								if ($bmc ["status"] == 'inWork') {
								  									$temp_status = 1;
								  								} elseif ($bmc ["status"] == 'approved') {
								  									$temp_status = 2;
								  								} elseif ($bmc ["status"] == 'rejected') {
								  									$temp_status = 3;
								  								}
								  								print '<a href="'.$path.'/bmc/viewBMC/' . $bmc ["id"] . ',' . $project['id'] . ',' . $temp_status . ',1,models"><button type="button" class="btn btn-default">Show Model</button></a>';
  													print'</div>
														</div>
													';
	  											}	
	  											$temp = $anz_elemente +1;
	  											$anz_elemente = $temp;
	  										}
	  									}
						print '		</div>
								 </div>
							';	
					  	}
					  	
					  ?>
					</div>
				</div>
			</div> 
		</div>
		
	</div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Models View Help</h4>
      </div>
      <div class="modal-body">
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">The Models View contains all your created and assigned Models, sorted by their projects.</div>
			</p> 
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">While you can only export assigned Models, you can use the following Tools on your own Models: </div>
			</p>
	      	<p>
	      		<span class="glyphicon glyphicon-pencil col-md-offset-2" aria-hidden="true"></span> - edit: Used to change the Title of the Model.
      		</p>
      		<p>
	      		<span class="glyphicon glyphicon-file col-md-offset-2" aria-hidden="true"></span> - duplicate: Used to duplicate a Model.
      		</p>
      		<p>
	      		<span class="glyphicon glyphicon-export col-md-offset-2" aria-hidden="true"></span> - export: Used to export a Model.
      		</p>
	      	<p>
	      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete no longer used Model.
      		</p>
		
      	
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11">To show a Model use the <button type="button" class="btn btn-default disabled">show Model </button> Button.</div>
      		</p>
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11" style="padding: 0 0 15px 0;">Also you can create new Model with the <button type="button" class="btn btn-primary disabled">New Model</button> Button.</div>
      		</p>    			
      </div>
      <div class="modal-footer col-md-12" style="margin: 0;">
        <p><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></p>
      </div>
    </div>
  </div>
</div>
@endsection
