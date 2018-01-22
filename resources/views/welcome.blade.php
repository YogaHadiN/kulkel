@extends('layouts.face')

@section('title') 
	Kulkel Undip
@stop

@section('jumbo_image') 
    <header class="business-header" style="background: url('img/KARIADI.png') center center no-repeat scroll;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            {{-- <h1 class="display-3 text-center text-white mt-4 gambar"> --}}
			{{-- </h1> --}}
          </div>
        </div>
      </div>
    </header>
@stop

@section('menu')
	<li class="nav-item active">
	  <a class="nav-link" href="{{ url('/') }}">Home
		<span class="sr-only">(current)</span>
	  </a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('beritas') }}">Events</a>
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
	  <h2 class="mt-4">Tentang Kami</h2>
	  <p>
	  Bagian Ilmu Penyakit Kulit dan Kelamin berdiri pada tahun 1963. Sejak tahun 1978 ditetapkan sebagai salah satu Pendidikan Spesialis, yang sampai saat ini telah menghasilkan 139 spesialis tersebar di seluruh tanah air. Dari waktu ke waktu terjadi perkembangan dan kemajuan yang sangat pesat</p>
	  </p>
	  <p>
	  Hingga saat ini telah terbentuk sub-sub bagian yaitu : Infeksi Menular Seksual (IMS ), Alergi Imunologi, Mikologi, Morbus Hansen, Dermatologi Anak, Kosmetik Medik, Bedah Kulit, Onkologi, Dermatologi Umum dan Histopatologi . Dengan 18 Staf dan 46 residen saat ini kami mempunyai produk unggulan antara lain bedah kulit dan kosmetik medik.
	  </p>
	  <p>
		<a class="btn btn-primary btn-lg" href="{{ url('about') }}">Read More &raquo;</a>
	  </p>
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
  <!-- /.row -->
  <div class="row">
	  @foreach($events as $event)	
		<div class="col-sm-4 my-4">
		  <div class="card">
			  <img class="card-img-top" src="{{ url('img/events/'. $event->image) }}" alt="">
			<div class="card-body">
				<h4 class="card-title">{{ $event->title }}</h4>
				<p class="card-text">{{ App\Yoga::get_words( json_decode( $event->body , true)[0] , 30) }}</p>
			</div>
			<div class="card-footer">
				<a href="{{ url('beritas/' . $event->id) }}" class="btn btn-primary">Read More</a>
			</div>
		  </div>
		</div>
	  @endforeach
  </div>
@stop
@section('footer') 
	
@stop
