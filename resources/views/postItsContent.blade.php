<div class="panel-body canvas_box">
	<?php
		$empty = true;
		foreach ($bmc_postIts as $bmc_postIt){
			if($bmc_postIt['canvas_box_id']==$boxId){
				$empty = false;
				print '	<div class="col-md-12 post_It">
							<div class="post-it-headder">
								<div class="col-md-8 post_It_content">'.$bmc_postIt['title'].'</div>
								<div class="col-md-4 post_It_content">';	
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
							<div class="col-md-12 post_It_content">'.$bmc_postIt['content'].'</div>
							<div class="row post-it-footer">
								<a href="#addPostItModal'.$boxId.'" role="button" data-toggle="modal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>  
								<a href="/bmc/public/bmc/deletePostIt/'.$bmc_postIt['id'].$bmc_id.$project_id.$status.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
							</div>
						</div>
				';
				
				print '
					<!-- change Post-It Status Modal -->
						<div class="modal fade" id="statusChangeModal_Post-IT'.$bmc_postIt['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						      	<h4>Change the Status of your Post-It</h4>
						      </div>
						      <div class="modal-body">
							      <form class="form-horizontal" role="form" method="POST" action="/bmc/public/bmc/changePostItStatus/'.$project_id.','.$bmc_id.','.$bmc_status.','.$bmc_postIt['id'].'">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
								
										<div class="form-group">
										 	<label for="post_it" class="col-md-2 control-label">Status</label>
										 	<div class="col-md-8">
											  <select class="form-control" id="postIt_status" name="postIt_status">
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