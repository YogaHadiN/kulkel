@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Pembacaan

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Pembacaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	<li>
		  <a href="{{ url('pembacaans')}}">Pembacaan</a>
	  </li>
	  <li class="active">
		  <strong>{{ $pembacaan->judul }}</strong>
	  </li>
</ol>

@stop
@section('content') 
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<h1>{{ $pembacaan->judul }} ( {{ $pembacaan->jenisPembacaan->jenis_pembacaan }} )</h1>
		<h3>Tanggal</h3>
		<p>{{ $pembacaan->tanggal->format('d M y') }}</p>
		<h3>Presentan</h3>
		<p>{{ $pembacaan->user->nama }}</p>
		<h3>Moderator</h3>
		<ul>
			@foreach($pembacaan->moderator as $moderator)	
				<li>{{ $moderator->user->nama }}</li>	
			@endforeach
		</ul>
		<h3>Pembahas</h3>
		<ul>
			@foreach($pembacaan->pembahas as $pembahas)	
				<li>{{ $pembahas->user->nama }}</li>	
			@endforeach
		</ul>
		<h3>DOI</h3>
		<p>{{ $pembacaan->doi }}</p>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<tbody>
					<tr>
						<td>Materi</td>
						<td>{{ $pembacaan->link_materi }}</td>
						<td> <a class="btn btn-info btn-lg" href="{{ $pembacaan->link_materi }}"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a> </td>
					</tr>
					@if(
						$pembacaan->jenis_pembacaan_id == 1 ||
						$pembacaan->jenis_pembacaan_id == 5
						)
					<tr>
						<td>Terjemahan</td>
						<td>{{ $pembacaan->link_materi_terjemahan }}</td>
						<td> <a class="btn btn-info btn-lg" href="{{ $pembacaan->link_materi_terjemahan }}"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a> </td>
					</tr>
					@endif
					<tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		  <img class="full-width" src="{!! url( 'qrcode?text=' . urlencode($pembacaan->link_materi) ) !!}" alt="">
	</div>
</div>
@stop
@section('footer') 
	
@stop

