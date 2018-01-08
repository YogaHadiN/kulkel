@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Residen Pegangan

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Residen Pegangan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Edit Residen Pegangan</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Residen Pegangan</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($pegangan, ['url' => 'pegangans/residen/' . $pegangan->id, 'method' => 'put']) !!}
					@include('residen_pegangans.form')	
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
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
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop

