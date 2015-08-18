<!-- Help Modal - -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BMC Help</h4>
      </div>
      <div class="modal-body">
        ... Hier muss noch Text rein ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- BMC Title Change Modal -->
<?php 
	$new_bmc_view = 0;
	$posturl = $bmc_id;
	$view_type = 'viewBMC';
?>


<div class="modal fade" id="titleChangeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<h4>Change the Title of Your BMC</h4>
      </div>
      <div class="modal-body">
	      <form class="form-horizontal" role="form" method="POST" action="<?php print "/bmc/public/bmc/save/".$project_id.','.$posturl.','.$bmc_status.','.$new_bmc_view.','.$owner ?>">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
				<div class="form-group">
					<label class="col-md-4 control-label">Title</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="title" value="<?php print $bmc_name?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
					</div>
				</div>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- change BMC Status Modal -->
<div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<h4>Change the Status of <?php print $bmc_name;?></h4>
      </div>
      <div class="modal-body">
	      <form class="form-horizontal" role="form" method="POST" action="<?php print "/bmc/public/bmc/changeStatus/".$project_id.','.$posturl.','.$bmc_status.','.$new_bmc_view.','.$owner ?>">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
				<div class="form-group">
				 	<label for="gender" class="col-md-2 control-label">Status</label>
				 	<div class="col-md-8">
					  <select class="form-control" id="status" name="status">
					    <option>inWork</option>
					    <option>approved</option>
					    <option>rejected</option>
					  </select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-md-offset-2">
						<button type="submit" class="btn btn-primary">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
					</div>
				</div>
			</form>
      </div>
    </div>
  </div>
</div>