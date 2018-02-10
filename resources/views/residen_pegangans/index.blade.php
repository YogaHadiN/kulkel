@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Residen Pegangan

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Residen Pegangan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Residen Pegangan</strong>
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
							Residen Pegangan
						</div>
						<div class="panelRight">
							<a class="btn btn-success" href="{{ url('pegangans/residen/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Residen Pegangan Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						{{ $pegangans->links() }}
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>id</th>
									<th>Nama</th>
									<th>Residen Pegangan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($pegangans->count() > 0)
									@foreach($pegangans as $pegangan)
										<tr>
											<td>{{ $pegangan->id }}</td>
											<td>{{ $pegangan->user->nama }}</td>
											<td>{{ $pegangan->residen->nama }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'pegangans/residen/' . $pegangan->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('pegangans/residen/' . $pegangan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $pegangan->residen->nama }} sebagai pegangan dari {{ $pegangan->user->nama }}?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5">
											{!! Form::open(['url' => 'pegangans/imports', 'method' => 'post', 'files' => 'true']) !!}
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
						{{ $pegangans->links() }}
					</div>
					
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

