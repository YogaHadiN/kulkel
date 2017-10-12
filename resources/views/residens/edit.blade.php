@extends('layouts.master')

@section('title') 
Klinik Jati Elok | Edit Residen

@stop
@section('page-title') 
<h2>Edit Residen</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('residens')}}">Residen</a>
	  </li>
	  <li class="active">
		  <strong>Edit Residen</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Resdien</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($residen, ['url' => 'residens/'. $residen->id, 'method' => 'put']) !!}
						@include('residens.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
{!! HTML::script('js/residens.js')!!}
@stop

