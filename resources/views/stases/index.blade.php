@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Stase

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Stase</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Stase</strong>
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
							Stase
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('stases/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Stase Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered DT">
							<thead>
								<tr>
									<th>id</th>
									<th>Nama Residen</th>
									<th>Stase</th>
									<th>Periode Bulan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($stases->count() > 0)
									@foreach($stases as $stase)
										<tr>
											<td>{{ $stase->id }}</td>
											<td>{{ $stase->user->nama }}</td>
											<td>{{ $stase->jenisStase->jenis_stase }}</td>
											<td>{{ $stase->mulai->format('M Y') }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'stases/' . $stase->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('stases/' . $stase->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Stase Ini?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="7">
											{!! Form::open(['url' => 'stases/imports', 'method' => 'post', 'files' => 'true']) !!}
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
		</div>
	</div>
@stop
@section('footer') 
	
@stop

