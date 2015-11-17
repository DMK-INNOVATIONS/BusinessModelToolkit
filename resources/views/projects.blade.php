@extends('app')

@section('content')
<div id="project_list">
	<div class="help_info">
		<a class="help-icon" data-toggle="modal" data-target="#myModal">
			<span class="icon-question" aria-hidden="true"></span>
		</a>
	</div>
	<div class="container">
		<!-- 
		<div class=" col-md-12 col-sm-12 col-xs-12">
		  <h1>Projects View</h1>
		  <h4>This View shows your own Projects and the Projects your Team Members assigned to you.</h4>
		</div>
		<div class="divider_style_1"></div>
		 -->
		<div class="row">
		
			<!--New List Projects Table - Start -->
		<div class="row no_margin">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-4">
					<h1>My Own Projects <span class="light_color">(<?php if(isset($myProjects)){ echo count($myProjects); }?>)</span></h1>
				</div>
				<div class="col-md-4">
					<a href="projects/create"><button type="button" class="btn btn-primary">New Project</button></a>
				</div>
				<div class="col-md-4 sortProject">
					<h6>Sort by</h6>
					<select class="myProjects selected_sort form-control">
						<option value="updated_at" <?php echo $sort_field==='updated_at' ? 'selected' : ''?>>Updated</option>
						<option value="created_at" <?php echo $sort_field==='created_at' ? 'selected' : ''?>>Created</option>
					</select>
					<!-- ToDo Icon upload -->
				</div>
				<div class="divider_style_2_project"></div>
			</div>
		</div>
		<div class="row no_margin">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3">
					<h5>Title</h5>	
				</div>
				<div class="col-md-2 show_projects">
					<h6 class="text-right">Show details for all</h6>
				</div>
				<div class="col-md-1 show_projects">
					<ul class="my_projects">
							<li class="dropdown_myprojects"><span class="icon_more"></span></li>
					</ul>
				</div>
				<div class="col-md-2">
					<div class="col-md-12"><h5>Updated</h5></div>
					<div class="col-md-12"><h6>Created</h6></div>
				</div>
				<div class="col-md-4">
					<h5>Tools</h5>
				</div>
			<div class="divider_style_2_project"></div>
			</div>
		</div>
		<div class="row no_margin extra_padding">
				<?php if(count($myProjects) > 0): ?>
					<?php foreach ($myProjects as $myProject):	?>
						<div class="col-md-12 my_project_list">
							<div class="row">			
								<div class="col-md-5">
								<h3>{{ $myProject['title'] }}</h3>
								</div>
								<div class="col-md-1">
								 	<span class="details_myprojects" ></span>
								</div>
								<div class="col-md-2">
									<div class="col-md-12"><h5>{{ $myProject['updated_at'] }}</h5></div>
									<div class="col-md-12"><h6>{{ $myProject['created_at'] }}</h6></div>
								</div>
								<div class="col-md-2">
									
										<a href="projects/edit/{{ $myProject['id'] }}">
											<span class="edit-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"/>
										</a>
										<a data-toggle="modal" data-target="#deleteModal{{ $myProject['id'] }}">
									    	<span class="delete-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete"/>
									    </a>
								   
								</div>
								<div class="col-md-2">
										<a class="project_link" href="projects/showBMCs/{{ $myProject['id'] }},1">
									  		<button type="button" class="btn btn-primary btn-secundar">Show Models </button>
									  	</a>
								</div>
							</div>
						</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="divider_style_1"></div>
		</div>
		
		<!-- Assign Projects Start-->
	
		<!-- start new -->
		
		<div class="row no_margin">
			<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-8">
						<h1>My Assigned Projects <span class="light_color">
							<?php $count=0;?>
							<?php foreach ($myProjects as $my):	?>
							<?php 	$count+= count($my->members) ?>
							<?php endforeach; ?>
							({{$count}})					
						</span></h1>
					</div>
					<div class="col-md-4 sortProject">
						<h6>Sort by</h6>
						<select class="assigned_select selected_sort form-control">
							<option value="updated_at" <?php echo $sort_field==='updated_at' ? 'selected' : ''?>>Updated</option>
							<option value="created_at" <?php echo $sort_field==='created_at' ? 'selected' : ''?>>Created</option>
						</select>
						<!-- ToDo Icon upload -->
					</div>
					<div class="divider_style_2_project"></div>
			</div>
		</div>	
		<div class="row no_margin">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3">
					<h5>Title</h5>	
				</div>
				<div class="col-md-2 show_projects">
					<h6 class="text-right">Show details for all</h6>
				</div>
				<div class="col-md-1 show_projects">
					<ul class="my_projects">
							<li class="dropdown_myprojects"><span class="icon_more"></span></li>
					</ul>
				</div>
				<div class="col-md-2">
					<div class="col-md-12"><h5>Updated</h5></div>
					<div class="col-md-12"><h6>Created</h6></div>
				</div>
				<div class="col-md-2">
					<h5>Owner</h5>
				</div>
				<div class="col-md-2">
					<h5>Tools</h5>
				</div>
			<div class="divider_style_2_project"></div>
			</div>
		</div>
		<?php foreach ($myProjects as $my):	?>
			<?php foreach ($my->members as $m):?>
				<?php //if($m->id == $user->id):?>
					<div class="row no_margin extra_padding">
						<div class="col-md-12 my_project_list">	
							<div class="row">		
							<div class="col-md-5">
								<h3>{{ $my->title }}</h3>
							</div>
							<div class="col-md-1">
							 	<span class="details_myprojects" ></span>
							</div>
							<div class="col-md-2">
								<div class="col-md-12"><h5>{{ $my->updated_at }}</h5></div>
								<div class="col-md-12"><h6>{{ $my->created_at }}</h6></div>
							</div>
							<div class="col-md-2">
									<h5>{{$my->assignee->name}}</h5>
							</div>
							<div class="col-md-2">
									<a class="project_link" href="projects/showBMCs/{{ $my->id }},1">
								  		<button type="button" class="btn btn-primary btn-secundar">Show Models </button>
								  	</a>	
							</div>
							<?php if(count($my->bmcs)>$count):?>
							<div class="divider_style_2_project"></div>
							<?php endif;?>
							</div>
						<?php $count=0;?>
						<?php if(count($my->bmcs)>0):?>
							<?php foreach ($my->bmcs as $b):?>
								<?php $count++;?>
								  <div class="row">
									<div class="col-md-6">
										<h4>{{ $b->title }}</h4>
									</div>
									<div class="col-md-2">
										<h5 class="bmc_list">1</h5>
								 		<div class="label_{{ $b->status }} label_project"><h5>{{ $b->status }}</h5></div>
									</div>
									<div class="col-md-2">
								 		<!-- ?? waiting .... -->
									</div>
									<div class="col-md-2">
										<a class="bmc_link" href="bmc/viewBMC/{{ $b->id }},{{ $my->id }},1,1,showBMCs">
									  		<button type="button" class="btn btn-primary btn-secundar">View </button>
									  	</a>
									</div>
									<?php if(count($my->bmcs)>$count):?>	
										<div class="divider_style_3"></div>
									<?php endif;?>
								 </div>
							<?php endforeach; ?>
						<?php endif;?>
						</div>
					</div>
				<?php //endif;?>
			<?php endforeach; ?>
		<?php endforeach; ?>
		<!-- end new -->
		</div>
		<!-- Assign Projects End-->	
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
</div>	
<script type="text/javascript">
$(function() {
	$('.myProjects.selected_sort').bind('change',function(){
		var to_send=$(this).val();
		//console.log(to_send);  
		$.ajax({
		    url: '/projects',
		    type: 'GET',
		    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send},
		    async: "false",
		    success: function (data) {
			    $('#project_list').html(data.content);
			    //console.log("succes");
		    }
		});
	});
	$('.assigned_select.selected_sort').bind('change',function(){
		var to_send=$(this).val();
		//console.log(to_send);  
		$.ajax({
		    url: '/projects',
		    type: 'GET',
		    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send},
		    async: "false",
		    success: function (data) {
			    $('#project_list').html(data.content);
			    //console.log("succes");
		    }
		});
	});
});
</script>
@endsection
