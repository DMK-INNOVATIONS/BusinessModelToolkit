@extends('app') @section('content')

<?php
if ($_SERVER ['SERVER_NAME'] == 'localhost' || $_SERVER ['REMOTE_ADDR'] == '127.0.0.1') {
	$path = '/public';
} else {
	$path = '';
}
?>
<div id="project_list">
	<div class="help_info">
		<a class="help-icon" data-toggle="modal" data-target="#helpModal"> <span
			class="icon-question" aria-hidden="true"></span>
		</a>
	</div>
	<div class="container">
		<!-- new render -->
		<div class="row no_margin">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h1>{{{ $project_name }}}<span class="light_color">(<?php if(isset($newget)){ echo count($newget); }?>)</span>
				</h1>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h5 class="participants">Participants</h5>
				<span class="details_myprojects"></span>
			</div>
			<div class="col-md-12">
				<div class="divider_style_2_project"></div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-4">
					<a href="{{ url('/projects') }}"><button type="button"
							class="btn btn-primary btn-secundar">Back to Projects</button></a>
				</div>
				<div class="col-md-4">
					<a
						href="{{{$path}}}/bmc/create/{{{ $project_id }}},{{{$owner}}},showBMCs"><button
							type="button" class="btn btn-primary">New BMC</button></a>
				</div>
				<div class="col-md-4 sortProject">
					<h6>Sort by</h6>
					<select id="custom_menu"
						class="myProjects selected_sort form-control">
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
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-4">
					<h5>Title</h5>
				</div>
				<div class="col-md-2 show_projects no_padding_right">
					<h5>Status</h5>
				</div>
				<div class="col-md-3">
					<div class="col-md-12">
						<h5 class="no_margin_top_bottom">Updated</h5>
					</div>
					<div class="col-md-12">
						<h6 class="no_margin_top_bottom">Created</h6>
					</div>
				</div>
				<div class="col-md-3">
					<h5>Tools</h5>
				</div>
				<div class="divider_style_2_project"></div>
			</div>
		</div>
		<div class="row no_margin extra_padding">
		<?php count($newget)?>
					<?php if(count($newget) > 0): ?>
						<?php foreach ($newget as $myProject):	?>
							<div class="col-md-12 my_project_list">
								<div class="row">
									<div class="col-md-4">
										<h3>{{ $myProject['title'] }}</h3>
									</div>
									<div class="col-md-2" style="margin-top: 15px">
										<div
											class="label_{{{ $myProject['status'] }}} label_project no_padding_left no_margin_left label_status_bmc">
											<h5 class="in_label_project">{{{ $myProject['status'] }}}</h5>
										</div>
									</div>
									<div class="col-md-3">
										<div class="col-md-12">
											<h5 class="no_margin_bottom">{{{date('l, d-m-Y | H:m',
												strtotime($myProject['updated_at'])) }}}</h5>
										</div>
										<div class="col-md-12">
											<h6 class="no_margin_top">{{{ date('Y-m-d | H:m',
												strtotime($myProject['created_at'])) }}}</h6>
										</div>
									</div>
									<div class="col-md-3 no_padding_right">
										<?php
											
											if ($myProject ['status'] == 'inWork') {
												$temp_status = 1;
											} elseif ($myProject ['status'] == 'approved') {
												$temp_status = 2;
											} elseif ($myProject ['status'] == 'rejected') {
												$temp_status = 3;
											}
											?>
										<a href="{{{$path}}}/bmc/edit/{{{ $myProject['id'] }}},1,showBMCs"> <span
											class="edit-icon no_background" aria-hidden="true"
											data-toggle="tooltip" data-placement="bottom" title="edit" />
										</a> <a
											href="{{{$path }}}/bmc/copyBmc/{{{ $myProject['id'] }}},{{{$myProject->project->id}}},1,showBMCs">
											<span class="duplicate-icon no_background" aria-hidden="true"
											data-toggle="tooltip" data-placement="bottom" title="duplicate" />
										</a> <a
											href="{{{$path }}}/export/{{{ $myProject['id'] }}},{{{$myProject->project->id}}},1,showBMCs">
											<span class="export-icon no_background" aria-hidden="true"
											data-toggle="tooltip" data-placement="bottom" title="export" />
										</a> 
										<a data-toggle="modal" data-target="#deleteModal{{{ $myProject['id'] }}}">
											<span class="delete-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="delete" />
										</a> 
										<a class="project_link" style="padding-left: 15px" href="{{{$path}}}/bmc/viewBMC/{{{ $myProject['id'] }}},{{{$myProject->project->id}}},{{{$temp_status}}},1,showBMCs">
											<button type="button"
												class="btn btn-primary btn-secundar text-left">View</button>
										</a>
									</div>
				
								</div>
							</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-md-12">
						<div class="row">No models</div>
					</div>
				<?php endif;  ?>
				<div class="divider_style_1_project"></div>
		</div>
		<!-- end new render -->
	</div>

	<!-- Help Modal -->
	<?php if(isset($myProject) && !empty($myProject)):?>
	<div class="modal fade" id="deleteModal{{ $myProject['id'] }}" tabindex="-1" role="dialog">
		<div class="modal-dialog delete" role="document">
			<div class="modal-content delete col-md-12">
				<div class="modal-header col-md-12">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Do you want to delete {{{$myProject['title']}}}  </h4>
				</div>
				<div class="modal-footer delete col-md-12">
					<div class="col-md-6">
						<a href="{{{ $path}}}/bmc/delete/{{ $myProject['id'] }},{{{$myProject->project->id }}},1,showBMCs"><button
								type="button" class="btn btn-primary btn-lg">Yes</button></a>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-primary btn-secundar" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	<div class="modal fade" id="helpModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content col-md-12">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Project Help</h4>
				</div>
				<div class="modal-body">
					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11">This page contains all Models of your chosen project.</div>
					</p>

					<p>
						<span class="glyphicon glyphicon-hand-right col-md-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11">You can use the following tools on the Model of a Project:</div>
					</p>
				<?php
				if ($owner == 0) {
					print '
				      		<p>
					      		<span class="glyphicon glyphicon-export col-md-offset-2" aria-hidden="true"></span> - export: Used to export a Model.
				      		</p>
						';
				} else {
					print '
							<p>
					      		<span class="glyphicon glyphicon-pencil col-md-offset-2" aria-hidden="true"></span> - edit: Used to change the title of a Model.
				      		</p>
				      		<p>
					      		<span class="glyphicon glyphicon-file col-md-offset-2" aria-hidden="true"></span> - duplicate: Used to duplicate a Model.
				      		</p>
				      		<p>
					      		<span class="glyphicon glyphicon-export col-md-offset-2" aria-hidden="true"></span> - export: Used to export a Model.
				      		</p>
					      	<p>
					      		<span class="glyphicon glyphicon-trash col-md-offset-2" aria-hidden="true"></span> - delete: Used to delete no longer used Models.
				      		</p>	
						';
				}
				?>
	      		<p>
						<span class="glyphicon glyphicon-hand-right col-md-1"
							aria-hidden="true"></span>
					
					
					<div class="col-md-11" style="padding: 0 0 15px 0;">
						To show the edited view of a Business Model Canvas click the
						<button type="button" class="btn btn-default">show Model</button>
						Button.
					</div>
					</p>
	      		
	      		<?php
									if ($owner == 1) {
										print '
		      				<p>
			      				<span class="glyphicon glyphicon-hand-right col-md-1" aria-hidden="true"></span>
			      				<div class="col-md-11" style="padding: 0 0 15px 0;">To create a new Business Model Canvas click the <button type="button" class="btn btn-primary">New BMC</button> Button.</div>
		      				</p>  
						';
									}
									?>    			
	      </div>
				<div class="modal-footer col-md-12" style="margin: 0;">
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
	var to_send=$("#custom_menu").val();
	$("#custom_menu").on( "selectmenuchange", function() {
					//console.log("change"+$(this).val());
					to_send=$(this).val();
					$.ajax({
					    url: "/projects/showBMCs/{{ $project_id }}",
					    type: 'GET',
					    data: {_token:"<?php echo csrf_token(); ?>",sort_field: to_send, project_id:"{{ $project_id }}" },
					    async: "false",
					    success: function (data) {
						    $("#project_list").html(data.content);
						    $("#custom_menu").selectmenu("destroy").selectmenu();
						    //console.log("");
						    //$("#custom_menu").on( "selectmenuselect", function( event, ui ) {} );;
						    //console.log("succes");
					    }
					})
					.done(function() {
					    	$("#custom_menu").selectmenu();
					      })
				;
	});
	$("#custom_menu").selectmenu();
});
</script>
@endsection
