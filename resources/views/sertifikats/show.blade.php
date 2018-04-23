@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Sertifikat

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Create Sertifikat </h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	<li>
		<a href="{{ url('users/' . $sertifikat->user->id )}}">{{ $sertifikat->user->nama }}</a>
	  </li>
		<li>
			<a href="{{ url('users/' . $sertifikat->user->id . '/image')}}">Image</a>
	  </li>
	  <li class="active">
		  <strong>Create Sertifikat </strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ $sertifikat->judul }}</h3>
		</div>
		<div class="panel-body">
			@if( Storage::cloud()->exists($sertifikat->filename) )
				<img src="{{ Storage::cloud()->url($sertifikat->filename) }}"  class="img-rounded upload full-width" alt="" />
			@endif
			<div class="row">
				<td> 
					{!! Form::open(['url' => 'sertifikats/' .$sertifikat->id, 'method' => 'delete']) !!}
						<div class="col-md-4">
							<a class="btn btn-info btn-sm btn-block" href="{{ url('sertifikats/' . $sertifikat->id . '/edit' ) }}">Edit</a>
						</div>
						<div class="col-md-4">
							<a class="btn btn-warning btn-sm btn-block" href="{{ url('users/' . $sertifikat->user_id . '/image') }}">Cancel</a>
						</div>
						<div class="col-md-4">
							{!! Form::submit('Delete', [
								'class'   => 'btn btn-danger btn-sm btn-block',
								'onclick' => 'return confirm("Anda yakin mau menghapus ' . $sertifikat->id . '-' . $sertifikat->name.'?");return false;'
							]) !!}
						</div>
					{!! Form::close() !!}
				</td>
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

