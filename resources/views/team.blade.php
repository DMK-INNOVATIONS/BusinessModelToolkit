@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">

			@if(session('error'))
				<div class="panel panel-danger">
					<div class="panel-heading"></div>
					<div class="panel-body">{{ session('error') }}</div>
				</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">My Team <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
									
					<!-- Team Member Table -->
					
					<div class="panel panel-default">
					  <div class="panel-body table_text">
					    <p>In this Table you can see, add and edit all your Connections between Team Members an your Projects.</p>
					  </div>
					
					  <!-- Table -->
					  <div class="row table_head">
					  		<div class="col-md-3">Name</div>
					  		<div class="col-md-3">E-Mail</div>
					  		<div class="col-md-3">Assigned Project</div>
					  		<div class="col-md-3">edit</div>
					  </div>
					  <?php 
							foreach ($assignedTeamMembers as $assignedTeamMember){
								foreach ($assignedTeamMember as $teamMember){
									print '<div class="row table_body">';
										print '<div class="col-md-3">'.$teamMember['name'].'</div>
								  		<div class="col-md-3">'.$teamMember['email'].'</div>';
										foreach($myProjects as $myProject){
											if($teamMember['pivot']['project_id'] == $myProject['id']){
												print '<div class="col-md-3">'.$myProject['title'].'</div>';	
											}	
										}
								  		print '<div class="col-md-3">';
											print '<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>   ';
											print '<a href=""><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
										print '</div>';
									print '</div>';
								}						
							}
							?> 
					  
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="team/create"><button type="button" class="btn btn-primary">add Team Member</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Team Help</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
