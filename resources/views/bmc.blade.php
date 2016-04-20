@extends('app') @section('content')
<div class="container">
	@if (Auth::user()->name)
	<div class=" col-md-12 col-sm-12 col-xs-12 text-center">
		<h1>Welcome back, {{{ Auth::user()->name }}}!</h1>
	</div>
	<div class="divider_style_2 extra_space"></div>
	@endif
	<div class="row">
		<div class="col-md-12 text-center"><h4>Choose from the following options:</h4></div>
		<div class="col-md-12 text-center">
			<a href="{{{ url('/projects') }}}" class="first_screen">Projects</a>
		</div>
		<div class="col-md-12 text-center">
			<a href="{{{ url('/persona') }}}" class="first_screen">Persona</a>
		</div>
		<div class="col-md-12 text-center">
			<a href="{{{ url('/team') }}}" class="first_screen">Team</a>
		</div>
	</div>
</div>
<script>
$(function ($) {
	var d = document.getElementById("footer");
	d.className += " indexFooter";
});
var height=0;
var h=0;
var count_panel=0; 
$(".inside .col-md-2-4").each(function(){
	count_panel=$(this).children().length;
	console.log(count_panel);
	h=$(this).height();
	if(h>height)
	{
		height=h;
	}
});
	count_panel=$(".col-md-2-4").children().length;
	console.log("panel:"+count_panel);


console.log("max height"+ height);
</script>
@endsection
