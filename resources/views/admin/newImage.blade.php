@extends('layout')

@section('content')

<h2>Add New Image</h2>

<form action="/admin/image/new/store" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	Name of Place
	<select name="name">
		@foreach($names as $name)
			<option value='{{$name->id}}'>{{$name->name}}</option>
		@endforeach
	</select>
	Difficulty
	<select name="difficulty">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
	</select>
	Image
	<input type="file" name='image'>
	<input type="submit" value="Submit">
</form>

@stop