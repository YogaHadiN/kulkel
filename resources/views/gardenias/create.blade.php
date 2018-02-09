@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Gardenia Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Gardenia Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('gardenias')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Create</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Buat Gardenia Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'gardenias', 'method' => 'post']) !!}
						@include('gardenias.form')
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
	
	function tambah(control){
		if( $(control).closest('tr').find('.form').val() != '' ){
			var temp = $(control).closest('tr')[0].outerHTML;
			$(control).closest('tbody').append(temp);
			$(control).closest('tr').find('td.action').html('<button class="btn btn-danger btn-block" type="button" onclick="kurang(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></button>');

            $('.tanggal').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
		}
	}
	

	function kurang(control){
		$(control).closest('tr').remove();
	}
</script>
	
@stop

