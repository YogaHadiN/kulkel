@extends('layouts.master')
@section('page-title') 
	<h2>	Kulkel UNDIP | {{ $seminar->seminar }}</h2>
	<ol class="breadcrumb">
		  <li>
			  <a href="{{ url('laporans')}}">Home</a>
		  </li>
			<li>
			  <a href="{{ url('seminars')}}">Seminar</a>
		  </li>
		  <li class="active">
			  <strong>{{ $seminar->seminar }}</strong>
		  </li>
	</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Detail Seminar
				</div>
				<div class="panelRight">
					<a class="btn btn-info" href="{{ url('seminars/' . $seminar->id .'/doorprize') }}"> Doorprize</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<tbody>
						<tr>
							<th>Seminar</th>
							<td>{{ $seminar->seminar }}</td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td>{{ $seminar->lokasi }}</td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td>{{ $seminar->tanggal->format('d M Y') }}</td>
						</tr>
						<tr>
							<th>Link Materi</th>
							<td>{{ $seminar->link_materi }}</td>
						</tr>
						<tr>
							<th>Link First Announcement</th>
							<td>{{ $seminar->link_first_announcement }}</td>
						</tr>
						<tr>
							<th>Link Final Announcement</th>
							<td>{{ $seminar->link_final_announcement }}</td>
						</tr>
						<tr>
							<th>Password</th>
							<td>{{ $seminar->password }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div>
	
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#topik_seminar" aria-controls="" role="tab" data-toggle="tab">Topik</a></li>
		<li role="presentation"><a href="#peserta" aria-controls="" role="tab" data-toggle="tab">Peserta</a></li>
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="topik_seminar">
			@include('seminars.topik')
		</div>
		<div role="tabpanel" class="tab-pane" id="peserta">
			@include('seminars.peserta')
		</div>
	  </div>
	</div>
<!-- Modal -->
@foreach($topiks as $topik)
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">{{ $topik->judul }}</h4>
      </div>
      <div class="modal-body text-center">
		  <img src="{!! url( 'qrcode?text=' . $topik->link_materi ) !!}" alt="">
		  <div>
			  {{ $topik->link_materi }}
		  </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@stop
@section('footer') 
	
@stop

