@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP

@stop
@section('page-title') 
<h2>Library</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('library')}}">Perpustakaan</a>
	  </li>
	  <li class="active">
		  <strong>Buat Buku Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Buat Buku Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'library', 'method' => 'post']) !!}
						@include('library.form')
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

