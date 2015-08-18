@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
	
		<!-- User Projects Table - Start -->
		
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">My Projects <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
					
					<div class="panel panel-default">
					  <div class="panel-body table_text">
					    <p>In this Table you can find all your created Projects.</p>
					  </div>
					  
					  <div class="row table_head">
					  		<div class="col-md-3">Title</div>
					  		<div class="col-md-3">created at</div>
					  		<div class="col-md-2">updated at</div>
					  		<div class="col-md-2">Tools</div>
					  		<div class="col-md-2">BMC's</div>
					  </div>

							<?php 
							foreach ($myProjects as $myProject){
								print '<div class="row table_body">';
									print '	<div class="col-md-3">'.$myProject["title"].'</div>
							  				<div class="col-md-3">'.$myProject["created_at"].'</div>
							  				<div class="col-md-2">'.$myProject["updated_at"].'</div>
									  		<div class="col-md-2">';
											print '	<a href="projects/edit/'.$myProject["id"].'">
														<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"/>
													</a>   ';
											print '	<a href="projects/delete/'.$myProject["id"].'">
							    						<span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/>
							    					</a>';
									print '	</div>
									  		<div class="col-md-2">';
											print '	<a href="projects/showBMCs/'.$myProject["id"].',1">
							  							<button type="button" class="btn btn-default">show BMC\'s </button>
							  						</a>';
							    			print'</div>';
								print '</div>';							
							}
							?>   	
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="projects/create"><button type="button" class="btn btn-primary">new Project</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">My Assigned Projects</div>
				<div class="panel-body">
					<div class="panel panel-default">
					  <div class="panel-body table_text">
					    <p>In this Table you can find all your assigned Projects.</p>
					  </div>
					  
					  <div class="row table_head">
					  		<div class="col-md-3">Title</div>
					  		<div class="col-md-3">created at</div>
					  		<div class="col-md-2">updated at</div>					  		
					  		<div class="col-md-2">Owner</div>
					  		<div class="col-md-2">BMC's</div>
					  </div>
					  
					  <?php 
							foreach ($myAssignedProjects as $myAssignedProject){
								print '<div class="row table_body">';
									print '<div class="col-md-3">'.$myAssignedProject["title"].'</div>
							  		<div class="col-md-3">'.$myAssignedProject["created_at"].'</div>
							  		<div class="col-md-2">'.$myAssignedProject["updated_at"].'</div>';

									$bereits_vorhanden = null;
									foreach ($assignedProjectsOwners as $Owner){
										if($myAssignedProject["assignee_id"] == $Owner['id']){
											if($bereits_vorhanden != $Owner['id']){
												print '<div class="col-md-2">'.$Owner['name'].'</div>';
												$bereits_vorhanden = $Owner['id'];
											}
										}
									}
									
							  		print'<div class="col-md-2">';
									print '<a href="projects/showBMCs/'.$myAssignedProject["id"].',0"><button type="button" class="btn btn-default">show BMC\'s </button></a>';
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
      			<div class="col-md-11">To show the Business Model Canvas of a Project use the <button type="button" class="btn btn-default">show BMC's </button> Button.</div>
      		</p>
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11" style="padding: 0 0 15px 0;">Also you can create new projects with the <button type="button" class="btn btn-primary">new Project</button> Button.</div>
      		</p>    			
      </div>
      <div class="modal-footer col-md-12" style="margin: 0;">
        <p><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></p>
      </div>
    </div>
  </div>
</div>
@endsection
