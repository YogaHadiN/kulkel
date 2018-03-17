@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Seminars

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Seminars</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('seminars')}}">Seminars</a>
	  </li>
	<li>
		<a href="{{ url('seminars/' . $seminar->id )}}">{{ $seminar->seminar }}</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Seminar</h3>
		</div>
		<div class="panel-body">
			{!! Form::model($seminar, ['url' => 'seminars/' . $seminar->id, 'method' => 'put']) !!}
			@include('seminars.form')
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
					{!! Form::submit('Update', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
				</div>
			</div>
		{!! Form::close() !!}
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

