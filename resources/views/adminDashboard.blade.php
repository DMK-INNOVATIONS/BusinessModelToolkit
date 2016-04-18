@extends('app')

@section('content')
<div id="project_list">
	<div class="container">
		<div class="row no_margin">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php if(session()->has('data')):?>
					<?php $inserts = explode ( ",", session()->get('data') );?>
					<div class="alert alert-{{{$inserts[1]}}}" role="alert"><?=$inserts[0] ?></div>
				<?php endif;?>
				<div class="col-lg-2 col-md-2 col-sm-6 col-xs-5">
					<h5>Name [ User-id ]</h5>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-5 col-xs-5 show_projects no_padding_right">
					<h6 class="text-right">Show all</h6>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 show_projects no_padding_left">
					<ul class="my_projects">
						<li id="dropdown_details" class="dropdown_userDetails" onclick="showUserDetails()"><span class="icon_more"></span></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
					<h5>Email</h5>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<h5>last Login</h5>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6 admin_Tools_Menu">
					<h5>Tools</h5>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<a class="createUser" data-toggle="modal" data-target="#createUser">
						<button type="button" class="btn btn-primary btn-secundar">Create User</button>
					</a>
				</div>
				<div class="divider_style_2_project"></div>
			</div>
			<?php foreach($user as $u):?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 admin_User_list">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-11">
							<h3><?=$u['name'] ?> [ <?=$u['id'] ?> ]
							<?php if($u['id'] != Auth::user()->id):?>
								<?php if($u['is_Admin']):?>
									<a class="makeAdmin" data-toggle="modal" data-target="#doAdminModal{{{$u['id']}}}"><span class="glyphicon glyphicon-star no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="is Admin"></span></a>
								<?php else:?>
									<a class="makeAdmin" data-toggle="modal" data-target="#doAdminModal{{{$u['id']}}}"><span class="glyphicon glyphicon-star-empty no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="not Admin"></span></a>
								<?php endif;?>
							<?php endif;?>
							</h3>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-6 col-xs-1 show_projects no_padding_left admin_Details_Button">
							<ul class="my_projects pull-right">
								<li class="dropdown_myprojects" onclick="showDetails('project_{{{$u['id']}}}')" id="drop_project_{{{$u['id']}}}" ><span class="icon_more"></span></li>
							</ul>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 admin_Header">
							<?=$u['email'] ?>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
							<h5>{{{ $u['last_Login'] }}}</h5>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 admin_Tools">
							<a href="adminEditUser/<?=$u['id'] ?>"> 
								<span class="edit-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"></span>
							</a>
							<a data-toggle="modal" data-target="#deleteModal{{{$u['id']}}}"> 
								<span class="delete-icon no_background" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="edit"></span>
							</a>
						</div>
						<div id="project_{{{$u['id']}}}" class="projects" style="display:none;">
						<?php $count=0;?>
							<?php if(count($u['projects'])>0):?>
							<div class="divider_style_1_project_inside"></div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><h5 class="no_margin_top_bottom">Title</h5></div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><h5 class="no_margin_top_bottom">Updated</h5></div>
							<div class="col-lg-2 col-md-4 col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-6"><h5 class="no_margin_top_bottom">Tools</h5></div>
							<div class="divider_style_3"></div>
								<?php foreach($u['projects'] as $p):?>
								<?php $count++;?>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
										<h4>{{{ $p->title }}} [ id: {{{ $p->id }}} ]</h4>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 6">
										<h5 class="no_margin_bottom">{{{ date('Y-m-d | H:m',strtotime($p->updated_at)) }}}</h5>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 col-sm-4 col-xs-12">
										<a class="bmc_link" href="projects/showBMCs/{{{ $p->id }}},1"">
											<button type="button" class="btn btn-primary btn-secundar">Show Models</button>
										</a>
									</div>
									<?php if(count($u['projects'])>$count):?>
										<div class="divider_style_3"></div>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="deleteModal{{{$u['id']}}}" tabindex="-1" role="dialog">
					<div class="modal-dialog delete" role="document">
						<div class="modal-content delete col-md-12">
							<div class="modal-header col-md-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Do you want to delete User <?=$u['name'] ?>?</h4>
							</div>
							<div class="modal-footer delete col-md-12">
								<div class="col-md-6"><a href="adminDeleteUser/<?=$u['id'] ?>"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="doAdminModal{{{$u['id']}}}" tabindex="-1" role="dialog">
					<div class="modal-dialog delete" role="document">
						<div class="modal-content delete col-md-12">
							<div class="modal-header col-md-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php if($u['is_Admin']):?>
									<h4 class="modal-title">Do you want to remove all Admin Rights from <?=$u['name'] ?>?</h4>
								<?php else :?>
									<h4 class="modal-title">Do you want to give <?=$u['name'] ?> Admin Rights?</h4>
								<?php endif;?>
							</div>
							<div class="modal-footer delete col-md-12">
								<?php if($u['is_Admin']):?>
									<div class="col-md-6"><a href="removeAdminRights/<?=$u['id'] ?>,remove"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								<?php else :?>
									<div class="col-md-6"><a href="giveAdminRights/<?=$u['id'] ?>,add"><button type="button" class="btn btn-primary btn-lg">Yes</button></a></div>
								<?php endif;?>
								<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">No</button></div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</div>

<div class="modal fade" id="createUser" tabindex="-1" role="dialog">
	<div class="modal-dialog delete" role="document">
		<div class="modal-content delete col-md-12">
			<div class="modal-header col-md-12">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Create new User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('createNewUser') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
							<div class="form-group">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="username">
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-8">
									<input type="email" class="form-control" name="email">
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="password">
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="password_confirmation">
								</div>
							</div>
							
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Give Role</label>
								<div class="col-md-8">
									<select class="form-control" id="gender" name="is_admin">
										<option value="User">User</option>
										<option value="Admin">Admin</option>
									</select>
								</div>
							</div>
							<div class="divider_style_3"></div>
							<div class="form-group">
								<div class="col-md-6"><button type="submit" class="btn btn-primary">Register</button></div>
								<div class="col-md-6"><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Back</button></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
<script>
function showUserDetails(){
	var index;
	var elem = document.getElementsByClassName('projects')
	
	if(document.getElementById("dropdown_details").className == 'dropdown_userDetails'){
		document.getElementById('dropdown_details').className = 'dropdown_userDetails_open';
	}
	else{
		document.getElementById('dropdown_details').className = 'dropdown_userDetails';
	}
	
	for (index = 0; index < elem.length; ++index) {
		if(document.getElementById("dropdown_details").className == 'dropdown_userDetails'){ //alles schließen
			if(elem[index].style.display != 'none'){
				var name = 'drop_'+elem[index].getAttribute('id');
				elem[index].style.display = 'none';
				document.getElementById(name).className = 'dropdown_userDetails';
			}
		}else{ //alles öffnen
			if(elem[index].style.display != 'block'){
				var name = 'drop_'+elem[index].getAttribute('id');
				elem[index].style.display = 'block';
				document.getElementById(name).className = 'dropdown_userDetails_open';
			}
		}
	}
}
function showDetails(id){
	var elem = document.getElementById(id);
	var name = 'drop_'+id;
	
	if(elem.style.display == 'block'){
		elem.style.display = 'none';
		document.getElementById(name).className = 'dropdown_userDetails';
	}
	else{
		elem.style.display = 'block';
		document.getElementById(name).className = 'dropdown_userDetails_open';
	}
}
</script>