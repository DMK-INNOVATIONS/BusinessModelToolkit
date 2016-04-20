@extends('app')

@section('content')

<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
	  <h1>Export</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><b><?= $bmc['title'];?></b> <button type="button" data-toggle="modal" data-target="#helpModal" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button></div>
				<div class="panel-body">
					<div class="col-md-6 export">
						<a href="<?= $path.'/export/export/'.$bmc["id"].','.$project["id"].',1'.',P';?>"><button type="button" class="btn btn-primary btn-lg">Portrait Format</button></a>
					</div>
	  				<div class="col-md-6 export">
	  					<a href="<?= $path.'/export/export/'.$bmc["id"].','.$project["id"].',1'.',L';?>"><button type="button" class="btn btn-primary btn-lg">Landscape Format</button></a>
  					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php 
							if($view_type == 'models'){
								print '<a href="'.$path.'/bmc/models"><button type="button" class="btn btn-default">Back to Model View</button></a>';
							}else{
								print '<a href="'.$path.'/projects/showBMCs/'.$project["id"].',{{{$owner}}}"><button type="button" class="btn btn-default">Back to Project View</button></a>';
							}
						?>
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
<script type="text/javascript">
$(function() {
	var d = document.getElementById("footer");
	d.className += " footerSmXs";
});
</script>
@endsection
