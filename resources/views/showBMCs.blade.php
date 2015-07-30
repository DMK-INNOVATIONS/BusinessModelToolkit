@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">All BMC's of <?php print $project_name;?> <button type="button" data-toggle="modal" data-target="helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
									
					<!-- Team Member Table -->
					
					<div class="panel panel-default">
					  <div class="panel-body">
					    <p>In this Table you can see, add and edit all your Business Model Canvas.</p>
					  </div>
					
					  <!-- Table -->
					  <table class="table">
					    <tr>
						    <th>Titel</th>
						    <th class="showBMCTable_center">Status</th>
						    <th class="showBMCTable_center">Version</th>
						    <th>created_at</th>
						    <th>updated_at</th>
						    <th class="showBMCTable_center">edit</th>
						    <th class="showBMCTable_center"></th>
					  	</tr>  	
					  	<?php 					  	
							foreach ($bmcs as $bmc){
								
								$new_bmc_view = true;
								$posturl = $bmc["id"];
								
								print '<tr>';
									print '<td>';
										print $bmc["title"];
									print '</td>';
									print '<td class="showBMCTable_center">';
									
										switch ($bmc["status"]) {
											case 'inWork':
												print '<button type="button" data-toggle="modal" data-target="#statusChangeModal'.$bmc["id"].'" class="btn btn-warning showBMCStatus">'.$bmc["status"].'</button>';
												break;
											case 'approved':
												print '<button type="button" data-toggle="modal" data-target="#statusChangeModal'.$bmc["id"].'" class="btn btn-success showBMCStatus">'.$bmc["status"].'</button>';
												break;
											case 'rejected':
												print '<button type="button" data-toggle="modal" data-target="#statusChangeModal'.$bmc["id"].'" class="btn btn-danger showBMCStatus">'.$bmc["status"].'</button>';
												break;
										}
								
									print '</td>';
									print '<td class="showBMCTable_center">';
										print $bmc["version"];
									print '</td>';
									print '<td>';
										print $bmc["created_at"];
									print '</td>';
									print '<td>';
										print $bmc["updated_at"];
									print '</td>';
									print '<td class="showBMCTable_center">';
										print '<a href="/bmc/public/bmc/edit/'.$bmc["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>   ';
										print '<a href="/bmc/public/bmc/delete/'.$bmc["id"].$project_id.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
									print '</td>';
									print '<td class="showBMCTable_center">';
										$temp_status;
									
										if ($bmc["status"] == 'inWork'){
											$temp_status = 1;
										}elseif ($bmc["status"] == 'approved'){
											$temp_status = 2;
										}elseif ($bmc["status"] == 'rejected'){
											$temp_status = 3;
										}
										print '<a href="/bmc/public/bmc/viewBMC/'.$bmc["id"].$project_id.$temp_status.'"><button type="button" class="btn btn-default">show BMC</button></a>';
									print '</td>';
								print '</tr>';	
							}							
							?>   	
					  </table>
					</div>					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<?php print '<a href="/bmc/public/bmc/create/'.$project_id.'"><button type="button" class="btn btn-primary">new BMC</button></a>';?>
						<a href="{{ url('/projects') }}"><button type="button" class="btn btn-default">Back to Projects</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BMC Help</h4>
      </div>
      <div class="modal-body">
      	...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection