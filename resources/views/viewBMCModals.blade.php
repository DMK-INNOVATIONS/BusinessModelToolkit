<!-- Help Modal - -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BMC Help</h4>
      </div>
      <div class="modal-body">
      	<p>
      		<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span>
      		<div>The Business Model Canvas consists of the following nine Parts:</div>
      	</p>
      	
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Key Partners:</b> What are your key partners to get competitive advantage?</div>
      		</div>
      	</p>
     	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Key Activities:</b> What are the key steps to move ahead to your customers?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Key Ressources:</b> What resources do you need to make your idea work?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Value Propositions:</b> How will you make your customers' life happier?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Customer Relations:</b> How often will you interact with your customers? Does your product imply one-time or multiple payments?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Channels:</b> How are you going to reach your customers?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Customer Segments:</b> Who are your customers? Coose from your Personas.</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Cost Structure:</b> How much are you planning to spend on the product development and marketing for a certain period?</div>
      		</div>
      	</p>
      	<p>
      		<div class="col-md-offset-1">
	      		<span class="glyphicon glyphicon-play col-md-1" aria-hidden="true"></span>
	      		<div><b>Revenue Streams:</b> How much are you planning to earn in a certain period? Compare your costs & revenues.</div>
      		</div>
      	</p>
      </div>
      <div class="modal-footer col-md-12">
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