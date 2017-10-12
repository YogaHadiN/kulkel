@extends('layouts.master')

@section('title') 
Kulkel Undip | Ubah Dosen

@stop
@section('page-title') 
<h2>Ubah Dosen</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('dosens')}}">Dosen</a>
	  </li>
	  <li class="active">
		  <strong>Ubah Dosen</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Ubah Dosen
						</div>
					</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($dosen, ['url' => 'dosens/' . $dosen->id, 'method' => 'put']) !!}
						@include('dosens.form', ['edit' => true])
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

