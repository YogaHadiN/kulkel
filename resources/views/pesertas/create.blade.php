@extends('layouts.master')

@section('title') 
DVUNDIP | Buat Peserta Baru

@stop
@section('page-title') 
<h2>Buat Peserta Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Buat Peserta Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Buat Peserta Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'seminars/'. $id . '/pesertas', 'method' => 'post']) !!}
						@include('pesertas.form')
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

