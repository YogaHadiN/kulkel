@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat Topik Baru
@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Buat Topik Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
			<a href="{{ url('seminars/' . $seminar->id)}}">{{ $seminar->seminar }}</a>
	  </li>
	  <li class="active">
		  <strong>Buat Topik Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ $seminar->seminar }}</h3>
		</div>
		<div class="panel-body">
		{!! Form::open(array(
			"url"   => "topiks",
			"class" => "m-t", 
			"role"  => "form",
			"files"  => "true",
			"method"=> "post"
		))!!}
		{!! Form::text('seminar_id', $seminar->id, ['class' => 'form-control hide']) !!}
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

