@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Topik
@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Topik</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
			<a href="{{ url('seminars/' . $topik->seminar->id)}}">{{ $topik->seminar->seminar }}</a>
	  </li>
	  <li class="active">
		  <strong>Edit Topik</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ $topik->seminar->seminar }}</h3>
		</div>
		<div class="panel-body">
		{!! Form::model($topik, array(
			"url"   => "topiks/" . $topik->id,
			"class" => "m-t", 
			"role"  => "form",
			"files"  => "true",
			"method"=> "put"
		))!!}
		{!! Form::text('seminar_id', $topik->seminar_id, ['class' => 'form-control hide']) !!}
			@include('topiks.form')
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
					{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
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

