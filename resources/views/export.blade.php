@extends('app')

@section('content')

<?php 
	$posturl = "";
	if($_SERVER['SERVER_NAME']== 'localhost' || $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
		$path = '/bmc/public';
	}else{
		$path = '';
	}
?>

<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
	  <h1>Export</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b><?php print $bmc['title'];?></b> <button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
					<div class="col-md-6 export">
						<a href="<?php print $path.'/export/export/'.$bmc["id"].','.$project["id"].',1'.',P';?>"><button type="button" class="btn btn-primary btn-lg">Portrait Format</button></a>
					</div>
	  				<div class="col-md-6 export">
	  					<a href="<?php print $path.'/export/export/'.$bmc["id"].','.$project["id"].',1'.',L';?>"><button type="button" class="btn btn-primary btn-lg">Landscape Format</button></a>
  					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<a href="<?php print $path.'/projects/showBMCs/'.$project["id"].','.$owner;?>"><button type="button" class="btn btn-default">Back to Project View</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Export Help</h4>
      </div>
      <div class="modal-body">
		...
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
