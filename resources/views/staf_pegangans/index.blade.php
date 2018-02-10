@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Staf Pegangan

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Staf Pegangan</strong>
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
							Staf Pegangan
						</div>
						<div class="panelRight">
							<a class="btn btn-success" href="{{ url('pegangans/staf/create') }}">Buat Staf Pegangan Baru</a>
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
									<th>Nama User</th>
									<th>Nama Residen</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($pegangans->count() > 0)
									@foreach($pegangans as $staf)
										<tr>
											<td>{{ $staf->id }}</td>
											<td>{{ $staf->user->nama }}</td>
											<td>{{ $staf->staf->nama }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'pegangans/staf/' . $staf->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('pegangans/staf/' . $staf->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4">
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

