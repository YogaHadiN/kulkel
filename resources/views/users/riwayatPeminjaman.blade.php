@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Riwayat Peminjaman {{ $user->nama }}

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Riwayat Peminjaman</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Riwayat Peminjaman {{ $user->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				Riwayat Peminjaman
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Nama Buku</th>
							<th>Tanggal Pinjam</th>
							<th>Tanggal Kembalikan</th>
							<th>Nama Admin</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($pinjams->count() > 0)
							@foreach($pinjams as $pinjam)
								<tr>
									<td>{{ $pinjam->perpus->nama_buku }}</td>
									<td>{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
									<td>
									@if(!is_null($pinjam->tanggal_kembalikan))	
										{{ $pinjam->tanggal_kembalikan->format('d M Y') }}
									@else
										<i>Belum Dikembalikan</i>
									@endif
									</td>
									<td>{{ $pinjam->admin->nama }}</td>
									<td nowrap class="autofit">
										<a class="btn btn-info btn-xs"  disabled href="#">Show</a>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5" class="text-center">Tidak ada data untuk ditampilkan :p</td>
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

