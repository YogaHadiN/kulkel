@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat Stase Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Buat Stase Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Buat Stase Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Stase Baru
					</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'stases', 'method' => 'post']) !!}
					@include('stases.form')
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
							{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a class="btn btn-danger btn-block" href="{{ url('stases') }}">Cancel</a>
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
	function tambahInput(control){
		var stase      = $(control).closest('tr').find('.stase').val();
		var bulanTahun = $(control).closest('tr').find('.bulanTahun').val();
		if( stase != '' && bulanTahun != '' ){
			var row        = $(control).closest('tr')[0].outerHTML;
			$(control).closest('tr').after(row);
			$(control).closest('tr').next().find('stase');
			$(control).closest('td').html('<button class="btn btn-danger btn-sm" type="button" onclick="kurangInput(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></button>');
			$('.bulanTahun').datepicker({
				todayBtn: "linked",
				keyboardNavigation: false,
				forceParse: false,
				calendarWeeks: true,
				autoclose: true,
				format: 'mm-yyyy',
				minViewMode: 'months'
			});
		
		}
	}
	function kurangInput(control){
		$(control).closest('tr').remove();
	}
</script>
@stop

