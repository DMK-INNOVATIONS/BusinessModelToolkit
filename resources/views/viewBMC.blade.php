@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b><?php print $bmc_name?></b>  
					<button type="button" data-toggle="modal" data-target="#titleChangeModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>  
					<?php //Shows Button in Color of Status
						$status;
						switch ($bmc_status) {
							case 'inWork':
								print '<button type="button" data-toggle="modal" data-target="#statusChangeModal" class="btn btn-warning btn-sm viewBMCStatus">'.$bmc_status.'</button>'  ;
								$status = 1;
								break;
							case 'approved':
								print '<button type="button" data-toggle="modal" data-target="#statusChangeModal" class="btn btn-success btn-sm viewBMCStatus">'.$bmc_status.'</button>'  ;
								$status = 2;
								break;
							case 'rejected':
								print '<button type="button" data-toggle="modal" data-target="#statusChangeModal" class="btn btn-danger btn-sm viewBMCStatus">'.$bmc_status.'</button>'  ;
								$status = 3;
								break;
						}
					?>
					<button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button>
				</div>
				<div class="panel-body">
					<div class="viewBMC_body">
				    	<div class="col-md-12 col-sm-12">
				    		<div class="col-md-2 col-sm-2 col-md-offset-1">
				    			<div class="row">
					    			<div class="panel panel-default bmc_view_content_container big_column">
					    				<div class="panel-heading"><b>Key Partners</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal1" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>1])
										@include('postItsViewModal', ['boxId' =>1])
									</div>
								</div>
			    			</div>
				    		<div class="col-md-2 col-sm-3">
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Key Activities</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal2" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>2])
										@include('postItsViewModal', ['boxId' =>2])
									</div>
				    			</div>	
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Key Ressources</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal3" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>3])
										@include('postItsViewModal', ['boxId' =>3])
									</div>
				    			</div>
				    		</div>
				    		<div class="col-md-2 col-sm-2">
				    			<div class="row">
					    			<div class="panel panel-default bmc_view_content_container big_column">
					    				<div class="panel-heading"><b>Value Propositions</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal4" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>4])
										@include('postItsViewModal', ['boxId' =>4])
									</div>
								</div>
			    			</div>
				    		<div class="col-md-2 col-sm-3">
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Customer Relationships</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal5" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>5])
										@include('postItsViewModal', ['boxId' =>5])
									</div>
				    			</div>	
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Channels</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal6" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>6])
										@include('postItsViewModal', ['boxId' =>6])
									</div>
				    			</div>
				    		</div>
				    		<div class="col-md-2 col-sm-2">
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container big_column">
					    				<div class="panel-heading"><b>Customer Segments</b>  <button type="button" data-toggle="modal" data-target="#addPersonaModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('personaContent', ['boxId' =>7])
										@include('personaViewModal')
									</div>
								</div>
			    			</div>
				    	</div>
				    	<div class="col-md-12 col-sm-12">
				    		<div class="col-md-5 col-sm-6 col-md-offset-1">
				    			<div class="row">
				    				<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Cost Structure</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal8" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>8])
										@include('postItsViewModal', ['boxId' =>8])
									</div>
								</div>
				    		</div>
				    		<div class="col-md-5 col-sm-6">
				    			<div class="row">
					    			<div class="panel panel-default bmc_view_content_container">
					    				<div class="panel-heading"><b>Revenue Streams</b>  <button type="button" data-toggle="modal" data-target="#addPostItModal9" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
										@include('postItsContent', ['boxId' =>9])
										@include('postItsViewModal', ['boxId' =>9])
									</div>
								</div>
				    		</div>
				    	</div>
			    	</div>
    				<div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
						<br>
						<?php print '<a href="/bmc/public/projects/showBMCs/'.$project_id.'"><button type="button" class="btn btn-primary">Back to Project</button></a>';?>
					</div>
			    	
				</div>
			</div>		
		</div>
	</div>
</div>

@include('viewBMCModals')

@endsection
