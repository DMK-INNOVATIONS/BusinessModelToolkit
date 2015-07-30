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
					  <div class="panel-body">
					    <p>In this Table you can find all your created Projects.</p>
					  </div>
					
					  <table class="table">
					    <tr>
						    <th>Title</th>
						    <th>created at</th>
						    <th>updated at</th>
						    <th>edit</th>
						    <th>BMC's</th>
					  	</tr>
							<?php 
							foreach ($myProjects as $myProject){
								print '<tr>';
									print '<td>';
										print $myProject["title"];
									print '</td>';
									print '<td>';
										print $myProject["created_at"];
									print '</td>';
									print '<td>';
										print $myProject["updated_at"];
									print '</td>';
									print '<td>';
										print '<a href="projects/edit/'.$myProject["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>   ';
										print '<a href="projects/delete/'.$myProject["id"].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
									print '</td>';
									print '<td>';
										print '<a href="projects/showBMCs/'.$myProject["id"].'"><button type="button" class="btn btn-default">show BMC\'s </button></a>';
									print '</td>';
								print '</tr>';
							}
							?>   	
					  </table>
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
