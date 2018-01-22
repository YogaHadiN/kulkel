@extends('layouts.face')

@section('title') 
	Kulkel UNDIP | Events
@stop
@section('menu')
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('/') }}">Home</a>
	</li>
	<li class="nav-item active">
	  <a class="nav-link" href="{{ url('beritas') }}">Event
		<span class="sr-only">(current)</span>
	  </a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('about') }}">About</a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('login') }}">Login</a>
	</li>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="event_title">Event</h1>
		</div>
	</div>
	<hr />
  <div class="row">
	<div class="col-sm-8">
		@if( $events->count() )
			{{ $events->links() }}
			@foreach($events as $event)	
				<div class="row margin-box">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
						<img class="card-img-top" src="{{ url('img/events/' . $event->image) }}" alt="">
					</div>
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
						<h4 class="card-title">{{ $event->title }}</h4>
						<p class="card-text">{{ App\Yoga::get_words( json_decode($event->body, true)[0] , 40) }}</p>
						<a href="{{ url('beritas/' . $event->id) }}" class="btn btn-primary">Read More</a>
					</div>
				</div>
			@endforeach
			{{ $events->links() }}
		@else
			<h3 class="text-center">Tidak ada Berta untuk disampaikan</h3>
		@endif
	</div>
	<div class="col-sm-4">
	  <h2 class="mt-4">Hubungi Kami</h2>
	  <address>
		<strong>Fakultas Kedokteran</strong>
		<strong>Bagian Ilmu Kesehatan Kulit Dan Kelamin</strong>
		<br>Jalan Dokter Sutomo 16-18 
		<br>Semarang 50231
		<br>
	  </address>
	  <address>
		<abbr title="Phone">P:</abbr>
		(024) 8314322 Pes. 8054 <br />
		Fax. (024) 8444571
		<br>
		<abbr title="Email">E:</abbr>
		<a href="mailto:#">kulitkelamin.fkundip@yahoo.com</a>
	  </address>
	</div>
  </div>
@stop
@section('footer') 
	
@stop
