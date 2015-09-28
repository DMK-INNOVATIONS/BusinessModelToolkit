@extends('app')

@section('content')
<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
	  <h1>Team View <br><small>View, add and edit all Connections between your Team Members and your Projects.</small></h1>
	  
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

			@if(session('error'))
				<div class="panel panel-danger">
					<div class="panel-heading"></div>
					<div class="panel-body">{{ session('error') }}</div>
				</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading"><b>Your Connections</b> <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
									
					<!-- Team Member Table -->
					
					<div class="panel panel-default">
					
					  <!-- Table -->
					  <div class="row table_head">
					  		<div class="col-md-3 col-sm-3 col-xs-6">Name</div>
					  		<div class="col-md-3 col-sm-3 col-xs-6">Email</div>
					  		<div class="col-md-3 col-sm-3 col-xs-6">Assigned Projects</div>
					  		<div class="col-md-3 col-sm-3 col-xs-6">Tools</div>
					  </div>
					  <?php 
							foreach ($assignedTeamMembers as $assignedTeamMember){
								foreach ($assignedTeamMember as $teamMember){
									$project_title = '';
									$project_id = '';
									
									print '<div class="row table_body">';
										print '<div class="col-md-3 col-sm-3 col-xs-6">'.$teamMember['name'].'</div>
								  		<div class="col-md-3 col-sm-3 col-xs-6">'.$teamMember['email'].'</div>';
										foreach($myProjects as $myProject){
											if($teamMember['pivot']['project_id'] == $myProject['id']){
												print '<div class="col-md-3 col-sm-3 col-xs-6">'.$myProject['title'].'</div>';	
												$project_title = $myProject['title'];
												$project_id = $myProject['id'];
											}	
										}
										
								  		print '<div class="col-md-3 col-sm-3 col-xs-6">';
											print '<a data-toggle="modal" data-target="#deleteModal'.$teamMember['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/></a>';
										print '</div>';
									print '</div>';
									
									print '
					  					<div class="modal fade" id="deleteModal'.$teamMember["id"].'" tabindex="-1" role="dialog">
										  <div class="modal-dialog delete" role="document">
										    <div class="modal-content delete col-md-12">
										      <div class="modal-header col-md-12">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Do you want to remove '.$teamMember["name"].' from your Team list?</h4>
										      </div>
										      <div class="modal-footer delete col-md-12">
									      		<div class="col-md-6"><a href="team/delete/'.$teamMember['pivot']['project_id'].','.$teamMember['id'].'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								  				<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
										      </div>
										    </div>
										  </div>
										</div>
					  				';
								}						
							}			
							?> 
					  
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="team/create"><button type="button" class="btn btn-primary">Add Team Member</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Team Help</h4>
      </div>
      <div class="modal-body col-md-12">
     		 <p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">The Team View contains the Connections between your Projects and other User of the "BMCounselor".</div>
			</p> 
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">You can use the following Tools to edit Connections: </div>
			</p>
	      	<p>
	      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete connections between a Teammember and your Projects.
      		</p>
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11" style="padding: 0 0 15px 0;">Also you can create new projects with the <button type="button" class="btn btn-primary disabled">Add Team Member</button> Button.</div>
      		</p>    
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
