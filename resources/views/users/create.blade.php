@extends('layouts.master')

@section('title') 
	Kulit dan Kelamin UNDIP | Buat User Baru

@stop
@section('page-title') 
<h2>Buat User Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Buat User Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Buat User Baru</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'users', 'method' => 'post']) !!}
					@include('users.form')
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
							{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
						</div>
					</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
{!! HTML::script('js/telpon.js')!!}
	<script type="text/javascript" charset="utf-8">
		$('#telps').val('');
		function dummySubmit(control){
			alert('yuhuu');
			var submitNih = true;

			$('#tableTelp tbody tr').each( function(i){
				var telp = $(this).find('.no_telp').val();
				var jenis_telp = $(this).find('.jenis_telpon').val();

				console.log( telp == '' );
				console.log( jenis_telp == '' );

				if(
						(telp == '' && jenis_telp != '') ||
						(telp != '' && jenis_telp == '')
				  ){
					submitNih = false;
				}
			});
			if( submitNih ){
				siapSubmit(control);
			} else {
				alert('kolom telpon harus diisi semuanya atau dikosongkan semuanya');
			}
			console.log('submitNih : ' + submitNih);
		}

		function siapSubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function tambahTelp(control){
			if(
					$(control).closest('tr').find('.jenis_telpon').val() != '' ||
					$(control).closest('tr').find('.no_telp').val() != ''
			  ){
				var html = $('#contoh').html();
				$(control).closest('tr').after(html);
				$(control).closest('tr').find('.fa').removeClass().addClass('fa fa-minus');
				$(control).closest('tr')
					.find('.btn-primary')
					.removeClass()
					.addClass('btn btn-danger btn-sm')
					.attr('onclick', 'kurangTelp(this);return false;');
			}
		}
		function kurangTelp(control){
			$(control).closest('tr').remove();
		}
	</script>
@stop

