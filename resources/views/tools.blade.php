@extends('layouts.master')

@section('title') 
Kulkel Undip | Tools 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Tools</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Sms Bulanan</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'tools/sms_bulanan', 'method' => 'post']) !!}
					<div class="form-group @if($errors->has('bulan')) has-error @endif">
					  {!! Form::label('bulan', 'Bulan', ['class' => 'control-label']) !!}
					  {!! Form::text('bulan' , date('m-Y', strtotime('+1 month')), ['class' => 'form-control bulanTahun']) !!}
					  @if($errors->has('bulan'))<code>{{ $errors->first('bulan') }}</code>@endif
					</div>
					{!! Form::submit('Submit', ['class' => 'btn btn-primary btn-block', 'id' => 'submit']) !!}
				{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Sms Harian</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'tools/sms_harian', 'method' => 'post']) !!}
					<div class="form-group @if($errors->has('tanggal')) has-error @endif">
					  {!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
					  {!! Form::text('tanggal' , date('d-m-Y'), ['class' => 'form-control tanggal']) !!}
					  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
					</div>
					{!! Form::submit('Submit', ['class' => 'btn btn-success btn-block', 'id' => 'submit']) !!}
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Email Tundaan Ujian</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'tools/email_tundaan_ujian', 'method' => 'post']) !!}
					<div class="form-group @if($errors->has('bulan')) has-error @endif">
					  {!! Form::label('bulan', 'Tanggal', ['class' => 'control-label']) !!}
					  {!! Form::text('bulan' , date('m-Y'), ['class' => 'form-control bulanTahun']) !!}
					  @if($errors->has('bulan'))<code>{{ $errors->first('bulan') }}</code>@endif
					</div>
					{!! Form::submit('Submit', ['class' => 'btn btn-info btn-block', 'id' => 'submit']) !!}
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

