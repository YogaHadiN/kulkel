@extends('layouts.master')

@section('title') 
Kulkel Undip | Poli 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Poli</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Data User
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('polis/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Jadwal Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>id</th>
									<th>Nama</th>
									<th>Jaga</th>
									<th>Tanggal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($polis->count() > 0)
									@foreach($polis as $poli)
										<tr>
											<td>{{ $poli->id }}</td>
											<td>{{ $poli->user->nama }}</td>
											<td>{{ $poli->jaga->jaga }}</td>
											<td>{{ $poli->tanggal->format('d M Y') }}</td>
											<td> 
												{!! Form::open(['url' => 'polis/' . $poli->id, 'method' => 'delete']) !!}
														<a class="btn btn-success btn-sm" href="{{ url('polis/' . $poli->id . '/edit' ) }}">Edit</a>
														<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('yakin mau hapus jadwal ini?'); return false;"> Delete</button>
												</div>

												{!! Form::close() !!}
												
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5" class="text-center">
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
@stop
@section('footer') 
	
@stop

