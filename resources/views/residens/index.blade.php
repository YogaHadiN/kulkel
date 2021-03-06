@extends('layouts.master')

@section('title') 
Kulkel Undip | Residen

@stop
@section('page-title') 
<h2>Residen</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Residen</strong>
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
							
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('residens/create') }}">Create</a>
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
									<th>Alamat Asal</th>
									<th>Alamat Semarang</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($residens->count() > 0)
									@foreach($residens as $residen)
										<tr>
											<td>{{ $residen->id }}</td>
											<td>{{ $residen->nama }}</td>
											<td>{{ $residen->tanggal_lahir->format('d M Y') }}</td>
											<td>{{ $residen->alamat_asal }}</td>
											<td>{{ $residen->alamat_semarang }}</td>
											<td nowrap> 
												<a class="btn btn-success btn-sm" href="{{ url('residens/' . $residen->id) }}">Show</a>
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

