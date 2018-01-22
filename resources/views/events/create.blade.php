@extends('layouts.master')

@section('title') 
kulkel undip | tambah event

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	  <li class="active">
		  <strong>tambah event</strong>
	  </li>
</ol>
@stop

@section('content') 
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">tambah event</h3>
			</div>
			<div class="panel-body">
			{!! Form::open([
				'url' => 'events', 
				'method' => 'post',
				"class" => "m-t", 
				"role"  => "form",
				"files"=> true
			]) !!}
			@include('events.form')
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<button class="btn btn-success btn-block" type="button" onclick='dummysubmit(this);return false;'>submit</button>
						{!! form::submit('submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a class="btn btn-danger btn-block" href="{{ url('events') }}">cancel</a>
					</div>
				</div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	function dummysubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script>
@stop

