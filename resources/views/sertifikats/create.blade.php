@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Create Sertifikat 

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Create Sertifikat </h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	<li>
		<a href="{{ url('users/' . $user->id )}}">{{ $user->nama }}</a>
	  </li>
		<li>
			<a href="{{ url('users/' . $user->id . '/image')}}">Image</a>
	  </li>
	  <li class="active">
		  <strong>Create Sertifikat </strong>
	  </li>
</ol>
@stop
@section('content') 
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Buat Sertifikat {{ $user->nama }}</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(['url' => 'sertifikats', 'method' => 'post',"files"  => "true" ]) !!}
			{!! Form::text('user_id', $user->id, ['class' => 'form-control hide']) !!}
		<div class="form-group @if($errors->has('judul')) has-error @endif">
		  {!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
		  {!! Form::text('judul' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('judul'))<code>{{ $errors->first('judul') }}</code>@endif
		</div>
		<div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
			{!! Form::label('filename', 'Sertifikat') !!}
			{!! Form::file('filename', ['class' => 'rq']) !!}
				@if (isset($sertifikat) && $sertifikat->filename)
					<p> <img src="{{ \Storage::cloud()->url($sertifikat->filename) }}" class="img-rounded upload full-width" alt="" /> </p>
				@else
					<p> <img src="{{ \Storage::cloud()->url('no_image.jpeg') }}" class="img-rounded upload full-width" alt="" /> </p>
				@endif
			{!! $errors->first('filename', '<p class="help-block">:message</p>') !!}
		</div>
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

