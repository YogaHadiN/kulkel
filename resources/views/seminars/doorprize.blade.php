@extends('layouts.master')

@section('title') 
DVUNDIP | DoorPrize	

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	<li>
		  <a href="{{ url('seminars')}}">Seminar</a>
	  </li>
	<li>
		<a href="{{ url('seminars/' . $seminar->id )}}">{{ $seminar->seminar }}</a>
	  </li>
	  <li class="active">
		  <strong>Doorprize</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="error-desc">
		<button id="only_button" class="btn btn-primary btn-lg" type="button" onclick="acak();"> ACAK </button>
	</div>
	<div class="text-center animated fadeInRightBig">
		<div class="font-bold font-super-big" id="nama_peserta">
			 <img src="{{ asset('img/empty.jpg') }}" alt="EMPTY" class="img-circle"> 
		</div>
	</div>
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		var interval = null;
		function acak(){
			var currentNumber = 0;
			var random_number = 0;
			var countArray = {{ $seminar->peserta->count() }}
			var peserta = [ 
				@foreach($seminar->peserta as $k => $peserta)	
					@if($k == $seminar->peserta->count() -1)
						"{{ $peserta->nama }}"
					@else
						"{{ $peserta->nama }}",
					@endif
				@endforeach
			];
			interval = setInterval(function() {
					while ( random_number == currentNumber ) {
						random_number = Math.floor(Math.random() * countArray);
					}
					currentNumber = random_number;
					$('#nama_peserta').html( peserta[random_number] );

			}, 100); // every 1000 ms
			$('#only_button').attr('class', 'btn btn-danger btn-lg');
			$('#only_button').attr('onclick', 'stop();return false;');
			$('#only_button').html('STOP!!');
		}

		function stop(){
			clearInterval(interval);
			$('#only_button').attr('class', 'btn btn-primary btn-lg');
			$('#only_button').attr('onclick', 'acak();return false;');
			$('#only_button').html('ACAK');
		}
	</script>
@stop

