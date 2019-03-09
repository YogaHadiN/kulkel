@extends('layout.master')

@section('title') 
Klinik Jati Elok | Peserta

@stop
@section('page-title') 
<h2>Peserta</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Peserta</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Peserta
				</div>	
				<div class="panelRight">
					<a class="btn btn-success btn-sm" href="{{ url('pesertas/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Peserta</a>
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
							<th>No Telp</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($pesertas->count() > 0)
							@foreach($pesertas as $peserta)
								<tr>
									<td>{{ $peserta->id }}</td>
									<td>{{ $peserta->nama }}</td>
									<td>{{ $peserta->no_telp }}</td>
									<td>{{ $peserta->email }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'pesertas/' . $peserta->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('pesertas/' . $peserta->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ peserta->id }} - {{ peserta-> }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'pesertas/imports', 'method' => 'post', 'files' => 'true']) !!}
										<div class="form-group">
											{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
											{!! Form::file('file') !!}
											{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
										</div>
									{!! Form::close() !!}
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

