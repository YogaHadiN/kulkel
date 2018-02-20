@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Anggota Sub Bagian

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Anggota Sub Bagian</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Anggota Sub Bagian</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Anggota Sub Bagian
				</div>
				<div class="panelRight">
			<a class="btn btn-primary" href="{{ url('sub_bagians/create') }}">
				<i class="fa fa-plus" aria-hidden="true"></i> Anggota Sub Bagian
				</a>	
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Sub Bagian</th>
							<th>Anggota</th>
							<th>Penguji Tambahan</th>
						</tr>
					</thead>
					<tbody>
						@if(count($subs) > 0)
							@foreach($subs as $k => $sub_bagian)
								<tr>
									<td>{{ $k + 1 }}</td>
									<td>{{ $sub_bagian['nama_stase'] }}</td>
									<td>
										<ul>
											@foreach($sub_bagian['pengujis'] as $penguji)	
												<li>
													<a class="" href="{{ url('sub_bagians/' . $penguji['sub_bagian_id'] . '/edit') }}">
														 {{ $penguji['nama'] }}
													</a>
													@if( $penguji['penguji'] == '4' )
														<strong>( Ka Sub Bag )</strong>
													@elseif( $penguji['penguji'] == '2' )
														<strong>( penguji )</strong>
													@endif
												</li>
											@endforeach
										</ul>
									</td>
									<td>
										<ul>
											@foreach($sub_bagian['pengujis'] as $penguji)	
													@if( $penguji['penguji'] == '3' )
													<a class="" href="{{ url('sub_bagians/' . $penguji['sub_bagian_id'] . '/edit') }}">
														 {{ $penguji['nama'] }}
													</a>
													@endif
											@endforeach
										</ul>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="4" class="text-center">
									Tidak ada data untuk ditampilkan :p
								</td>
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

