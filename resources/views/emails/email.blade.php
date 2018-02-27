@extends('layouts.master')

@section('title') 
	Kulkel UNDIP

@stop
@section('page-title') 
<h2>	Kulkel UNDIP</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Email</h3>
		</div>
		<div class="panel-body">
		{!! Form::open(['url' => 'email', 'method' => 'post']) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group @if($errors->has('email'))has-error @endif">
					  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
						{!! Form::text('email', null, array(
							'class'         => 'form-control rq'
						))!!}
					  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group @if($errors->has('subject'))has-error @endif">
					  {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
						{!! Form::text('subject', null, array(
							'class'         => 'form-control rq'
						))!!}
					  @if($errors->has('subject'))<code>{{ $errors->first('subject') }}</code>@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group @if($errors->has('message'))has-error @endif">
					  {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
						{!! Form::textarea('message', null, array(
							'class'         => 'form-control rq textareacustom'
						))!!}
					  @if($errors->has('message'))<code>{{ $errors->first('message') }}</code>@endif
					</div>
				</div>
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

