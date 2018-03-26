@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Video Interaktif

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Video Interaktif</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Video Interaktif</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Video Interaktif
				</div>
				<div class="panelRight">
					<a class="btn btn-info" href="{{ url('videos/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Video</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered DT">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($videos->count() > 0)
							@foreach($videos as $video)
								<tr>
									<td>{{ $video->judul }}</td>
									<td> 
										{!! Form::open(['url' => 'videos/' .$video->id, 'method' => 'delete']) !!}
											<a class="btn btn-primary btn-xs" href="{{ $video->link_materi }}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
											{!! Form::submit('del', [
												'class'   => 'btn btn-danger btn-xs',
												'onclick' => 'return confirm("Anda yakin mau menghapus ' . $video->id . '-' . $video->judul.'?");return false;'
											]) !!}
										{!! Form::close() !!}
									</td>
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

