@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Sertifikat 

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Sertifikat </h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	<li>
		<a href="{{ url('users/' . $sertifikat->user->id )}}">{{ $sertifikat->user->nama }}</a>
	  </li>
		<li>
			<a href="{{ url('users/' . $sertifikat->user->id . '/image')}}">Image</a>
	  </li>
	  <li class="active">
		  <strong>Edit Sertifikat </strong>
	  </li>
</ol>
@stop
@section('content') 
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Sertifikat {{ $sertifikat->user->nama }}</h3>
	</div>
	<div class="panel-body">
		{!! Form::model($sertifikat, ['url' => 'sertifikats/' . $sertifikat->id, 'method' => 'put',"files"  => "true" ]) !!}
			{!! Form::text('user_id', $sertifikat->user->id, ['class' => 'form-control hide']) !!}
			@include('sertifikats.form')
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

