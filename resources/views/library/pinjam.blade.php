@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP

@stop
@section('page-title') 
	<h2>Pinjam Buku {{ $buku->nama_buku }}</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('library')}}">Perpustakaan</a>
	  </li>
		<li>
			<a href="{{ url('library/' . $buku->id)}}">{{ $buku->nama_buku }}</a>
	  </li>
	  <li class="active">
		  <strong>Pinjam</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Pinjam Buku {{ $buku->nama_buku }}</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'library/pinjam', 'method' => 'post']) !!}
						<div class="form-group hide @if($errors->has('perpus_id')) has-error @endif">
							{!! Form::label('perpus_id', 'Buku id', ['class' => 'control-label']) !!}
						  {!! Form::text('perpus_id' ,  $buku->id , ['class' => 'form-control rq', 'readonly' => 'readonly']) !!}
						  @if($errors->has('perpus_id'))<code>{{ $errors->first('perpus_id') }}</code>@endif
						</div>
						<div class="form-group hide @if($errors->has('admin_id')) has-error @endif">
							{!! Form::label('admin_id', 'Admin Id', ['class' => 'control-label']) !!}
						  {!! Form::text('admin_id' , Auth::id(), [
								  'class'    => 'form-control rq',
								  'readonly' => 'readonly'
							  ]) !!}
						  @if($errors->has('admin_id'))<code>{{ $errors->first('admin_id') }}</code>@endif
						</div>
						<div class="form-group @if($errors->has('peminjam_id')) has-error @endif">
							{!! Form::label('peminjam_id', 'Nama Peminjam', ['class' => 'control-label']) !!}
							{!! Form::select('peminjam_id', App\User::list(), null, ['class' => 'form-control rq selectpick', 'data-live-search' => 'true']) !!}
						  @if($errors->has('peminjam_id'))<code>{{ $errors->first('peminjam_id') }}</code>@endif
						</div>
						<div class="form-group @if($errors->has('tanggal_pinjam')) has-error @endif">
							{!! Form::label('tanggal_pinjam', 'Tanggal Peminjaman', ['class' => 'control-label']) !!}
						  {!! Form::text('tanggal_pinjam' , date('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
						  @if($errors->has('tanggal_pinjam'))<code>{{ $errors->first('tanggal_pinjam') }}</code>@endif
						</div>
						<div class="form-group @if($errors->has('perkiraan_tanggal_kembalikan')) has-error @endif">
							{!! Form::label('perkiraan_tanggal_kembalikan', 'Tanggal Perkiraan Kembali', ['class' => 'control-label']) !!}
						  {!! Form::text('perkiraan_tanggal_kembalikan' , date('d-m-Y', strtotime("+3 days")), ['class' => 'form-control rq']) !!}
						  @if($errors->has('perkiraan_tanggal_kembalikan'))<code>{{ $errors->first('perkiraan_tanggal_kembalikan') }}</code>@endif
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
							</div>
						</div>
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
