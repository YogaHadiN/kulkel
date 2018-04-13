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
	  <li class="active">
		  <strong>	Kulkel UNDIP | Pembacaan</strong>
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
							Pembacaan
						</div>
						<div class="panelRight">
							<a class="btn btn-success btn-sm" href="{{ url('pembacaans/create') }}"><i class="icon-plus"></i>  Buat Pembacaan Baru</a>	
						</div>
					</h3>
				</div>
				<div class="panel-body">
					{{-- {{ $pembacaans->links() }} --}}
					@include('pembacaans.pembacaan')
					{{-- {{ $pembacaans->links() }} --}}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

