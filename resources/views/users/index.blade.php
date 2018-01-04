@extends('layouts.master')

@section('title') 
Kulkel Undip | User 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>User</strong>
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

							<a class="btn btn-success btn-sm" href="{{ url('users/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> User Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Role</th>
									<th>Alamat Semarang</th>
									<th>No Telp</th>
									<th>Control</th>
								</tr>
							</thead>
							<tbody>
								@if($users->count() > 0)
									@foreach($users as $user)
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->nama }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->role->role }}</td>
											<td>{{ $user->alamat_semarang }}</td>
											<td>
												<ul>
													@foreach($user->no_telps as $no_telp)	
														<li>{{ $no_telp->jenisTelpon->jenis_telpon }} : {{ $no_telp->no_telp }}</li>
													@endforeach
												</ul>
											</td>
											<td> 
												<a class="btn btn-success btn-sm" href="{{ url('users/' . $user->id ) }}">Show</a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="7" class="text-center">
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

