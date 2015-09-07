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
		foreach ($bmc_postIts as $bmc_postIt){
			if($bmc_postIt['canvas_box_id']==$boxId){
				$empty = false;
				print '	<div class="col-md-12 col-xs-12 post_It">
							<div class="post-it-headder">
								<div class="col-md-8 col-xs-8 post_It_content">'.$bmc_postIt['title'].'</div>
								<div class="col-md-4 col-xs-4 post_It_content">';	
									switch ($bmc_postIt['status']) {
										case 'inWork':
											print '   <button type="button" data-toggle="modal" data-target="#statusChangeModal_Post-IT'.$bmc_postIt['id'].'" class="btn btn-warning btn-sm post-it-status"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"/></button>';
											break;
										case 'approved':
											print '   <button type="button" data-toggle="modal" data-target="#statusChangeModal_Post-IT'.$bmc_postIt['id'].'" class="btn btn-success btn-sm post-it-status"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"/></button>';
											break;
										case 'rejected':
											print '   <button type="button" data-toggle="modal" data-target="#statusChangeModal_Post-IT'.$bmc_postIt['id'].'" class="btn btn-danger btn-sm post-it-status"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"/></button>';
											break;
									}
				print '			</div>
							</div>
							<div class="col-md-12 col-xs-12 post_It_content">'.$bmc_postIt['content'].'</div>
							<div class="row post-it-footer col-md-12 col-xs-12">
								<a href="#editPostItModal'.$boxId.$bmc_postIt['id'].'" role="button" data-toggle="modal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>  
								<a data-toggle="modal" data-target="#deleteModal'.$bmc_postIt['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
							</div>
						</div>

										
					<div class="modal fade" id="statusChangeModal_Post-IT'.$bmc_postIt['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					      	<h4>Change the Status of your Post-It</h4>
					      </div>
					      <div class="modal-body">
						      <form class="form-horizontal" role="form" method="POST" action="'.$path.'/bmc/changePostItStatus/'.$project_id.','.$bmc_id.','.$bmc_status.','.$bmc_postIt["id"].','.$owner.'">
									<input type="hidden" name="_token" value="'.csrf_token().'">
							
									<div class="form-group">
									 	<label for="postIt_status" class="col-md-2 control-label">Status</label>
									 	<div class="col-md-8">									
											<select class="form-control" id="postIt_status" name="postIt_status">
											';
												switch ($bmc_postIt['status']) {
													case 'inWork':
														print '<option selected>inWork</option><option>approved</option><option>rejected</option>';break;
													case 'approved':
														print '<option>inWork</option><option selected>approved</option><option>rejected</option>';break;
													case 'rejected':
														print '<option>inWork</option><option>approved</option><option selected>rejected</option>';break;									
												}
											    print '
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

	      			<div class="modal fade" id="editPostItModal'.$boxId.$bmc_postIt['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
												<img src="'.$path.'/img/Postit_gelb.jpg">
											</div>
										</div>
							    	</div>
						 	 		<div class="col-md-8">
										<form class="form-horizontal" role="form" method="POST" action="'.$path.'/bmc/savePostIt/'.$boxId.','.$bmc_id.','.$project_id.','.$status.','.$bmc_postIt['id'].','.$owner.'">
											<input type="hidden" name="_token" value="'. csrf_token() .'">
									
											<div class="form-group">
												<label class="col-md-4 control-label">Title</label>
												<div class="col-md-8">
													<input type="text" class="form-control" name="title" value="'.$bmc_postIt['title'].'">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 control-label">Content</label>
												<div class="col-md-8">
													<textarea class="form-control" rows="3" name="content">'.$bmc_postIt['content'].'</textarea>
												</div>
											</div>
											<div class="form-group">
											 	<label for="test_status" class="col-md-4 control-label">Test Status</label>
											 	<div class="col-md-8">
												  <select class="form-control" id="status" name="status">
												';
													switch ($bmc_postIt['status']) {
														case 'inWork':
															print '<option selected>inWork</option><option>approved</option><option>rejected</option>';break;
														case 'approved':
															print '<option>inWork</option><option selected>approved</option><option>rejected</option>';break;
														case 'rejected':
															print '<option>inWork</option><option>approved</option><option selected>rejected</option>';break;									
													}
												    print '
												  </select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4 control-label">Notice</label>
												<div class="col-md-8">
													<textarea class="form-control" rows="5" name="notice">'.$bmc_postIt['notice'].'</textarea>
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
				';
												    
			    print '
  					<div class="modal fade" id="deleteModal' . $bmc_postIt["id"] . '" tabindex="-1" role="dialog">
					  <div class="modal-dialog delete" role="document">
					    <div class="modal-content delete col-md-12">
					      <div class="modal-header col-md-12">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Do you want to delete ' . $bmc_postIt ["title"] . '?</h4>
					      </div>
					      <div class="modal-footer delete col-md-12">
				      		<div class="col-md-6"><a href="'.$path.'/bmc/deletePostIt/'.$bmc_postIt['id'].','.$bmc_id.','.$project_id.','.$status.','.$owner.'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
			  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
					      </div>
					    </div>
					  </div>
					</div>
  				';
			}
		}
		
		if($empty){
			switch ($boxId) {
				case 1:
					print '<div>What are your key partners to get competitive advantage?</div>';
					break;
				case 2:
					print '<div>What are the key steps to move ahead to your customers?</div>';
					break;
				case 3:
					print '<div>What resources do you need to make your idea work?</div>';
					break;
				case 4:
					print "<div>How will you make your customers' life happier?</div>";
					break;
				case 5:
					print '<div>How often will you interact with your customers? Does your product imply one-time or multiple payments?</div>';
					break;
				case 6:
					print '<div>How are you going to reach your customers?</div>';
					break;
				case 8:
					print '<div>How much are you planning to spend on the product development and marketing for a certain period?</div>';
					break;
				case 9:
					print '<div>How much are you planning to earn in a certain period? Compare your costs & revenues.</div>';
					break;
			}
		}
	
	?>
</div>