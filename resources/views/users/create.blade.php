@extends('layouts.master')

@section('title') 
	Kulit dan Kelamin UNDIP | Buat User Baru

@stop
@section('page-title') 
<h2>Buat User Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Buat User Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Buat User Baru</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'users', 'method' => 'post']) !!}
					@include('users.form')
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
		</div>
	</div>
@stop
@section('footer') 
{!! HTML::script('js/telpon.js')!!}
	<script type="text/javascript" charset="utf-8">
		$('#telps').val('');
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop

