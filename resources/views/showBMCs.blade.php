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
		<h1><?php print $project_name;?><br>
			<small>View, add and edit the Business Models of this Project.</small>
		</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b>All BMC's of <?php print $project_name;?></b>
					<button type="button" data-toggle="modal" data-target="#helpModal"
						class="btn btn-default btn-sm">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
					</button>
				</div>
				<div class="panel-body">

					<!-- Team Member Table -->

					<div class="panel panel-default" style="text-align: center;">
						<div class="row table_head">
							<div class="col-md-2 col-sm-12 col-xs-12">Title</div>
							<div class="col-md-1 col-sm-6 col-xs-6">Status</div>
							<div class="col-md-1 col-sm-6 col-xs-6">Version</div>
							<div class="col-md-2 col-sm-6 col-xs-6">Created at</div>
							<div class="col-md-2 col-sm-6 col-xs-6">Updated at</div>
							<div class="col-md-2 col-sm-6 col-xs-6">Tools</div>
							<div class="col-md-2 col-sm-6 col-xs-6">Business Models</div>
						</div>

					  	<?php
								foreach ( $bmcs as $bmc ) {
									
									$created_at = explode(' ', $bmc["created_at"]);
									$created_at_date = $created_at[0];
									$created_at_time = $created_at[1];
									
									$updated_at = explode(' ', $bmc["updated_at"]);
									$updated_at_date = $updated_at[0];
									$updated_at_time = $created_at[1];
									
									$new_bmc_view = true;
									$posturl = $bmc ["id"];
									
									print '<div class="row table_body" style="text-align:center;">
											<div class="col-md-2 col-sm-12 col-xs-12">' . $bmc ["title"] . '</div>
											<div class="col-md-1 col-sm-6 col-xs-6">';
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
									print '		</div>
											<div class="col-md-1 col-sm-6 col-xs-6" style="height: 35px;">' . $bmc ["version"] . '</div>
											<div class="col-md-2 col-sm-6 col-xs-6">' . $created_at_date .', '.$created_at_time. '</div>
											<div class="col-md-2 col-sm-6 col-xs-6">' . $updated_at_date .', '.$updated_at_time. '</div>
											<div class="col-md-2 col-sm-6 col-xs-6">
										';
									
									if ($owner == 0) {
										print '   
													<a href="'.$path.'/export/'.$bmc ["id"]. ',' . $project_id.',0"">
															<span class="glyphicon glyphicon-export" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="export"/>
													</a> 	
												';
									} else {
										print '
													<a href="'.$path.'/bmc/edit/' . $bmc ["id"] . ',1,showBMCs">
															<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"/>
													</a>   
													<a href="'.$path.'/bmc/copyBmc/' . $bmc ["id"] . ',' . $project_id . ',1,showBMCs">
															<span class="glyphicon glyphicon-file" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="duplicate"/>
													</a>   
													<a href="'.$path.'/export/'.$bmc ["id"]. ',' . $project_id.',1,showBMCs">
															<span class="glyphicon glyphicon-export" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="export"/>
													</a> 
													<a data-toggle="modal" data-target="#deleteModal' . $bmc ['id'] . '">
															<span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/>
													</a>
												';
									}
									
									print '		</div>
											<div class="col-md-2 col-sm-6 col-xs-6">';
												$temp_status;
												
												if ($bmc ["status"] == 'inWork') {
													$temp_status = 1;
												} elseif ($bmc ["status"] == 'approved') {
													$temp_status = 2;
												} elseif ($bmc ["status"] == 'rejected') {
													$temp_status = 3;
												}
												print '<a href="'.$path.'/bmc/viewBMC/' . $bmc ["id"] . ',' . $project_id . ',' . $temp_status . ',' . $owner . ',showBMCs"><button type="button" class="btn btn-default">Show Model</button></a>';
								print '		</div>
										</div>';
									
									print '
					  					<div class="modal fade" id="deleteModal' . $bmc ["id"] . '" tabindex="-1" role="dialog">
										  <div class="modal-dialog delete" role="document">
										    <div class="modal-content delete col-md-12">
										      <div class="modal-header col-md-12">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Do you want to delete ' . $bmc ["title"] . '?</h4>
										      </div>
										      <div class="modal-footer delete col-md-12">
									      		<div class="col-md-6"><a href="'.$path.'/bmc/delete/' . $bmc ["id"] . ',' . $project_id . ',1,showBMCs"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
										      </div>
										    </div>
										  </div>
										</div>
					  				';
								}
								?>   	
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<?php
						if ($owner == 1) {
							print '<a href="'.$path.'/bmc/create/' . $project_id . ',' . $owner . '"><button type="button" class="btn btn-primary">New Model</button></a>';
						}
						?>
						<a href="{{ url('/projects') }}"><button type="button" class="btn btn-default">Back to Projects</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content col-md-12">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Project Help</h4>
			</div>
			<div class="modal-body">
				<p>
					<span class="glyphicon glyphicon-hand-right col-md-1"
						aria-hidden="true"></span>
				
				
				<div class="col-md-11">This View contains all BMC of your choosen
					project.</div>
				</p>

				<p>
					<span class="glyphicon glyphicon-hand-right col-md-1"
						aria-hidden="true"></span>
				
				
				<div class="col-md-11">You can use the following Tools on the BMC's
					of this Project:</div>
				</p>
			<?php
			if ($owner == 0) {
				print '
			      		<p>
				      		<span class="glyphicon glyphicon-export col-md-offset-2" aria-hidden="true"></span> - export: Used to export a BMC.
			      		</p>
					';
			} else {
				print '
						<p>
				      		<span class="glyphicon glyphicon-pencil col-md-offset-2" aria-hidden="true"></span> - edit: Used to change the Title of the BMC.
			      		</p>
			      		<p>
				      		<span class="glyphicon glyphicon-file col-md-offset-2" aria-hidden="true"></span> - duplicate: Used to duplicate a BMC.
			      		</p>
			      		<p>
				      		<span class="glyphicon glyphicon-export col-md-offset-2" aria-hidden="true"></span> - export: Used to export a BMC.
			      		</p>
				      	<p>
				      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete no longer used BMC.
			      		</p>	
					';
			}
			?>
      		<p>
					<span class="glyphicon glyphicon-hand-right col-md-1"
						aria-hidden="true"></span>
				
				
				<div class="col-md-11" style="padding: 0 0 15px 0;">
					To show the edit View of a Business Model Canvas click the
					<button type="button" class="btn btn-default disabled">show BMC</button>
					Button.
				</div>
				</p>
      		
      		<?php
								if ($owner == 1) {
									print '
	      				<p>
		      				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span>
		      				<div class="col-md-11" style="padding: 0 0 15px 0;">Also you can create new BMC in this project when you click the <button type="button" class="btn btn-primary disabled">New Project</button> Button.</div>
	      				</p>  
					';
								}
								?>    			
      </div>
			<div class="modal-footer col-md-12" style="margin: 0;">
				<p>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
