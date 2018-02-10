@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Rsnd

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Rsnd</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Rsnd</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							RSND
						</div>
						<div class="panelRight">
							<a class="btn btn-primary btn-sm" href="{{ url('rsnds/create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> Rsnd</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						{{ $rsnds->links() }}
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Nama Residen</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($rsnds->count() > 0)
									@foreach($rsnds as $rsnd)
										<tr>
											<td>{{ $rsnd->tanggal->format('d M Y') }}</td>
											<td>{{ $rsnd->user->nama }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'rsnds/' . $rsnd->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('rsnds/' . $rsnd->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus jadwal {{ $rsnd->user->nama }} di Gardenia tanggal {{ $rsnd->tanggal->format('d M Y') }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="3" class="text-center">Tidak ada Data untuk ditampilkan</td>
									</tr>
								@endif
							</tbody>
						</table>
						{{ $rsnds->links() }}
					</div>
					
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

