@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Jadwal Poli Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Jadwal Poli Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Jadwal Poli Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Buat Jadwal Baru</h3>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => 'polis', 'method' => 'post']) !!}
					<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
					  {!! Form::label('tanggal', 'Tanggal') !!}
					  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
					  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
					</div>
					<div class="form-group" @if($errors->has('jatul')) class="has-error" @endif>
					  {!! Form::label('jatul', 'Jatul') !!}
					  {!! Form::select('jatul' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search'  => 'true']) !!}
					  @if($errors->has('jatul'))<code>{{ $errors->first('jatul') }}</code>@endif
					</div>
					<div class="form-group" @if($errors->has('jagem')) class="has-error" @endif>
					  {!! Form::label('jagem', 'Jagem') !!}
					  {!! Form::select('jagem' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search'  => 'true']) !!}
					  @if($errors->has('jagem'))<code>{{ $errors->first('jagem') }}</code>@endif
					</div>
					<div class="form-group" @if($errors->has('jabay')) class="has-error" @endif>
					  {!! Form::label('jabay', 'Jabay') !!}
					  {!! Form::select('jabay' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search'  => 'true']) !!}
					  @if($errors->has('jabay'))<code>{{ $errors->first('jabay') }}</code>@endif
					</div>
					<div class="form-group" @if($errors->has('jagut')) class="has-error" @endif>
					  {!! Form::label('jagut', 'Jagut') !!}
					  {!! Form::select('jagut' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search'  => 'true']) !!}
					  @if($errors->has('jagut'))<code>{{ $errors->first('jagut') }}</code>@endif
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
							{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a class="btn btn-danger btn-block" href="{{ url('polis') }}">Cancel</a>
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
	$('.tanggal').datepicker({
		todaybtn:           "linked",
		keyboardnavigation: false,
		forceparse:         false,
		calendarweeks:      true,
		autoclose:          true,
		format:             'dd-mm-yyyy'
	}).on('changeDate', function(e){
		$.get( '{{ url('polis/ajax/get/jaga') }}',
			{ 'tanggal': $(this).val() },
			function (data, textstatus, jqxhr) {
				$('#jagut').val(data['jagut']);
				$('#jagem').val(data['jagem']);
				$('#jatul').val(data['jatul']);
				$('#jabay').val(data['jabay']);
				$('.selectpick').selectpicker('refresh');
			}
		);
	});

</script>
	
@stop

