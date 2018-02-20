@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat Ujian Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Buat Ujian Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Buat Ujian Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Ujian Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'ujians', 'method' => 'post']) !!}
						@include('ujians.form')
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
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function jenisUjianBlur(control){
			var jenis_ujian_id = $(control).val();
			console.log(jenis_ujian_id);
			$.get('{{ url('ujians/getPenguji') }}',
				{ 'jenis_ujian_id': jenis_ujian_id },
				function (data, textStatus, jqXHR) {
					console.log(data);
					for (var i = 0; i < data.length; i++) {
						console.log(data[i]);
						$('#penguji option[value="' + data[i] + '"]').prop('selected', true);
					}
					$('#penguji').selectpicker('refresh');
				}

			);
		}
	</script>
@stop

