@extends('app') @section('content')
<div id="project_list">
	<div class="help_info">
		<a class="help-icon" data-toggle="modal" data-target="#myModal"> <span
			class="icon-question" aria-hidden="true"></span>
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
					<div class="col-md-4 col-sm-4">
						<h1>
							My Own Projects <span class="light_color">(<?php if(isset($myProjects)){ echo count($myProjects); }?>)</span>
						</h1>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href="projects/create"><button type="button" class="btn btn-primary">New Project</button></a>
					</div>
					<div class="col-md-4 col-sm-4 sortProject">
						<h6>Sort by</h6>
						<select id="custom_menu" class="myProjects selected_sort form-control">
							<option value="updated_at"
								<?php echo $sort_field==='updated_at' ? 'selected' : ''?>>Updated</option>
							<option value="created_at"
								<?php echo $sort_field==='created_at' ? 'selected' : ''?>>Created</option>
						</select>
						<!-- ToDo Icon upload -->
					</div>
					<div class="divider_style_2_project"></div>
				</div>
			</div>
			<div class="row no_margin">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-3 col-md-2 col-sm-1">
						<h5>Title</h5>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 show_projects no_padding_right">
						<h6 class="text-right">Show details for all</h6>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 show_projects no_padding_left">
						<ul class="my_projects">
							<li class="dropdown_myprojects"><span class="icon_more"></span></li>
						</ul>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h5 class="no_margin_top_bottom">Updated</h5>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h6 class="no_margin_top_bottom">Created</h6>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-5">
						<h5>Tools</h5>
					</div>
					<div class="divider_style_2_project"></div>
				</div>
			</div>
@section('projects')
			<div id="projects" class="row no_margin extra_padding">
				<?php if(count($myProjects) > 0): ?>
					<?php foreach ($myProjects as $myProject):	?>
					<div class="col-lg-12 col-md-12 col-sm-12 my_project_list">
					<div class="row">
						<div class="col-lg-5 col-md-4 col-sm-4">
							<h3>{{{ $myProject['title'] }}}</h3>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-1 no_padding_left">
							<span class="details_myprojects"></span>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="col-md-12 col-sm-12">
								<h5 class="no_margin_bottom">{{{date('l, d-m-Y | H:m',
									strtotime($myProject['updated_at'])) }}}</h5>
							</div>
							<div class="col-md-12 col-sm-12">
								<h6 class="no_margin_top">{{{ date('Y-m-d | H:m',
									strtotime($myProject['created_at'])) }}}</h6>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">

							<a href="projects/edit/{{{ $myProject['id'] }}}"> <span
								class="edit-icon no_background" aria-hidden="true"
								data-toggle="tooltip" data-placement="bottom" title="edit" />
							</a>
							 <a data-toggle="modal"
								data-target="#deleteModal{{{ $myProject['id'] }}}"> <span
								class="delete-icon no_background" aria-hidden="true"
								data-toggle="tooltip" data-placement="bottom" title="delete" />
							</a>

						</div>
						<div class="col-lg-2 col-md-3 col-sm-3">
							<a class="project_link"
								href="projects/showBMCs/{{{ $myProject['id'] }}},1">
								<button type="button" class="btn btn-primary btn-secundar">Show
									Models</button>
							</a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="divider_style_1_project"></div>
			</div>
@show
			<!-- Assigned Projects Start-->

			<!-- start new -->

			<div class="row no_margin">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<h1>My Assigned Projects <span class="light_color">(<?= count($assignedProjects)?>)</span></h1>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 sortProject">
						<h6>Sort by</h6>
						<select id="custom_menu_2"
							class="assigned_select selected_sort form-control">
							<option value="updated_at"
								<?php echo $sort_field==='updated_at' ? 'selected' : ''?>>Updated</option>
							<option value="created_at"
								<?php echo $sort_field==='created_at' ? 'selected' : ''?>>Created</option>
						</select>
						<!-- ToDo Icon upload -->
					</div>
					<div class="divider_style_2_project"></div>
				</div>
			</div>
			<div class="row no_margin">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-3 col-md-2 col-sm-1">
						<h5>Title</h5>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 show_projects no_padding_right">
						<h6 class="text-right">Show details for all</h6>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 show_projects no_padding_left">
						<ul class="my_projects">
							<li class="dropdown_myprojects"><span class="icon_more"></span></li>
						</ul>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h5 class="no_margin_top_bottom">Updated</h5>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h6 class="no_margin_top_bottom">Created</h6>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2">
						<h5>Owner</h5>
					</div>
					<div class="col-lg-2 col-md-3 col-sm-3">
						
					</div>
					<div class="divider_style_2_project"></div>
				</div>
			</div>
