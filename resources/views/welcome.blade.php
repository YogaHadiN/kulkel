@extends('layouts.face')

@section('title') 
	Kulkel Undip
@stop
@section('content') 
  <div class="row">
	<div class="col-sm-8">
	  <h2 class="mt-4">Tentang Kami</h2>
	  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
	  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
	  <p>
		<a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
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
	<div class="col-sm-4 my-4">
	  <div class="card">
		<img class="card-img-top" src="{{ url('img/Depositphotos_143866953_s-2015.jpg') }}" alt="">
		<div class="card-body">
		  <h4 class="card-title">Card title</h4>
		  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
		</div>
		<div class="card-footer">
		  <a href="#" class="btn btn-primary">Find Out More!</a>
		</div>
	  </div>
	</div>
	<div class="col-sm-4 my-4">
	  <div class="card">
		<img class="card-img-top" src="{{ url('img/Depositphotos_7700067_s-2015.jpg') }}" alt="">
		<div class="card-body">
		  <h4 class="card-title">Card title</h4>
		  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
		</div>
		<div class="card-footer">
		  <a href="#" class="btn btn-primary">Find Out More!</a>
		</div>
	  </div>
	</div>
	<div class="col-sm-4 my-4">
	  <div class="card">
		<img class="card-img-top" src="{{ url('img/Depositphotos_80150956_s-2015.jpg') }}" alt="">
		<div class="card-body">
		  <h4 class="card-title">Card title</h4>
		  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
		</div>
		<div class="card-footer">
		  <a href="#" class="btn btn-primary">Find Out More!</a>
		</div>
	  </div>
	</div>
  </div>
@stop
@section('footer') 
	
@stop
