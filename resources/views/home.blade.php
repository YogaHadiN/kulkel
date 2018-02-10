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
<div class="panel panel-default">
	<div class="panel-heading">
		<h1>
			{{ \Auth::user()->nama }}
			@if( $stases->count() )
				<strong>({{ $stases->first()->jenisStase->jenis_stase }})</strong>  
			@endif
		</h1>
	</div>
	<div class="panel-body">
		@include('tugas')
	</div>
</div>
@stop
@section('footer') 
	
@stop
