<?php 
	$posturl = "";
	if($_SERVER['SERVER_NAME']== 'localhost' || $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
		$path = '/bmc/public';
	}else{
		$path = '';
	}
?>

<!-- Help Modal - -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BMC Help</h4>
      </div>
      <div class="modal-body col-md-12 scrollable">
      	<div class="col-md-12">
      		<p>
	      		The Business Model Canvas consists of 9 Elements. Each of them describes a special Aspekt of a business. <br>
	      		It's easier to fill the Business Model Canvas if you stick to the following order: 
      		</p>
      	</div> 
      	
      	<div class="col-md-12">
	      	<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Customer Segments</b>
	      		<div class="col-md-12 col-md-offset-1">To build an effective business model, you must identify which customers it tries to serve. Various sets of customers can be segmented based on the different needs and attributes to ensure appropriate implementation of corporate strategy meets the characteristics of selected group of clients.</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>Who are your customers?</div>
	      	</p>
      	</div>
      	<div class="col-md-12">
      		<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Value Propositions</b>
	      		<div class="col-md-12 col-md-offset-1">The collection of products and services your business offers to meet the needs of your customers. Your Value proposition is what distinguishes yourself from your competitors.</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>How will you make your customers' life happier?</div>
	      	</p>
      	</div>
      	<div class="col-md-12">
			<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Channels</b>
	      		<div class="col-md-12 col-md-offset-1">A company can deliver its value proposition to its targeted customers through different channels. Effective channels will distribute a company's value proposition in ways that are fast, efficient and cost effective. An organization can reach its clients either through its own channels (store front), partner channels (major distributors), or a combination of both</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>How are you going to reach your customers?</div>
	      	</p>
		</div>
		<div class="col-md-12">
			<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Customer Relationships</b>
	      		<div class="col-md-12 col-md-offset-1">To ensure the survival and success of your business, you must identify the type of relationship you want to create with your customer segments.</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>How often will you interact with your customers? Does your product imply one-time or multiple payments?</div>
	      	</p>
		</div>
      	<div class="col-md-12">
      		<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Revenue Streams</b>
	      		<div class="col-md-12 col-md-offset-1">This Segment shows the way your company makes income from each customer segment.</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>How much are you planning to earn in a certain period?</div>
	      	</p>
      	</div>
      	<div class="col-md-12">
	      	<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Key Ressources</b>
	      		<div class="col-md-12 col-md-offset-1">The resources that are necessary to create value for the customer. They are considered an asset to a company, which are needed in order to sustain and support the business. These resources could be human, financial, physical and intellectual</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>What resources do you need to make your idea work?</div>
	      	</p>
      	</div>	
      	<div class="col-md-12">
      		<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Key Activities</b>
	      		<div class="col-md-12 col-md-offset-1">The most important activities in executing a company's value proposition. An example for Bic would be creating an efficient supply chain to drive down costs.</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>What are the key steps to move ahead to your customers?</div>
	      	</p>
      	</div>   
      	<div class="col-md-12">
      		<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Key Partners</b>
	      		<div class="col-md-12 col-md-offset-1">In order to optimize operations and reduce risks of a business model, organization usually cultivate buyer-supplier relationships so they can focus on their core activity.</div>
      			<div class="col-md-12 col-md-offset-1"><i>Question: </i>What are your key partners to get competitive advantage?</div>
      		</p>
      	</div> 
      	<div class="col-md-12">
      		<p>
	      		<span class="glyphicon glyphicon-hand-right col-md-1"></span><b>Cost Structure</b>
	      		<div class="col-md-12 col-md-offset-1">The Coast Structure describes the most important monetary consequences while operating under different business models</div>
	      		<div class="col-md-12 col-md-offset-1"><i>Question: </i>How much are you planning to spend on the product development and marketing for a certain period?</div>
	      	</p>
      	</div>
      	
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
	      <form class="form-horizontal" role="form" method="POST" action="<?php print $path."/bmc/save/".$project_id.','.$posturl.','.$bmc_status.','.$new_bmc_view.','.$owner.',viewBMC,viewBMC' ?>">
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
	      <form class="form-horizontal" role="form" method="POST" action="<?php print $path."/bmc/changeStatus/".$project_id.','.$posturl.','.$bmc_status.','.$new_bmc_view.','.$owner.',viewBMC' ?>">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
				<div class="form-group">
				 	<label for="gender" class="col-md-2 control-label">Status</label>
				 	<div class="col-md-8">
					  <select class="form-control" id="status" name="status">
					  	<?php 
							switch ($bmc_status) {
								case 'inWork':
									print '<option selected value="inWork">inProgress</option><option value="approved">approved</option><option value="rejected">rejected</option>';break;
								case 'approved':
									print '<option value="inWork">inProgress</option><option selected value="approved">approved</option><option value="rejected">rejected</option>';break;
								case 'rejected':
									print '<option value="inWork">inProgress</option><option value="approved">approves</option><option selected value="rejected">rejected</option>';break;
							}
					  	?>
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