@extends('layouts.master')

@section('title') 
Kulkel Undip | Events

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Event</strong>
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
						Event
					</div>
					<div class="panelRight">
						<a class="btn btn-primary btn-sm" href="{{ url('events/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Event</a>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>id</th>
								<th>Title</th>
								<th>Body</th>
								<th>Author</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if($events->count() > 0)
								@foreach($events as $event)
									<tr>
										<td>{{ $event->id }}</td>
										<td>{{ $event->title }}</td>
										<td>
											@foreach(json_decode($event->body, true) as $body)	
												<p>{{ $body }}</p>
											@endforeach
										</td>
										<td>{{ $event->author }}</td>
										<td nowrap class="autofit">
											{!! Form::open(['url' => 'events/' . $event->id, 'method' => 'delete']) !!}
												<a class="btn btn-warning btn-sm" href="{{ url('events/' . $event->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
												<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5">
										{!! Form::open(['url' => 'events/imports', 'method' => 'post', 'files' => 'true']) !!}
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
				</div>
				
			</div>
		</div>
	</div>
</div>
@stop
@section('footer') 
	
@stop

