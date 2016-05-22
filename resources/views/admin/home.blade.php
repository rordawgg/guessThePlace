@extends('layout')

@section('content')

@if(Session::has('message'))
	<h2>{{Session::get('message')}}</h2>
@endif

	<a href="admin/new"><ul>Create New Place</ul></a>
	<a href="admin/image/new"><ul>Add Image</ul></a>
	<a href="admin/edit"><ul>Edit</ul></a>


@stop