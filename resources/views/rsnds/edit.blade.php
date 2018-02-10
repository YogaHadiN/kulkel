@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Rsnd

@stop
@section('page-title') 
<h2>Kulkel UNDIP | Edit Rsnd</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('rsnds')}}">Rsnd</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Edit Rsnd</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Edit RSND</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($rsnd, ['url' => 'rsnds/' . $rsnd->id, 'method' => 'put']) !!}
					@include('rsnds.form')
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script>
	
@stop

