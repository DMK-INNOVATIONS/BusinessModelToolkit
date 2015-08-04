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
					  		<div class="col-md-3">updated at</div>
					  		<div class="col-md-1">edit</div>
					  		<div class="col-md-2">BMC's</div>
					  </div>

							<?php 
							foreach ($myProjects as $myProject){
								print '<div class="row table_body">';
									print '<div class="col-md-3">'.$myProject["title"].'</div>
							  		<div class="col-md-3">'.$myProject["created_at"].'</div>
							  		<div class="col-md-3">'.$myProject["updated_at"].'</div>
							  		<div class="col-md-1">';
									print '<a href="projects/edit/'.$myProject["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>   ';
									print '<a href="projects/delete/'.$myProject["id"].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
									print '</div>
							  		<div class="col-md-2">';
									print '<a href="projects/showBMCs/'.$myProject["id"].'"><button type="button" class="btn btn-default">show BMC\'s </button></a>';
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
</div>

<!-- Help Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Projects Help</h4>
      </div>
      <div class="modal-body">
        ... Hier muss noch Text rein ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
