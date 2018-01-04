@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP | Edit Buku {{ $buku->nama_buku }}

@stop
@section('page-title') 
<h2>ulit Kelamin UNDIP | Edit Buku {{ $buku->nama_buku }}</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('library')}}">Perpustakaan</a>
	  </li>
	  <li class="active">Edit {{ $buku->nama_buku }}</li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ $buku->nama_buku }}</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($buku, ['url' => 'library/' . $buku->id, 'method' => 'put']) !!}
						@include('library.form', ['buku' => $buku])
					{!! Form::close() !!}
					<br />
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							{!! Form::open(['url' => 'library/' . $buku->id, 'method' => 'delete']) !!}
								{!! Form::submit('Hapus', [
									'class'   => 'btn btn-warning btn-block',
									'id'      => 'submitDelete',
									'onclick' => 'return confirm("Yakin mau menghapus?");return false',
								]) !!}
							{!! Form::close() !!}
						</div>
					</div>
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

