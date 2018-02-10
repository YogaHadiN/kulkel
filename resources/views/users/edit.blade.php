@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP | Edit User

@stop
@section('page-title') 
	<h2>Edit {{ $user->nama }}</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('users')}}">User</a>
	  </li>
	  <li class="active">
		  <strong>Edit {{ $user->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Edit User</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($user, ['url' => 'users/' . $user->id, 'method' => 'put']) !!}
						@include('users.form')
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
					<br />
					@if(!(\Auth::id() == $user->id) && \Auth::user()->role_id == '3')
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							{!! Form::open(['url' => 'users/' . $user->id, 'method' => 'delete']) !!}
							  {!! Form::submit('Delete', [
								  'class' => 'btn btn-warning btn-block',
								  'onclick' => 'return confirm("anda yakin mau menghapus ' .$user->nama .'?"); return false;'
							  ]) !!}
							{!! Form::close() !!}
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
{!! HTML::script('js/telpon.js')!!}
<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop

