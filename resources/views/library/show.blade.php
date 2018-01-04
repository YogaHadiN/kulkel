@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP

@stop
@section('page-title') 
<h2>Detail Buku</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('library')}}">Perpustakaan</a>
	  </li>
	  <li class="active">
		  <strong>{{ $buku->nama_buku }}</strong>
	  </li>
</ol>
@stop
@section('head') 
	<style type="text/css" media="all">
		table th:nth-child(1), td:nth-child(1){
			width:40%;
		}
	</style>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>{{ $buku->nama_buku }}</h1>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<tbody>
								<tr>
									<th class="text-left">Buku ID</th>
									<td>{{ $buku->nomor_buku }}</td>
								</tr>
								<tr>
									<th class="text-left">Pengarang</th>
									<td>{{ $buku->pengarang }}</td>
								</tr>
								<tr>
									<th class="text-left">Tahun Terbit</th>
									<td>{{ $buku->terbit }}</td>
								</tr>
							</tbody>
						</table>
					</div>

					@if( \Auth::user()->role_id == '3' )
						<div class="row">
							{!! Form::open(['url' => 'library/'. $buku->id, 'method' => 'delete']) !!}
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									@if( $masih_dipinjam )
										<a disabled class="btn btn-primary btn-block" href="{{ url('library/pinjam/' . $buku->id) }}">Masih Dipinjam</a>
									@else
										<a class="btn btn-primary btn-block" href="{{ url('library/pinjam/' . $buku->id) }}">Pinjam</a>
									@endif
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<a class="btn btn-danger btn-block" href="{{ url('library') }}">Cancel</a>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<a href="{{ url('library/' . $buku->id . '/edit') }}" class="btn btn-warning btn-block">Edit</a>
								</div>
							{!! Form::close() !!}
						</div>
					@else
						<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<a class="btn btn-danger btn-block" href="{{ url('library') }}">Cancel</a>
								</div>
							{!! Form::close() !!}
						</div>
					@endif
					
				</div>

			</div>
		</div>
	</div>
	@if( \Auth::user()->role_id == '3' )
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Riwayat Peminjaman</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Nama Peminjam</th>
										<th>Nama Admin</th>
										<th>Nama Admin Kembalikan</th>
										<th>Tanggal Pinjam</th>
										<th>Perkiraan Tanggal Kembali</th>
										<th>Tanggal Kembali</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if($pinjam->count() > 0)
										@foreach($pinjam as $p)
											<tr
												 @if( is_null($p->admin_kembalikan_id) )
												class="danger"	
												@endif
											>
												<td>{{ $p->peminjam->nama }}</td>
												<td>{{ $p->admin->nama }}</td>
												<td>
													@if( !is_null($p->admin_kembalikan_id))
														{{ $p->adminKembalikan->nama }}
													@else
														Belum admin
													@endif
												</td>
												<td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
												<td>{{ $p->perkiraan_tanggal_kembalikan_format }}</td>
												<td>
													@if( !is_null($p->tanggal_kembalikan) )
														{{ $p->tanggal_kembalikan_format }}
													@else
														Belum
													@endif
												</td>
												<td> 
													@if(is_null($p->tanggal_kembalikan))
														<a class="btn btn-primary btn-xs" href="{{ url('library/kembalikan/' . $p->id) }}">Kembalikan</a> 
													@endif
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4" class="text-center">
												Tidak ada data ditemukan :p
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Riwayat Peminjaman oleh {{ \Auth::user()->nama }}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>Nama Peminjam</th>
									<th>Nama Admin</th>
									<th>Tanggal Pinjam</th>
									<th>Tanggal Kembali</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($pinjam_by_user->count() > 0)
									@foreach($pinjam_by_user as $p)
										<tr
											 @if( is_null($p->admin_kembalikan_id) )
											class="danger"	
											@endif
										>
											<td>{{ $p->peminjam->nama }}</td>
											<td>{{ $p->admin->nama }}</td>
											<td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
											<td>{{ $p->tanggal_kembalikan }}</td>
											<td> 
												@if(is_null($p->tanggal_kembalikan))
													<a class="btn btn-primary btn-xs" href="{{ url('library/kembalikan/' . $p->id) }}">Kembalikan</a> 
												@endif
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4" class="text-center">
											Tidak ada data ditemukan :p
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

