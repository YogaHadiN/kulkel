@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Ujian
@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Ujian</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Ujian</strong>
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
							Ujian
						</div>
						<div class="panelRight">
							<a class="btn btn-success" href="{{ url('ujians/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Ujian Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Penguji</th>
									<th>Materi</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($ujians->count() > 0)
									@foreach($ujians as $ujian)
										<tr>
											<td>{{ $ujian->user->nama }}</td>
											<td>{{ $ujian->tanggal->format('d M Y') }}</td>
											<td>
												<ul>
													@foreach($ujian->penguji as $penguji)	
														<li>{{ $penguji->user->nama }}</li>
													@endforeach
													
												</ul>
											</td>
											<td>{{ $ujian->materi }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'ujians/' . $ujian->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('ujians/' . $ujian->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus ini?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5">
											{!! Form::open(['url' => 'ujians/imports', 'method' => 'post', 'files' => 'true']) !!}
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

