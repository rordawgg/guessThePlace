@extends('layout')

@section('content')

<div class="{!! Session::get('class') !!} alert" >
	@if(Session::has('message'))
		<h2>{{Session::pull('message')}}</h2>
	@endif
</div>

<div id='counter_bar'>
	<h3 class='counter_title'>Score</h3>
	<h3 class='counter_name'> Correct: {{ Session::get('correct', 0) }} </h3>
	<h3 class='counter_name'> Incorrect: {{ Session::get('incorrect', 0) }} </h3>
	<h3 class='counter_name'> Difficulty: {{ Session::get('diff', 1) }} </h3>
	<form action="/score/reset" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" value="Reset Score">
	</form>
</div>


<span>
	<img id="main_photo" src="{{$true->path}}">
</span>

<div id='list'>
	<form action="/score" method='post'>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@foreach($places as $place)
			<input id='buttons' type="submit" name="name" value="{{$place->name->name}}">
		@endforeach
	</form>
</div>		


@stop