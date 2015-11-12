@extends('app')

@section('content')
<div class="container">
	<div class=" col-md-12 col-sm-12 col-xs-12 page-header">
	  <h1>Projects View <br><small>This View shows your own Projects and the Projects your Team Members assigned to you.</small></h1>
	</div>
	<div class="row">
	
		<!-- User Projects Table - Start -->
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>My Projects</b> <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
					
					<div class="panel panel-default">
					  <div class="panel-body table_text">
					    <p>This Table contains the Projects you own.</p>
					  </div>
					  
					  <div class="row table_head" style="text-align: center;">
					  		<div class="col-md-3 col-xs-12">Title</div>
					  		<div class="col-md-3 col-xs-6">Created at</div>
					  		<div class="col-md-2 col-xs-6">Updated at</div>
					  		<div class="col-md-2 col-xs-6">Tools</div>
					  		<div class="col-md-2 col-xs-6">Business Models</div>
					  </div>

							<?php 
							foreach ($myProjects as $myProject){
								$created_at = explode(' ', $myProject["created_at"]);
								$created_at_date = $created_at[0];
								$created_at_time = $created_at[1];
								
								$updated_at = explode(' ', $myProject["updated_at"]);
								$updated_at_date = $updated_at[0];
								$updated_at_time = $created_at[1];
								
								print '<div class="row table_body" style="text-align: center;">';
									print '	<div class="col-md-3 col-xs-12 project_title-smal">'.$myProject["title"].'</div>
							  				<div class="col-md-3 col-xs-6">'.$created_at_date.', '.$created_at_time.'</div>
							  				<div class="col-md-2 col-xs-6">'.$updated_at_date.', '.$updated_at_time.'</div>
									  		<div class="col-md-2 col-xs-6">';
											print '	<a href="projects/edit/'.$myProject["id"].'">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"/>
													</a>   ';
											print '	<a data-toggle="modal" data-target="#deleteModal'.$myProject['id'].'">
							    						<span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/>
							    					</a>';
									print '	</div>
									  		<div class="col-md-2 col-xs-6">';
											print '	<a href="projects/showBMCs/'.$myProject["id"].',1">
							  							<button type="button" class="btn btn-primary btn-secundar">Show Models </button>
							  						</a>';
							    			print'</div>';
								print '</div>';			

								
								print '
					  					<div class="modal fade" id="deleteModal'.$myProject["id"].'" tabindex="-1" role="dialog">
										  <div class="modal-dialog delete" role="document">
										    <div class="modal-content delete col-md-12">
										      <div class="modal-header col-md-12">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Do you want to delete '.$myProject["title"].'?</h4>
										      </div>
										      <div class="modal-footer delete col-md-12">
									      		<div class="col-md-6"><a href="projects/delete/'.$myProject["id"].'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
										      </div>
										    </div>
										  </div>
										</div>
					  				';
								}
							?>   	
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="projects/create"><button type="button" class="btn btn-primary">New Project</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>My Assigned Projects</b></div>
				<div class="panel-body">
					<div class="panel panel-default">
					  <div class="panel-body table_text">
					    <p>This Table contains the Projects your Team Members assigned to you.</p>
					  </div>
					  
					  <div class="row table_head " style="text-align: center;">
					  		<div class="col-md-5 col-xs-12">Title</div>			  		
					  		<div class="col-md-5 col-xs-6">Owner</div>
					  		<div class="col-md-2 col-xs-6">Business Models</div>
					  </div>
					  
					  <?php 
							foreach ($myAssignedProjects as $myAssignedProject){
								print '<div class="row table_body" style="text-align: center;">';
									print '<div class="col-md-5 col-xs-12">'.$myAssignedProject["title"].'</div>';

									$bereits_vorhanden = null;
									foreach ($assignedProjectsOwners as $Owner){
										if($myAssignedProject["assignee_id"] == $Owner['id']){
											if($bereits_vorhanden != $Owner['id']){
												print '<div class="col-md-5 col-xs-6">'.$Owner['name'].'</div>';
												$bereits_vorhanden = $Owner['id'];
											}
										}
									}
									
							  		print'<div class="col-md-2 col-xs-6">';
									print '<a href="projects/showBMCs/'.$myAssignedProject["id"].',0"><button type="button" class="btn btn-primary btn-secundar">show Models </button></a>';
					    			print'</div>';
								print '</div>';							
							}
							?>   
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Projects View Help</h4>
      </div>
      <div class="modal-body">
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">The Projects View contains all your created and assigned Projects.</div>
			</p> 
		    <img style="padding: 0 0 15px 0;" class="col-md-11 col-md-offset-1" src="{{ asset('img/help/projects_help.png') }}">
		
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">While you cannot alter any assigned Projects, you can use the following Tools on your own Projects: </div>
			</p>
	      	<p>
	      		<span class="glyphicon glyphicon-pencil col-md-offset-2" aria-hidden="true"></span> - edit: Used to change the Title of your project.
      		</p>
	      	<p>
	      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete no longer used projects.
      		</p>
		
      	
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11">To show the Business Model Canvas of a Project use the <button type="button" class="btn btn-default disabled">show BMC's </button> Button.</div>
      		</p>
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11" style="padding: 0 0 15px 0;">Also you can create new projects with the <button type="button" class="btn btn-primary disabled">new Project</button> Button.</div>
      		</p>    			
      </div>
      <div class="modal-footer col-md-12" style="margin: 0;">
        <p><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></p>
      </div>
    </div>
  </div>
</div>
@endsection
