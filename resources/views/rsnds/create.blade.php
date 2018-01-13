@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat RSND Baru

@stop
@section('page-title') 
<h2>Kulkel UNDIP | Buat RSND Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('rsnds')}}">Rsnd</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Buat RSND Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Buat RSND BARU</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'rsnds', 'method' => 'post']) !!}
					<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
					  {!! Form::label('user_id', 'Nama Residen') !!}
					  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search' => 'true']) !!}
					  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
					</div>
					<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
					  {!! Form::label('tanggal', 'Tanggal') !!}
					  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
					  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
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

