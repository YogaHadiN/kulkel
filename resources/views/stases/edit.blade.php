@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Stase

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Stase</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Edit Stase</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Edit Stase
					</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($stase, ['url' => 'stases/' . $stase->id, 'method' => 'put']) !!}
					@include('stases.form')
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

