@extends('layouts.master')

@section('title') 
Kulkel Undip | Dosen

@stop
@section('page-title') 
<h2>Dosen</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Dosen</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Data Dosen
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('dosens/create') }}"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>id</th>
									<th>name</th>
									<th>Tanggal Lahir</th>
									<th>NIP</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($dosens->count() > 0)
									@foreach($dosens as $dosen)
										<tr>
											<td>{{ $dosen->id }}</td>
											<td>{{ $dosen->name }}</td>
											<td>{{ $dosen->tanggal_lahir }}</td>
											<td>{{ $dosen->nip }}</td>
											<td> 
												{!! Form::open(['url' => 'dosens/' .$dosen->id, 'method' => 'delete']) !!}
													<a class="btn btn-primary btn-xs" href="{{ url('dosens/' . $dosen->id) }}">Show</a>
													<a class="btn btn-success btn-xs" href="{{ url('dosens/' . $dosen->id . '/edit') }}">Edit</a>
													{!! Form::submit('Delete', [
														'class'   => 'btn btn-danger btn-xs',
														'onclick' => 'return confirm("Anda yakin mau menghapus ' . $dosen->id . '-' . $dosen->name.'?");return false;'
													]) !!}
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="">
											{!! Form::open(['url' => 'dosens/imports', 'method' => 'post', 'files' => 'true']) !!}
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

