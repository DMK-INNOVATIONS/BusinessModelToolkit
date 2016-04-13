@extends('app')

@section('content')
<div id="project_list">
	<div class="container">
		<div class="row no_margin">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-2 col-md-2 col-sm-1 col-xs-5">
					<h5>Name [ User-id ]</h5>
				</div>
				<div class="col-md-2 show_projects no_padding_right">
					<h6 class="text-right">Show details</h6>
				</div>
				<div class="col-md-1 show_projects no_padding_left">
					<ul class="my_projects">
						<li class="dropdown_myprojects"><span class="icon_more"></span></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-2 col-sm-1 col-xs-5">
					<h5>Email</h5>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
					<h5>Tools</h5>
				</div>
				<div class="divider_style_2_project"></div>
			</div>
			<?php foreach($user as $u):?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row col-md-12 admin_User_list">
						<div class="col-md-4">
							<h3><?=$u['name'] ?> [ <?=$u['id'] ?> ]</h3>
						</div>
						<div class="col-md-1 no_padding_left">
							<span class="details_myprojects"></span>
						</div>
						<div class="col-md-3">
							<?=$u['email'] ?>
						</div>
						<div class="col-md-4">
							Tools
						</div>
						<div class="divider_style_1_project_inside"></div>
						<div class="projects_{{{$u['id']}}}">
							<div class="col-md-4"><h5>Title</h5></div>
							<div class="col-md-2"><h5 class="no_margin_top_bottom">Updated</h5></div>
							<div class="col-md-2"><h6 class="no_margin_top_bottom">Created</h6></div>
							<div class="col-md-2"><h5>Tools</h5></div>
							<div class="divider_style_3"></div>
							<?php $count=0;?>
							<?php if(count($u['projects'])>0):?>
								<?php foreach($u['projects'] as $p):?>
								<?php $count++;?>
									<div class="col-md-4">
										<h4>{{{ $p->title }}} [ {{{ $p->id }}} ]</h4>
									</div>
									<div class="col-md-6">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<h5 class="no_margin_bottom">{{{ date('Y-m-d | H:m',strtotime($p->updated_at)) }}}</h5>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<h6 class="no_margin_top">{{{ date('Y-m-d | H:m',strtotime($p->created_at)) }}}</h6>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
										<a class="bmc_link" href="">
											<button type="button" class="btn btn-primary btn-secundar">Show Modals</button>
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
			<?php endforeach;?>
		</div>
	</div>
</div>

@endsection