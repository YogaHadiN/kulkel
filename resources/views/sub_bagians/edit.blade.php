@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Anggota Sub Bagian Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Edit Anggota Sub Bagian Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Edit Anggota Sub Bagian Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model( $sub_bagian, ['url' => 'sub_bagians/' . $sub_bagian->id . '/edit', 'method' => 'put']) !!}
					@include('sub_bagians.form')
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
			{!! Form::open(['url' => 'sub_bagians/' .$sub_bagian->id, 'method' => 'delete']) !!}
				{!! Form::submit('Delete', [
					'class'   => 'btn btn-warning btn-block',
					'onclick' => 'return confirm("Anda yakin mau menghapus ' . $sub_bagian->id .'?");return false;'
				]) !!}
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

