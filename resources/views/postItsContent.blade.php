<div class="panel-body canvas_box">
	<?php
	
		$empty = true;
		foreach ($bmc_postIts as $bmc_postIt){
			if($bmc_postIt['canvas_box_id']==$boxId){
				$empty = false;
				print '
					<div class="col-md-12 post_It">
						<div class="post-it-headder">'.$bmc_postIt['title'];
						switch ($bmc_postIt['status']) {
							case 'inWork':
								print '   <button type="button" data-toggle="modal" data-target="" class="btn btn-warning btn-sm post-it-status"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"/></button>';
								break;
							case 'approved':
								print '   <button type="button" data-toggle="modal" data-target="" class="btn btn-success btn-sm post-it-status"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"/></button>';
								break;
							case 'rejected':
								print '   <button type="button" data-toggle="modal" data-target="" class="btn btn-danger btn-sm post-it-status"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"/></button>';
								break;
						}
				print '</div>
						<div>'.$bmc_postIt['content'].'</div>
						<div class="post-it-footer">
							<a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>  
							<a href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
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
				case 7:
					print '<div>Who are your customers? Coose from your Personas.</div>';
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