@extends('app')

@section('content')
<div class="help_info">
	<a class="help-icon" data-toggle="modal" data-target="#myModal">
		<span class="icon-question" aria-hidden="true"></span>
	</a>
</div>
<div class="container">
	<div class=" col-md-12 col-sm-12 col-xs-12">
	  <h1>Team View</h1>
	  <h4>View, add and edit all Connections between your Team Members and Projects.</h4>
	</div>
	<div class="divider_style_1"></div>
	<div class="row" style="margin-top: 10px;">
		@if(session('error'))
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="alert alert-alert col-md-12" role="alert">{{{ session('error') }}}</div>
			</div>
		@endif
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Your Connections</b> 
					<!--	<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
					</button>
					  -->
				</div>
				<div class="panel-body">
									
					<!-- Team Member Table -->
					
					<div class="panel panel-default">
					
					  <!-- Table -->
					  <div class="row table_head">
					  		<div class="col-md-3 col-sm-3 col-xs-12">Name</div>
					  		<div class="col-md-3 col-sm-3 col-xs-12">Email</div>
					  		<div class="col-md-3 col-sm-3 col-xs-12">Assigned Projects</div>
					  		<div class="col-md-3 col-sm-3 col-xs-12">Tools</div>
					  </div>
					  <?php
							$teamMember_id = 'n';
							$project_id = 'n';
					  
							foreach ($assignedTeamMembers as $assignedTeamMember){
								
								foreach ($assignedTeamMember as $teamMember){
									print '<div class="row table_body">';
										print '<div class="col-md-3 col-sm-3 col-xs-12">'.$teamMember['name'].'</div>
								  		<div class="col-md-3 col-sm-3 col-xs-12">'.$teamMember['email'].'</div>';
										foreach($myProjects as $myProject){
											if($teamMember['pivot']['project_id'] == $myProject['id']){
												print '<div class="col-md-3 col-sm-3 col-xs-12">'.$myProject['title'].'</div>';	
												$teamMember_id = $teamMember['pivot']['user_id'];
												$project_id = $myProject['id'];
											}	
										}
										
								  		print '<div class="col-md-3 col-sm-3 col-xs-12">';
											print '<a data-toggle="modal" data-target="#deleteModal'.$teamMember['id'].'">
													<span class="delete-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/></span>
												</a>';
										print '</div>';
									print '</div>';
									
									print '
					  					<div class="modal fade" id="deleteModal'.$teamMember["id"].'" tabindex="-1" role="dialog">
										  <div class="modal-dialog delete" role="document">
										    <div class="modal-content delete col-md-12">
										      <div class="modal-header col-md-12">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Do you want to remove '.$teamMember["name"].' from your team list? </h4>
										      </div>
										      <div class="modal-footer delete col-md-12">
									      		<div class="col-md-6"><a href="team/delete/'.$teamMember['pivot']['project_id'].','.$teamMember['id'].'"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								  				<div class="col-md-6"><button type="button" class="btn btn-primary btn-secundar" data-dismiss="modal">No</button></div>
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
<?php if(!empty($invitations)):?>
	<!-- Invitation Table -->
	<div class="row" style="margin-top: 10px;">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b>Your Open Invitations</b>
				</div>
				<div class="panel-body">
					<div class="panel panel-default">
					
						<!-- Table -->
						<div class="row table_head">
							<div class="col-md-3 col-sm-3 col-xs-12">Email</div>
							<div class="col-md-3 col-sm-3 col-xs-12">Assigned Project</div>
							<div class="col-md-3 col-sm-3 col-xs-12">Invited on</div>
							<div class="col-md-3 col-sm-3 col-xs-12">Expires in</div>
						</div>
						
						<?php foreach($invitations as $invitation):?>
						<div class="row table_body">
							<div class="col-md-3 col-sm-3 col-xs-12">{{{ $invitation['invitee_email'] }}}</div>
							<div class="col-md-3 col-sm-3 col-xs-12">{{{ $invitation['project_name'] }}}</div>
							<div class="col-md-3 col-sm-3 col-xs-12">{{{ date('Y-m-d | H:m',strtotime($invitation['assigned_on'])) }}}</div>
							<div class="col-md-3 col-sm-3 col-xs-12">{{{ $invitation['expires_on'] }}} Days</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>
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
				<div class="col-md-11">The Team View contains Connections between your Projects and other Users of "Business Model Toolkit".</div>
			</p> 
			<p>
				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
				<div class="col-md-11">You can use the following Tools to edit Connections: </div>
			</p>
	      	<p>
	      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete Connections between a team member and your Project.
      		</p>
      		<p>
      			<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span> 
      			<div class="col-md-11" style="padding: 0 0 15px 0;">New Team Connections are created by clicking the <button type="button" class="btn btn-primary disabled">Add Team Member</button> Button.</div>
      		</p>    
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
	var d = document.getElementById("footer");
	d.className += " teamView";
});
</script>
@endsection