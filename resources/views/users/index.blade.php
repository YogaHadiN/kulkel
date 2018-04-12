@extends('layouts.master')

@section('title') 
Kulkel Undip | User 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>User</strong>
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
							Data User
						</div>
						<div class="panelRight">

							<a class="btn btn-success btn-sm" href="{{ url('users/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> User Baru</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					<div>
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#residens" aria-controls="residens" role="tab" data-toggle="tab">Residen ({{ count($residens) }})</a></li>
						<li role="presentation"><a href="#dosens" aria-controls="dosens" role="tab" data-toggle="tab">Dosen ({{ count($dosens) }})</a></li>
						<li role="presentation"><a href="#admins" aria-controls="admins" role="tab" data-toggle="tab">Admin ({{ count( $admins ) }})</a></li>
						<li role="presentation"><a href="#keluar" aria-controls="keluar" role="tab" data-toggle="tab">Keluar ({{ count( $keluar ) }})</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="residens">
							@include('users.table', ['users' => $residens])
						</div>
						<div role="tabpanel" class="tab-pane" id="dosens">
							@include('users.table', ['users' => $dosens])
						</div>
						<div role="tabpanel" class="tab-pane" id="admins">
							@include('users.table', ['users' => $admins])
						</div>
						<div role="tabpanel" class="tab-pane" id="keluar">
							@include('users.table', ['users' => $keluar])
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

