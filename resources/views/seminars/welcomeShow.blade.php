@extends('layouts.face')
@section('title') 
	Kulkel Undip
@stop
@section('jumbo_image') 
    {{-- <header class="business-header" style="background: url('img/UNDIP2.png') center center no-repeat scroll;"> --}}
    {{--   <div class="container"> --}}
    {{--     <div class="row"> --}}
    {{--       <div class="col-lg-12"> --}}
    {{--         {1{-- <h1 class="display-3 text-center text-white mt-4 gambar"> --}1} --}}
			{{-- {1{-- </h1> --}1} --}}
    {{--       </div> --}}
    {{--     </div> --}}
    {{--   </div> --}}
    {{-- </header> --}}
@stop
@section('menu')
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('/') }}">Home
	  </a>
	</li>
	<li class="nav-item active">
	  <a class="nav-link" href="{{ url('welcome/seminars') }}">Seminars</a>
		<span class="sr-only">(current)</span>
	</li>
	<li class="nav-item">
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
	<div class="col-sm-8">
		<h2 class="mt-4">{{ $seminar->seminar }}</h2>
	  <div class="table-responsive">
		  <table class="table table-hover table-condensed table-bordered">
			  <thead>
				  <tr>
					  <th>Topik</th>
					  <th>Pembicara</th>
					  <th>Jam Mulai</th>
				  </tr>
			  </thead>
			  <tbody>
				  @if($seminar->topik->count() > 0)
					  @foreach($seminar->topik as $topik)
						  <tr>
							  <td> <a class="" href="{{ $topik->link_materi }}">{{ $topik->topik }}</a> </td>
							  <td>{{ $topik->pembicara }}</td>
							  <td>{{ $topik->jam_mulai }}</td>
						  </tr>
					  @endforeach
				  @else
					  <tr>
						  <td colspan="6" class="text-center">
							  Tidak ada data untuk ditampilkan
						  </td>
					  </tr>
				  @endif
			  </tbody>
		  </table>
	  </div>



	  
	  
	</div>
	<div class="col-sm-4">
		@include('layouts.hubungi')	
	</div>
  </div>
@stop
@section('footer') 
	
@stop
