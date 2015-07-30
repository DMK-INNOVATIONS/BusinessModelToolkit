@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">My Personas <button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
									
					<!-- User Projects Table -->
					
					<div class="panel panel-default">
					  <div class="panel-body">
					    <p>In this Table you can create, edit and delete all your Personas.</p>
					  </div>
					
					  <!-- Table -->
					  <table class="table">
					    <tr>
					    	<th>Avatar</th>
						    <th>Name</th>
						    <th>Age</th>
						    <th>Sex</th>
						    <th>Occupation</th>
						    <th>created at</th>
						    <th>updated at</th>
						    <th>edit</th>
					  	</tr>
							<?php 
							foreach ($myPersonas as $myPersona){
								print '<tr>';
									print '<td>';
										print '<img class="avatarImg" src="'.$myPersona["avatarImg"].'" alt="Selfhtml" />';
									print '</td>';
									print '<td>';
										print $myPersona["name"];
									print '</td>';
									print '<td>';
										print $myPersona["age"];
									print '</td>';
									print '<td>';
										print $myPersona["gender"];
									print '</td>';
									print '<td>';
										print $myPersona["occupation"];
									print '</td>';
									print '<td>';
										print $myPersona["created_at"];
									print '</td>';
									print '<td>';
										print $myPersona["updated_at"];
									print '</td>';
									print '<td>';
										print '<a href="persona/edit/'.$myPersona["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>  ';
										print '<a href="persona/delete/'.$myPersona["id"].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>  ';
									print '</td>';
									print '<td>';
										print '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myPersona'.$myPersona["id"].'">show Persona</button>';
									print '</td>';
								print '</tr>';
								
								$skills = explode(';',$myPersona["skills"]);
								$needs = explode(';',$myPersona["needs"]);
								
								
								print '				
								<!-- Modal for Persona View-->
									<div class="modal fade" id="myPersona'.$myPersona["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="myModalLabel">Persona View</h4>
									      </div>
									      <div class="modal-body">
									      	<div class="container-fluid">
									      		<div class="panel panel-default">
										      		<div class="panel-heading">My Persona</div>
											      	<div class="panel-body">
													  <div class="row persona_line_1">
													    	<div class="col-md-6 text-center persona_line_1_1 ">
																<img class="persona_image" src="'.$myPersona["avatarImg"].'">
													    	</div>
											 	 			<div class="col-md-6">
											 	 				<div class="col-md-12"><strong>Name:</strong> '.$myPersona["name"].'</div>
											 	 				<div class="col-md-12"><strong>Age:</strong> '.$myPersona["age"].'</div>
											 	 				<div class="col-md-12"><strong>Gender:</strong> '.$myPersona["gender"].'</div>
											 	 				<div class="col-md-12"><strong>Nationality:</strong> '.$myPersona["nationality"].'</div>
											 	 				<div class="col-md-12"><strong>Marital Status:</strong> '.$myPersona["marital_status"].'</div>
											 	 				<div class="col-md-12"><strong>Occupation:</strong> '.$myPersona["occupation"].'</div>
											 	 			</div>
													  </div>
													  <div class="row">
													    	<div class="col-md-6 persona_line_1_1"><strong>Needs</strong>
														    	<ul>';
																	foreach ($needs as $need){
																		print '<li class="list-group-item">'.$need.'</li>';	
																	}
															 print '</ul>
													    	</div>
											 	 			<div class="col-md-6"><strong>Skills</strong>
											 	 				<ul>';
																	 foreach ($skills as $skill){
																	 	print '<li class="list-group-item">'.$skill.'</li>';
																	 }
															 print '</ul>
											 	 			</div>
													  </div>
													</div>  
												</div>
											</div>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									      </div>
									    </div>
									  </div>
									</div>							
								';
							}
							?>   	
					  </table>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<a href="persona/create"><button type="button" class="btn btn-primary">new Persona</button></a>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!-- Modal Help-->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Persona Help</h4>
      </div>
      <div class="modal-body">
      	<div class="container-fluid">		
      		<div class="panel panel-default">
	      		<div class="panel-heading">Persona History</div>
		      	<div class="panel-body">
		      	</div>
	      	</div>
      	</div>
      	<div class="container-fluid">
      		<div class="panel panel-default">
	      		<div class="panel-heading">Persona Structure</div>
		      	<div class="panel-body">
				  <div class="row persona_line_1">
				    	<div class="col-md-6 text-center persona_line_1_1">
							<img class="persona_image" src="./img/dmk_e-business_logo.png">
				    	</div>
		 	 			<div class="col-md-6">
		 	 				<div class="col-md-12"><strong>Name:</strong> Jane Doe</div>
		 	 				<div class="col-md-12"><strong>Age:</strong> 25</div>
		 	 				<div class="col-md-12"><strong>Gender:</strong> Female</div>
		 	 				<div class="col-md-12"><strong>Nationality:</strong> German</div>
		 	 				<div class="col-md-12"><strong>Marital Status:</strong> Single</div>
		 	 				<div class="col-md-12"><strong>Occupation:</strong> Student</div>
		 	 			</div>
				  </div>
				  <div class="row">
				    	<div class="col-md-6 persona_line_1_1"><strong>Needs</strong>
					    	<ul>
							  <li class="list-group-item">Books</li>
							  <li class="list-group-item">Internet Access</li>
							  <li class="list-group-item">Laptop</li>
							  <li class="list-group-item">...</li>
							  <li class="list-group-item">...</li>
						 	</ul>
				    	</div>
		 	 			<div class="col-md-6"><strong>Skills</strong>
		 	 				<ul>
							  <li class="list-group-item">Digital Native</li>
							  <li class="list-group-item">...</li>
							  <li class="list-group-item">...</li>
						 	</ul>
		 	 			</div>
				  </div>
				</div>  
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
