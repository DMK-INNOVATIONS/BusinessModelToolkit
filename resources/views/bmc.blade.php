@extends('app') @section('content')
<div class="container-fluid">
	<div class=" col-md-10 col-md-offset-1 col-sm-10 col-xs-12 page-header">
		<h1>Welcome {{ Auth::user()->name }}!</h1>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-4 col-xs-12">
				<a href="{{ url('/projects') }}" class="thumbnail thumbnail_start">
					<img class="img-circle" src="{{ asset('img/my_projects.png') }}"
					alt="My Projects">
				</a>
			</div>
			<div class="col-md-4 col-xs-12">
				<a href="{{ url('/persona') }}" class="thumbnail thumbnail_start"> <img
					class="img-circle" src="{{ asset('img/my_personas.png') }}"
					alt="My Persona">
				</a>
			</div>
			<div class="col-md-4 col-xs-12">
				<a href="#" class="thumbnail thumbnail_start"> <img
					class="img-circle" src="{{ asset('img/latest_bmc.png') }}"
					alt="latest BMC">
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
