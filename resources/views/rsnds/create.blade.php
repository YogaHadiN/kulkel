@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat RSND Baru

@stop
@section('page-title') 
<h2>Kulkel UNDIP | Buat RSND Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('rsnds')}}">Rsnd</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Buat RSND Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Buat RSND BARU</h3>
			</div>
			<div class="panel-body">
			{!! Form::open(['url' => 'rsnds', 'method' => 'post']) !!}
					@include('rsnds.form')
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop
@section('footer') 
<script src="{!! url('js/kurangtambah.js') !!}"></script>
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}

</script>
	
@stop

