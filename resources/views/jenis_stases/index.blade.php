@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Jenis Stase

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Jenis Stase</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Jenis Stase</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Jenis Stase</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Jenis Stase</th>
							<th>Lama</th>
						</tr>
					</thead>
					<tbody>
						@if($jenis_stases->count() > 0)
							@foreach($jenis_stases as $jenis_stase)
								<tr>
									<td>{{ $jenis_stase->jenis_stase }}</td>
									<td>{{ $jenis_stase->bulan }} bulan</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2" class="text-center">Tidak ada data untuk ditampilkan</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
@stop
@section('footer') 
	
@stop

