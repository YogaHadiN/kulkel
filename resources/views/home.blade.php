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
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tugas</a></li>
			<li role="presentation"><a href="#tundaan_ujian" aria-controls="tundaan_ujian" role="tab" data-toggle="tab">Tundaan Ujian</a></li>
		  </ul>
		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				@include('tugas')
			</div>
			<div role="tabpanel" class="tab-pane" id="tundaan_ujian">
				@include('users.tundaan_ujians')
			</div>
		  </div>
		</div>
	</div>
</div>
@stop
@section('footer') 
	
@stop
