@extends('layout')

@section('content')

<form action="/admin/new/store" method=post enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	Name
	<input type="text" name="name" placeholder="Name of Place">
	Difficulty
	<select name="difficulty">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
	</select>
	Image
	<input type="file" name="image">
    <input type="submit" name="submit" value="Submit">
</form>

@stop