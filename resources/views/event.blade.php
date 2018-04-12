@extends('layouts.face')
@section('title') 
	Kulkel UNDIP | {{ $event->title }}
@stop
@section('head') 
@stop
@section('menu')
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('/') }}">Home
	  </a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('welcome/seminars') }}">Seminars</a>
		<span class="sr-only">(current)</span>
	</li>
	<li class="nav-item active">
	  <a class="nav-link" href="{{ url('beritas') }}">Berita</a>
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
			<h1 class="event_title">{{ $event->title }}</h1>
			ditulis oleh {{ $event->user->nama }}
			<hr />
			Ditulis tanggal {{ $event->created_at->format('d M Y') }}
			<hr />
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 img-center">
			<img src="{{ url('img/events/' . $event->image) }}" alt="" class="blog-image" />		
		</div>
	</div>
	<hr/>
	@foreach( json_decode($event->body, true) as $body)	
		<p>{{ $body }}</p>
	@endforeach
	
@stop
@section('footer') 
	
@stop
