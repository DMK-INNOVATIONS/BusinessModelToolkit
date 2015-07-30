@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">

				<div class="panel-body">
					Welcome {{ Auth::user()->name }}!
				</div>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-4 col-xs-12">
			    <a href="{{ url('/projects') }}" class="thumbnail thumbnail_start">
			      <img class="img-circle" src="{{ asset('img/my_projects.png') }}" alt="My Projects">
			    </a>
			</div>
			<div class="col-md-4 col-xs-12">
			    <a href="{{ url('/persona') }}" class="thumbnail thumbnail_start">
			      <img class="img-circle" src="{{ asset('img/my_personas.png') }}" alt="My Persona">
			    </a>
			</div>
			<div class="col-md-4 col-xs-12">
			    <a href="#" class="thumbnail thumbnail_start">
			      <img class="img-circle" src="{{ asset('img/latest_bmc.png') }}" alt="latest BMC">
			    </a>
			</div>
		</div>
	</div>
</div>
@endsection
