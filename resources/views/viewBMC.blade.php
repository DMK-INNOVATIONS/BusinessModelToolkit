@extends('app')

@section('content')

<?php

if(!isset($error)){
	$error = false;
}
$posturl = "";
if (isset ( $user )) :
	$posturl = $user ['id'];


 endif;
?>
<div class="help_info">
	<a class="help-icon" data-toggle="modal" data-target="#helpModal"> <span
		class="icon-question" aria-hidden="true"></span>
	</a>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default bmc_view_background">
				<div class="panel-heading bmc_view_Header no_padding_right">
					<div class="col-md-3 col-sm-4">
						<?php
						if ($view_type == 'models') {
							print '<a href="'.$path.'/bmc/models"><button type="button" class="btn btn-default">Back to Model View</button></a>';
						} else {
							print '<a href="'.$path.'/projects/showBMCs/'.$project_id.','.$owner.'"><button type="button" class="btn btn-primary btn-secundar no-margin-left">Back to Project</button></a>';
						}
						?>
					</div>
					<div class="col-md-7 col-sm-4">
						<?php
						if ($owner != 0) {
							print '<a type="button" class="edit-icon-header" data-toggle="modal" data-target="#titleChangeModal" class="btn btn-default btn-sm"></a>  ';
						}
						?>
						<h1 style="margin-top: 10px;">{{{$bmc_name}}}</h1>
					</div>
					<div class="col-md-2 col-sm-4 no_padding_right">
						<div class="pull-right">
						<div class="status_project">
							<a class="show-icon" type="button" data-toggle="modal" data-target="#statusChangeModal">
								<div class="label_{{{$bmc_status}}} label_status_project">
									<h5 class="text_status_bmc">{{{$bmc_status}}}</h5>
								</div>
								<!--  <i button type="button" class="icon-triangle glyphicon glyphicon-question-sign"></i>-->
							</a>
							<?php
							
							// Shows Button in Color of Status
							$status;
							switch ($bmc_status) {
								case 'inWork' :
									//print '<a class="show-icon" type="button" data-toggle="modal" data-target="#statusChangeModal"><i class="icon-minus progress glyphicon glyphicon-minus"></i><i class="bmc_view_status_modal">in progress</i><i button type="button" class="icon-triangle glyphicon glyphicon-question-sign"></i></a>';
									$status = 1;
									//break;
								case 'approved' :
									//print '<a class="show-icon" type="button" data-toggle="modal" data-target="#statusChangeModal"><i class="icon-minus approved glyphicon glyphicon-minus"></i><i class="bmc_view_status_modal">approved</i><i button type="button" class="icon-triangle glyphicon glyphicon-ok-sign"></i></a>';
									$status = 2;
									//break;
								case 'rejected' :
									//print '<a class="show-icon" type="button" data-toggle="modal" data-target="#statusChangeModal"><i class="icon-minus rejected glyphicon glyphicon-minus"></i><i class="bmc_view_status_modal">rejected</i><i button type="button" class="icon-triangle glyphicon glyphicon-remove-sign"></i></a>';
									$status = 3;
									//break;
							}
							
							?>
							</div>
						</div>
					</div>
				</div>
				<div class="divider_style_1"></div>
				<div class="panel-body bmcViewBackground">
					<?php if($error):?>
						<div class="alert alert-warning" role="alert">You must enter a Title for your Post-It!</div>
					<?php endif;?>
					<div class="viewBMC_body">
						<div class="row">
							<div class="col-md-2-4 col-sm-2-4">
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Key Partners</h2>
										<h6 id="KP" style="display: none;">
											Who are our Key Partners?<br>
											Who are our Key Suppliers?<br>
											Which Key Resources are we acquiring from partners?<br>
											Which Key Activities do partners perform?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal1"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('KP', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>1])
									@include('postItsViewModal', ['boxId' =>1])
								</div>
							</div>
							<div class="col-md-2-4 col-sm-2-4">
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Key Activities</h2>
										<h6 id="KA" style="display: none;">
											What Key Activities do our Value Propositions require?<br>Our
											Distribution Channels?<br>Customer Relationships?<br>Revenue
											Streams?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal2"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('KA', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>2])
									@include('postItsViewModal', ['boxId' =>2])
								</div>
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Key Ressources</h2>
										<h6 id="KR" style="display: none;">
											What Key Resources do our Value Propositions require?<br>Our
											Distribution Channels?<br>Customer Relationships?<br>Revenue
											Streams?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal3"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('KR', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>3])
									@include('postItsViewModal', ['boxId' =>3])
								</div>
							</div>
							<div class="col-md-2-4 col-sm-2-4">
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Value Propositions</h2>
										<h6 id="VP" style="display: none;">
											What Value Propositions do we deliver to the Customer?<br>
											Which one of our Customer's problems are we helping to solve?<br>
											What bundle of products and services are we offering to each Customer Segment?<br>
											Which customer needs are we satisfying?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal4"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('VP', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>4])
									@include('postItsViewModal', ['boxId' =>4])
								</div>
							</div>
							<div class="col-md-2-4 col-sm-2-4">
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Customer Relationships</h2>
										<h6 id="CR" style="display: none;">
											What type of relationship does each of our Customer Segments expect us to establish and maintain with them?<br>
											Which ones have we established?<br>
											How are these integrated with the rest of our business model?<br>
											How costly are they?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal5"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('CR', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>5])
									@include('postItsViewModal', ['boxId' =>5])
								</div>
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Channels</h2>
										<h6 id="CH" style="display: none;">
											Through which Channels do our Customer Segments want to be
											reached?<br>How are we reaching them now?<br>How are our
											Channels integrated?<br>Which ones work best?<br>Which ones
											are most cost-efficient?<br>How are we integrating them with
											customer routines?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal6"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('CH', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>6])
									@include('postItsViewModal', ['boxId' =>6])
								</div>
							</div>
							<div class="col-md-2-4 col-sm-2-4">
								<div class="panel panel-default">
									<div class="panel-heading primary">
										<h2>Customer Segments</h2>
										<h6 id="CS" style="display: none;">
											For whom are we creating value?<br>Who are our most important
											customers?
										</h6>
									</div>
									<div class="services">
										<a class="add" data-toggle="modal" href="#addPostItModal7"
											role="button"></a> <a class="more" role="button"
											onclick="showStuff('CS', this); return false;"></a>
										<div class="splitline"></div>
									</div>
									@include('postItsContent', ['boxId' =>7])
									@include('postItsViewModal', ['boxId' =>7])
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="panel panel-default">
										<div class="panel-heading primary">
											<h2>Cost Structure</h2>
											<h6 id="CO" style="display: none;">
												What are the most important inherent costs  in our business model?<br>
												Which Key Resources are most expensive?<br>
												Which Key Activities are most expensive?
											</h6>
										</div>
										<div class="services">
											<a class="add" data-toggle="modal" href="#addPostItModal8"
												role="button"></a> <a class="more" role="button"
												onclick="showStuff('CO', this); return false;"></a>
											<div class="splitline"></div>
										</div>
										@include('postItsContent', ['boxId' =>8])
										@include('postItsViewModal', ['boxId' =>8])
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="panel panel-default">
										<div class="panel-heading primary">
											<h2>Revenue Streams</h2>
											<h6 id="RS" style="display: none;">
												For what value are our customers really willing to pay?<br>For
												what do they currently pay?<br>How are they currently
												paying?<br>How would they prefer to pay?<br>How much does
												each Revenue Stream contribute to overall revenues?
											</h6>
										</div>
										<div class="services">
											<a class="add" data-toggle="modal" href="#addPostItModal9"
												role="button"></a> <a class="more" role="button"
												onclick="showStuff('RS', this); return false;"></a>
											<div class="splitline"></div>
										</div>
										@include('postItsContent', ['boxId' =>9])
										@include('postItsViewModal', ['boxId' =>9])
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function ($) {
	//console.log("viewBmc");
	var obj=$('.bmcViewBackground .viewBMC_body > .row .col-md-2-4.col-sm-2-4');
	//var ob=$.makeArray(obj.length);
	var max_height=0;
	var inter_height=0;
	$.each(obj,function(i,v){
		inter_height=$(v).height();
		if(max_height<inter_height){
			max_height=$(v).height();
		}
		//console.log(i+" "+$(v).height());
		});
	//console.log('max'+max_height);
	$.each(obj,function(i,v){
		if($(v).children().length>1){
			$(v).children().last().css('height',max_height-$(v).children().height());
			//console.log(max_height-$(v).children().height());
		}else{
			$(v).children().css('height',max_height+4);	
			}
		//console.log($(v).children().length);
	});
		
});
</script>
@include('viewBMCModals') @endsection
