@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Seminars

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Seminars</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Seminars</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Seminars
				</div>
				<div class="panelRight">
					<a class="btn btn-success btn-sm" href="{{ url('seminars/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Seminar</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Seminar</th>
							<th>Lokasi</th>
							<th>Tanggal</th>
							<th>Password</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($seminars->count() > 0)
							@foreach($seminars as $seminar)
								<tr>
									<td>{{ $seminar->id }}</td>
									<td>{{ $seminar->seminar }}</td>
									<td>{{ $seminar->lokasi }}</td>
									<td>{{ $seminar->tanggal->format('d M Y') }}</td>
									<td>{{ $seminar->password }}</td>
									<td nowrap class="autofit"> 
										{!! Form::open(['url' => 'seminars/' .$seminar->id, 'method' => 'delete']) !!}
											<a class="btn btn-success btn-xs" href="{{ url('seminars/' . $seminar->id . '/edit') }}">Edit</a>
											<a class="btn btn-primary btn-xs" href="{{ url('seminars/' . $seminar->id) }}">Show</a>
											{!! Form::submit('Delete', [
												'class'   => 'btn btn-danger btn-xs',
												'onclick' => 'return confirm("Anda yakin mau menghapus ' . $seminar->id . '-' . $seminar->name.'?");return false;'
											]) !!}
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
@stop
@section('footer') 
	
@stop

