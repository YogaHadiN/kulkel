@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Ebooks

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Ebooks</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Ebooks</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Daftar Ebook
				</div>
				<div class="panelRight">
					<a class="btn btn-primary btn-sm" href="{{ url('ebooks/create') }}">
						<i class="fa fa-plus" aria-hidden="true"></i> Ebook
					</a>	
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered DT">
					<thead>
						<tr>
							<th>Judul Ebook</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($ebooks->count() > 0)
							@foreach($ebooks as $ebook)
								<tr>
									<td>{{ $ebook->judul }}</td>
									<td> 
										{!! Form::open(['url' => 'ebooks/' .$ebook->id, 'method' => 'delete']) !!}
											<a class="btn btn-primary btn-xs" href="{{ $ebook->link_materi }}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
											{!! Form::submit('del', [
												'class'   => 'btn btn-danger btn-xs',
												'onclick' => 'return confirm("Anda yakin mau menghapus ' . $ebook->id . '-' . $ebook->judul.'?");return false;'
											]) !!}
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'ebooks/imports', 'method' => 'post', 'files' => 'true']) !!}
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
@stop
@section('footer') 
	
@stop

