@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP

@stop
@section('page-title') 
<h2>Detil User</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('users')}}">User</a>
	  </li>
	  <li class="active">
		  <strong>{{ $user->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Detil {{ $user->role->role }}</a></li>
    <li role="presentation"><a href="#stase" aria-controls="stase" role="tab" data-toggle="tab">Stase</a></li>
    <li role="presentation"><a href="#pembacaan" aria-controls="pembacaan" role="tab" data-toggle="tab">Pembacaan</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{ $user->nama }}</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<tbody>
									<tr>
										<th class="text-left">Nama</th>
										<td>{{ $user->nama }}</td>
									</tr>
									<tr>
										<th class="text-left">Inisial</th>
										<td>{{ $user->inisial }}</td>
									</tr>
									<tr>
										<th class="text-left">Role</th>
										<td>{{ $user->role->role }}</td>
									</tr>
									<tr>
										<th class="text-left">Tanggal Lahir</th>
										<td>{{ $user->tanggal_lahir_format }}</td>
									</tr>
									<tr>
										<th class="text-left">Tempat Lahir</th>
										<td>{{ $user->tempat_lahir }}</td>
									</tr>
									<tr>
										<th class="text-left">Email</th>
										<td>{{ $user->email }}</td>
									</tr>
									<tr>
										<th class="text-left">No KTP</th>
										<td>{{ $user->no_ktp }}</td>
									</tr>
									<tr>
										<th class="text-left">Bulan Masuk PPDS</th>
										<td>{{ $user->bulan_masuk_ppds_format }}</td>
									</tr>
									<tr>
										<th class="text-left">Alamat Semarang</th>
										<td>{{ $user->alamat_semarang }}</td>
									</tr>
									<tr>
										<th class="text-left">Alamat Asal</th>
										<td>{{ $user->alamat_asal }}</td>
									</tr>
									<tr>
										<th class="text-left">No Telp</th>
										<td>
											<ul>
												@foreach($user->no_telps as $no_telp)	
													<li>{{ $no_telp->no_telp }}</li>
												@endforeach
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-primary btn-sm btn-block" href="{{ url('users/' . $user->id . '/edit') }}">Edit</a>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-danger btn-block" href="{{ url('users') }}">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
</div>
    <div role="tabpanel" class="tab-pane" id="stase">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Stase
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Stase</th>
								<th>Mulai</th>
								<th>Akhir</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ as $stase)
								<tr>
									<td>{{ $stase->stase }}</td>
									<td>
										{!! Form::text('mulai[]', null, ['class' => 'form-control bulanTahun']) !!}
									</td>	
									<td>
										{!! Form::text('akhir[]', null, ['class' => 'form-control bulanTahun']) !!}
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								
							</tr>
						</tfoot>
					</table>
				</div>
				
			</div>
		</div>
	
	</div>
    <div role="tabpanel" class="tab-pane" id="pembacaan">
	
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Pembacaan Sudah</h3>
					</div>
					<div class="panel-body">
						
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Judul</th>
										<th>Pembahas</th>
										<th>Moderator</th>
									</tr>
								</thead>
								<tbody>
									@if(count($pembacaans_sudah) > 0)
										@foreach($pembacaans_sudah as $pembacaan)
											<tr>
												<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
												<td>{{ $pembacaan->judul }}</td>
												<td>
													<ul>
														@foreach($pembacaan->pembahas as $pembahas)	
															<li>{{ $pembahas->user->inisial }}</li>
														@endforeach
													</ul>
												</td>
												<td>
													<ul>
														@foreach($pembacaan->moderator as $moderator)	
															<li>{{ $moderator->user->nama }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4">
												Tidak ada data untuk ditampilkan
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Pembacaan Belum</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Pembahas</th>
										<th>Moderator</th>
									</tr>
								</thead>
								<tbody>
									@if(count($pembacaans_belum) > 0)
										@foreach($pembacaans_belum as $pembacaan)
											<tr>
												<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
												<td>
													<ul>
														@foreach($pembacaan->pembahas as $pembahas)	
															<li>{{ $pembahas->user->inisial }}</li>
														@endforeach
													</ul>
												</td>
												<td>
													<ul>
														@foreach($pembacaan->moderator as $moderator)	
															<li>{{ $moderator->user->nama }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4">
												Tidak ada data untuk ditampilkan
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
  </div>
</div>

	
@stop
@section('footer') 
	
@stop

