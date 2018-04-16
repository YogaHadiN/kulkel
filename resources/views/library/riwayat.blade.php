@extends('layouts.master')

@section('title') 
Kulit Kelamin UNPAD | Riwayat Peminjaman 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Riwayat Pemnijaman</strong>
	  </li>
</ol>
@stop
@section('head') 
@stop
@section('content') 
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Riwayat Pemnijaman</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered DT">
				<thead>
					<tr>
						<th>Nama Buku</th>
						<th>Nama Peminjam</th>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Kembalikan</th>
						<th>Konfirmasi</th>
					</tr>
				</thead>
				<tbody>
					@if($pinjams->count() > 0)
						@foreach($pinjams as $pinjam)
							<tr>
								<td>{{ $pinjam->perpus->nama_buku }}</td>
								<td>{{ $pinjam->peminjam->nama }}</td>
								<td>{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
								<td>
									@if(!is_null($pinjam->tanggal_kembalikan))	
										{{ $pinjam->tanggal_kembalikan->format('d M Y') }}
									@endif
								</td>
								<td>
									@if($pinjam->confirm)
										<button class="btn btn-info btn-xs" type="button">Confimed</button>
									@else
										<button class="btn btn-warning btn-xs" type="button">Unconfimed</button>
									@endif
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center">
								Tidak ada data untuk ditampilkan
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('footer') 
@stop

