@extends('layouts.master')

@section('title') 
Klinik Jati Elok | Kembalikan Buku Perpustakaan

@stop
@section('page-title') 
<h2>Kembalikan Buku Perpustakaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Kembalikan Buku Perpustakaan</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Kembalikan Buku {{ $pinjam->perpus->nama_buku }}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<tbody>
								<tr>
									<td>Nama Buku</td>
									<td>{{ $pinjam->perpus->nama_buku }}</td>
								</tr>
								<tr>
									<td>Nama Peminjam</td>
									<td>{{ $pinjam->peminjam->nama }}</td>
								</tr>
								<tr>
									<td>Nama Admin Peminjam</td>
									<td>{{ $pinjam->admin->nama }}</td>
								</tr>
								<tr>
									<td>Tanggal Pinjam</td>
									<td>{{ $pinjam->tanggal_pinjam_format }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					{!! Form::open(['url' => 'library/kembalikan/' . $pinjam->id, 'method' => 'put']) !!}
						<div class="hide form-group @if($errors->has('admin_kembalikan')) has-error @endif">
							{!! Form::label('admin_kembalikan_id', 'Admin Kembalikan', ['class' => 'control-label']) !!}
						  {!! Form::text('admin_kembalikan_id' , \Auth::id(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						  @if($errors->has('admin_kembalikan_id'))<code>{{ $errors->first('admin_kembalikan_id') }}</code>@endif
						</div>
						<div class="form-group @if($errors->has('tanggal_kembalikan')) has-error @endif">
							{!! Form::label('tanggal_kembalikan', 'Tanggal Kembalikan', ['class' =>'control-label']) !!}
						  {!! Form::text('tanggal_kembalikan', date('d-m-Y'), ['class' => 'form-control tanggal']) !!}
						  @if($errors->has('tanggal_kembalikan'))<code>{{ $errors->first('tanggal_kembalikan') }}</code>@endif
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Submit', [
									'class' => 'btn btn-success hide', 
									'onclick' => 'return confirm("Anda yakin mau mengembalikan buku ' . $pinjam->perpus->nama_buku .  '")', 
									'id' => 'submit'
								]) !!}
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

