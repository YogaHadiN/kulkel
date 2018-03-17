@extends('layouts.master')
@section('page-title') 
	<h2>	Kulkel UNDIP | {{ $seminar->seminar }}</h2>
	<ol class="breadcrumb">
		  <li>
			  <a href="{{ url('laporans')}}">Home</a>
		  </li>
			<li>
			  <a href="{{ url('seminars')}}">Seminar</a>
		  </li>
		  <li class="active">
			  <strong>{{ $seminar->seminar }}</strong>
		  </li>
	</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Detail Seminar</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<tbody>
						<tr>
							<th>Seminar</th>
							<td>{{ $seminar->seminar }}</td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td>{{ $seminar->lokasi }}</td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td>{{ $seminar->tanggal }}</td>
						</tr>
						<tr>
							<th>Password</th>
							<td>{{ $seminar->password }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Topik
				</div>
				<div class="panelRight">
					<a class="btn btn-success btn-sm" href="{{ url('topiks/create/' . $seminar->id) }}"><i class="fa fa-plus" aria-hidden="true"></i> Topik</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Topik</th>
							<th>Pembicara</th>
							<th>Jam Mulai</th>
							<th>Jam Selesai</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($topiks->count() > 0)
							@foreach($topiks as $topik)
								<tr>
									<td>{{ $topik->id }}</td>
									<td> <a class="" href="{{ $topik->link_materi }}">{{ $topik->topik }}</a> </td>
									<td>{{ $topik->pembicara }}</td>
									<td>{{ $topik->jam_mulai }}</td>
									<td>{{ $topik->jam_selesai }}</td>
									<td nowrap class="autofit"> 
										{!! Form::open(['url' => 'topiks/' .$topik->id, 'method' => 'delete']) !!}
											<a class="btn btn-info btn-xs" href="{{ $topik->link_materi }}"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
											<a class="btn btn-success btn-xs" href="{{ url('topiks/' . $topik->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											{{ Form::submit('del', [
												'class'   => 'btn btn-danger btn-xs',
												'onclick' => 'return confirm("Anda yakin mau menghapus ' . $topik->id . '-' . $topik->name.'?");return false;'
											]) }}
										{!! Form::close() !!}
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

