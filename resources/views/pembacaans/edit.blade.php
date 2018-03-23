@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Edit Pembacaan

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('pembacaans')}}">Pembacaan</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Pembacaan</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($pembacaan,[
						'url'    => 'pembacaans/' . $pembacaan->id,
						"class" => "m-t", 
						"role"  => "form",
						"files"  => "true",
						'method' => 'put'
					]) !!}
						@include('pembacaans.form')
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Update', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-danger btn-block" href="{{ url('pembacaans') }}">Cancel</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	changeJenisPembacaan($('#jenis_pembacaan_id'));
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
	function changeJenisPembacaan(control){
		var jenis_pembacaan_id = $(control).val();
		if(
			jenis_pembacaan_id == 1 ||
			jenis_pembacaan_id == 5
				){
			if(!$('.upload_terjemahan').is(":visible") ){
				$('.upload_terjemahan').fadeIn(500);
			}
		} else {
			if($('.upload_terjemahan').is(":visible") ){
				$('.upload_terjemahan').fadeOut(500);
				{{-- $('.upload_terjemahan').hide(); --}}
			}
		}
	}

</script>
@stop

