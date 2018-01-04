@extends('layouts.master')

@section('title') 
Klinik Jati Elok | Buat Residen Baru

@stop
@section('page-title') 
<h2>Buat Residen Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Buat Residen Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Residen Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'residens', 'method' => 'post']) !!}
						@include('residens.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
{!! HTML::script('js/telpon.js')!!}
{!! HTML::script('js/residens.js')!!}
@stop

