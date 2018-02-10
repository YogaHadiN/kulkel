@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Gardenia

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Gardenia</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Gardenia</strong>
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
							Gardenia
						</div>	
						<div class="panelRight">
							<a class="btn btn-primary btn-sm" href="{{ url('gardenias/create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> Gardenia Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						{{ $gardenias->links() }}
						<table class="table table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Nama Residen</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($gardenias->count() > 0)
									@foreach($gardenias as $gardenia)
										<tr>
											<td>{{ $gardenia->tanggal->format('d M Y') }}</td>
											<td>{{ $gardenia->user->nama }}</td>
											<td nowrap class="autofit">
												{!! Form::open(['url' => 'gardenias/' . $gardenia->id, 'method' => 'delete']) !!}
													<a class="btn btn-warning btn-sm" href="{{ url('gardenias/' . $gardenia->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus jadwal {{ $gardenia->user->nama }} di Gardenia tanggal {{ $gardenia->tanggal->format('d M Y') }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
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
						{{ $gardenias->links() }}
					</div>
					
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

