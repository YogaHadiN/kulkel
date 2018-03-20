@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat Ebooks

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Buat Ebooks</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Buat Ebooks</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Buat Ebook Baru</h3>
		</div>
		<div class="panel-body">
		{!! Form::open([
			'url'    => 'ebooks',
			"class" => "m-t", 
			"role"  => "form",
			"files"  => "true",
			'method' => 'post'])
		!!}
			<div class="form-group{{ $errors->has('materi') ? ' has-error' : '' }}">
				{!! Form::label('materi', 'Materi', ['class' => 'control-label']) !!}
				{!! Form::file('materi') !!}
					@if (isset($ebook) && $ebook->nama_file_materi)
						<p>{{ $ebook->nama_file_materi }}</p>
					@endif
				{!! $errors->first('materi', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
					{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a class="btn btn-danger btn-block" href="{{ url('ebooks') }}">Cancel</a>
				</div>
			</div>
		{!! Form::close() !!}
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

