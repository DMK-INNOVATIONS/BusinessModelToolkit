<!-- add Post-It Modal -->
<?php $post_it_id = "null";?>

<?php print '<div class="modal fade" id="addPostItModal'.$boxId.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">add Post-It</h4>
      </div>
      <div class="modal-body">
        <div class="row">
	    	<div class="col-md-4 Post-It_Image">
	    		<div class="row">
	    			<div class="col-md-12">
						<img src="{{ asset('img/Postit_gelb.jpg') }}">
					</div>
				</div>
	    	</div>
 	 		<div class="col-md-8">
				<form class="form-horizontal" role="form" method="POST" action="<?php print "/bmc/public/bmc/savePostIt/".$boxId.','.$bmc_id.','.$project_id.','.$status.','.$post_it_id ?>">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
					<div class="form-group">
						<label class="col-md-4 control-label">Title</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Content</label>
						<div class="col-md-8">
							<textarea class="form-control" rows="3" name="content"></textarea>
						</div>
					</div>
					<div class="form-group">
					 	<label for="test_status" class="col-md-4 control-label">Test Status</label>
					 	<div class="col-md-8">
						  <select class="form-control" id="status" name="status">
						    <option>inWork</option>
						    <option>approved</option>
						    <option>rejected</option>
						  </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Notice</label>
						<div class="col-md-8">
							<textarea class="form-control" rows="5" name="notice"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
						</div>
					</div>
				</form>
 	 		</div>
		</div>
      </div>
    </div>
  </div>
</div>