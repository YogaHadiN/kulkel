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
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Data User
						</div>
						{{-- <div class="panelRight"> --}}
						{{-- 	<a class="btn btn-primary btn-sm" href="{{ url('users/create') }}"><i class="fa fa-plus"></i> Tambah</a> --}}
						{{-- </div> --}}
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
									<th>Control</th>
								</tr>
							</thead>
							<tbody>
								@if($users->count() > 0)
									@foreach($users as $user)
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td> 
												{!! Form::open(['url' => 'users/' .$user->id, 'method' => 'delete']) !!}
													<a class="btn btn-success btn-xs" href="{{ url('users/' . $user->id . '/edit') }}">Edit</a>
													{!! Form::submit('Delete', [
														'class'   => 'btn btn-danger btn-xs',
														'onclick' => 'return confirm("Anda yakin mau menghapus ' . $user->id . '-' . $user->name.'?");return false;'
													]) !!}
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4" class="text-center">
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

