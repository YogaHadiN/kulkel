@extends('layouts.master')

@section('title') 
	Kulkel Undip | Residen {{ $residen->nama }} 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('residens')}}">Residen</a>
	  </li>
	  <li class="active">
		  <strong>{{ $residen->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ $residen->nama }}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<tbody>
								<tr>
									<td class="autofit-col bold-sm">Nama</td>
									<td>{{ $residen->nama }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Tanggal Lahir</td>
									<td>{{ $residen->tanggal_lahir->format('d-M-Y') }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Tempat Lahir</td>
									<td>{{ $residen->tempat_lahir }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Bulan Masuk PPDS</td>
									<td>{{ $residen->bulan_masuk_ppds->format('M Y') }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Alamat Asal</td>
									<td>{{ $residen->alamat_asal }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Alamat Semarang</td>
									<td>{{ $residen->alamat_semarang }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Nama Pasangan</td>
									<td>{{ $residen->nama_pasangan }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Nomor KTP</td>
									<td>{{ $residen->no_ktp }}</td>
								</tr>
								<tr>
									<td class="autofit-col bold-sm">Judul Thesis</td>
									<td>{{ $residen->judul_thesis }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>Jenis Telpon</th>
									<th>Nomor Telpon</th>
								</tr>
							</thead>
							<tbody>
								@if($residen->no_telps->count() > 0)
									@foreach($residen->no_telps as $telp)
										<tr>
											<td>{{ $telp->jenisTelpon['jenis_telpon'] }}</td>
											<td>{{ $telp->no_telp }}</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="text-center" colspan="2">
											Tidak ada Nomor telpon terdaftar 
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Nama Anak</th>
									</tr>
								</thead>
								<tbody>
									@if($residen->anaks->count() > 0)
										@foreach($residen->anaks as $anak)
											<tr>
												<td>{{ $anak->nama }}</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td class="text-center" colspan="2">
												Tidak ada Nomor telpon terdaftar 
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
	</div>
@stop
@section('footer') 
	
@stop