@section('my_assign_projects')
		<div id="my_assign_projects">
		<?php foreach ($assignedProjects as $my):	?>
				<?php //if($m->id == $user->id):?>
				<div class="row no_margin extra_padding">
				<div class="col-lg-12 col-md-12 col-sm-12 my_project_list">
					<div class="row">
						<div class="col-lg-5 col-md-4 col-sm-4">
							<h3>{{{ $my->title }}}</h3>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-1 no_padding_left">
							<span class="details_myprojects"></span>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h5 class="no_margin_bottom">{{{ date('l, d-m-Y | H:m',
									strtotime($my->updated_at)) }}}</h5>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h6 class="no_margin_top">{{{ date('Y-m-d | H:m',
									strtotime($my->created_at)) }}}</h6>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<h5 class="no_margin_bottom">{{{$my->assignee->name}}}</h5>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-3">
							<a class="project_link" href="projects/showBMCs/{{{ $my->id }}},1">
								<button type="button" class="btn btn-primary btn-secundar">Show Models</button>
							</a>
						</div>
							<?php if(count($my->bmcs)>0):?>
							<div class="divider_style_1_project_inside"></div>
						<!-- <div class="divider_style_2_project"></div> -->
							<?php endif;?>
							</div>
						<?php $count=0;?>
						<?php if(count($my->bmcs)>0):?>
							<?php foreach ($my->bmcs as $b):?>
								<?php $count++;?>
								  <div class="row">
						<div class="col-lg-6 col-md-5 col-sm-5">
							<h4>{{{ $b->title }}}</h4>
						</div>
						<div class="col-lg-4 col-md-5 col-sm-5">
							<div class="label_{{{ $b->status }}} label_project">
								<h5 class="in_label_project">{{{ $b->status }}}</h5>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<a class="bmc_link"
								href="bmc/viewBMC/{{{ $b->id }}},{{{ $my->id }}},1,1,showBMCs">
								<button type="button" class="btn btn-primary btn-secundar">View
								</button>
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
		</div>
@show
		<!-- end new -->
		</div>
		<!-- Assign Projects End-->
	</div>

	<!-- Help Modal -->
	<?php foreach ($myProjects as $myProject):	?>
	<div class="modal fade" id="deleteModal{{{ $myProject['id'] }}}" tabindex="-1" role="dialog">
		<div class="modal-dialog delete" role="document">
			<div class="modal-content delete col-md-12 col-sm-12">
				<div class="modal-header col-md-12 col-sm-12">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Do you want to delete {{{ $myProject['title'] }}} ?</h4>
				</div>
				<div class="modal-footer delete col-md-12 col-sm-12">
					<div class="col-md-6 col-sm-6">
						<a href="projects/delete/{{{ $myProject['id'] }}}">
							<button type="button" class="btn btn-primary btn-lg">Yes</button>
						</a>
					</div>
					<div class="col-md-6 col-sm-6">
						<button type="button" class="btn btn-primary btn-secundar" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content col-md-12 col-sm-12">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Projects View Help</h4>
				</div>
				<div class="modal-body">
					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1 col-sm-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11 col-sm-11">The Projects View contains all your created and assigned Projects.</div>
					</p>
					<!-- 
					<img style="padding: 0 0 15px 0;" class="col-md-11 col-md-offset-1"
						src="{{{ asset('img/help/projects_help.png') }}}"> -->

					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1 col-sm-1"
							aria-hidden="true"></span>
					
					<div class="col-md-11 col-sm-11">Whilst you cannot alter any assigned Projects, you can use the following tools on your own Projects:</div>
					</p>
					<p>
						<span class="glyphicon glyphicon-pencil col-md-offset-2 col-sm-offset-2"
							aria-hidden="true"></span> - edit: Used to change the title of your Project.
					</p>
					<p>
						<span class="glyphicon glyphicon-trash col-md-offset-2 col-sm-offset-2"
							aria-hidden="true"></span> - delete: Used to delete no longer used Projects.
					</p>


					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1 col-sm-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11 col-sm-11">
						To show the Business Model Canvas of a Project use the
						<button type="button" class="btn btn-default">show BMC's</button>
						Button.
					</div>
					</p>
					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1 col-sm-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11 col-sm-11" style="padding: 0 0 15px 0;">
						You can also create new Projects with the
						<button type="button" class="btn btn-primary">new Project</button>
						Button.
					</div>
					</p>
				</div>
				<div class="modal-footer col-md-12 col-sm-12" style="margin: 0;">
					<p>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
/*
	$('.myProjects.selected_sort').bind('change',function(){
		var to_send=$(this).val();
		//console.log(to_send);  
		$.ajax({
		    url: '/projects',
		    type: 'GET',
		    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send},
		    async: "false",
		    success: function (data) {
			    $('#my_projects').html(data.content);
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
*/	
	var to_send=$("#custom_menu").val();
	$("#custom_menu").on( "selectmenuchange", function() {
					to_send=$(this).val();
					$.ajax({
					    url: '/projects',
					    type: 'GET',
					    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send},
					    async: "false",
					    dataType:"json",
					    success: function (data) {
						    $("#project_list #projects").html(data.projects);
						    $("#custom_menu").selectmenu("destroy").selectmenu();
					    }
					})
					.done(function() {
					    	$("#custom_menu").selectmenu();
					      })
				;
	});
	var to_send2=$("#custom_menu_2").val();
	$("#custom_menu_2").on( "selectmenuchange", function() {
		console.log("change"+$(this).val());
		to_send2=$(this).val();
		$.ajax({
		    url: '/projects',
		    type: 'GET',
		    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send2},
		    async: "false",
		    success: function (data) {
			    $("#my_assign_projects").html(data.my_assign_projects);
			    $("#custom_menu_2").selectmenu("destroy").selectmenu();
			    //$("#custom_menu").on( "selectmenuselect", function( event, ui ) {} );;
			    //console.log("succes");
		    }
		})
		.done(function() {
		    	$("#custom_menu_2").selectmenu();
		      })
	;
});
	$("#custom_menu").selectmenu();
	$("#custom_menu_2").selectmenu();
});
	 

</script>
@endsection
