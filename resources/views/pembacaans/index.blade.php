@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Pembacaan

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Pembacaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Pembacaan</strong>
	  </li>
</ol>

@stop
@section('content') 
<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Pembacaan
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('pembacaans/create') }}"><i class="icon-plus"></i>  Buat Pembacaan Baru</a>	
						</div>
					</h3>
				</div>
				<div class="panel-body">
					{{-- {{ $pembacaans->links() }} --}}
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered DT">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Presentan</th>
									<th>Judul</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($pembacaans->count() > 0)
									@foreach($pembacaans as $pembacaan)
										<tr>
											<td>{{ $pembacaan->tanggal->format('d M y') }}</td>
											<td>{{ $pembacaan->user->nama }}</td>
											<td>{{ $pembacaan->judul }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'pembacaans/' . $pembacaan->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('pembacaans/' . $pembacaan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $pembacaan->id }} - {{ $pembacaan->judul }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="">
											{!! Form::open(['url' => 'pembacaans/imports', 'method' => 'post', 'files' => 'true']) !!}
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
					{{-- {{ $pembacaans->links() }} --}}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

