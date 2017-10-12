@extends('layouts.master')

@section('title') 
Kulkel Undip | Karyawan

@stop
@section('page-title') 
<h2>Dosen</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Karyawan</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Data Dosen</h3>
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
								@if($karyawans->count() > 0)
									@foreach($karyawans as $karyawan)
										<tr>
											<td>{{ $karyawan->id }}</td>
											<td>{{ $karyawan->name }}</td>
											<td>{{ $karyawan->tanggal_lahir }}</td>
											<td>{{ $karyawan->nik }}</td>
											<td> 
												{!! Form::open(['url' => 'karyawans/' .$karyawan->id, 'method' => 'delete']) !!}
													<a class="btn btn-success btn-xs" href="{{ url('karyawans/' . $karyawan->id . '/edit') }}">Edit</a>
													{!! Form::submit('Delete', [
														'class'   => 'btn btn-danger btn-xs',
														'onclick' => 'return confirm("Anda yakin mau menghapus ' . $karyawan->id . '-' . $karyawan->name.'?");return false;'
													]) !!}
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5" class=text-center>Tidak Ada Data Untuk Ditampilkan</td>
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

