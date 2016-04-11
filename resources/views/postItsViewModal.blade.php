<!-- add Post-It Modal -->
<?php $post_it_id = "null";?>

<?php 
	$posturl = "";
	if(isset($user)) : $posturl = $user['id']; endif;
	
	switch ($boxId) {
		case 1:
			$canvas_box_name ='Key Partners';
			break;
		case 2:
			$canvas_box_name ='Key Activities';
			break;
		case 3:
			$canvas_box_name ='Key Ressources';
			break;
		case 4:
			$canvas_box_name ='Value Propositions';
			break;
		case 5:
			$canvas_box_name ='Customer Relationships';
			break;
		case 6:
			$canvas_box_name ='Channels';
			break;
		case 7:
			$canvas_box_name ='Customer Segments';
			break;
		case 8:
			$canvas_box_name ='Cost Structure';
			break;
		case 9:
			$canvas_box_name ='Revenue Streams';
			break;
	}
	
?>

<div class="modal fade" id="addPostItModal{{{ $boxId }}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Sticky Note in {{{ $canvas_box_name }}}</h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
		    	<!-- 
		    	<div class="col-md-4 Post-It_Image">
		    		<div class="row">
		    			<div class="col-md-12">
							<img src="{{{ asset('img/Postit_gelb.jpg') }}}">
						</div>
					</div>
		    	</div>
		    	 -->
	 	 		<div class="col-md-12">
					<form class="form-horizontal" role="form" method="POST" action="{{{ $path }}}/bmc/savePostIt/{{{ $boxId}}},{{{ $bmc_id }}},{{{ $project_id }}},{{{ $status }}},{{{ $post_it_id }}},{{{ $owner }}},viewBMC">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				
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
							  	<?php foreach ($status_option as $key=>$val):?>
							  		<option value="{{{$key}}}">{{{$val}}}</option>
								<?php endforeach;?>
							  </select>
							</div>
						</div>
						
						<div class="form-group">
						 	<label for="test_status" class="col-md-4 control-label">Background Color</label>
						 	<div class="col-md-8">
							  <select class="form-control" id="color" name="color">
							    <option value="blue">blue</option>
							    <option value="red">red</option>
							    <option value="yellow">yellow</option>
							    <option value="green">green</option>
							    <option value="grey">grey</option>
							  </select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Note</label>
							<div class="col-md-8">
								<textarea class="form-control" rows="5" name="notice"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-primary btn-secundar" data-dismiss="modal">Back</button>
							</div>
						</div>
					</form>
	 	 		</div>
			</div>
	      </div>
	    </div>
	  </div>
</div>