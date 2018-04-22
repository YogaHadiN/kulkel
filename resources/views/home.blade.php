@extends('layouts.master')

@section('title') 
Kulkel UNDIP | 

@stop
@section('head') 

@stop

@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li class="active">
		  <strong>Home</strong>
	  </li>
</ol>

@stop
@section('content') 
	@include('users.show_content')
@stop
@section('footer') 
	
@stop
