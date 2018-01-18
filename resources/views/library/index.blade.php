@extends('layouts.master')

@section('title') 
Kulit Kelamin UNPAD | 

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Library</strong>
	  </li>
</ol>
@stop
@section('head') 
	<style type="text/css" media="all">
		#tableLib th:first-child, #tableLib td:first-child{
			width:10%;
		}
		#tableLib th:nth-child(2), #tableLib td:nth-child(2){
			width:50%;
		}
		#tableLib th:nth-child(3), #tableLib td:nth-child(3){
			width:20%;
		}
		#tableLib th:nth-child(4), #tableLib td:nth-child(4){
			width:15%;
		}
	</style>
@stop
@section('content') 
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="panelLeft">
				Perpustakaan
			</div>
			<div class="panelRight">

				<a class="btn btn-primary btn-sm" href="{{ url('library/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Buku</a>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table id="tableLib" class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>ID 
							<br />
							{!! Form::text('nomor_buku', null, ['class' => 'form-control searchBar', 'id' =>'nomor_buku', 'onkeyup' => 'search();return false']) !!}
						</th>
						<th>Buku
							<br />
							{!! Form::text('nama_buku', null, ['class' => 'form-control searchBar', 'id' => 'nama_buku','onkeyup' => 'search();return false']) !!}
						</th>
						<th>Pengarang
							<br />
							{!! Form::text('pengarang', null, ['class' => 'form-control searchBar', 'id' => 'pengarang', 'onkeyup' => 'search();return false']) !!}
						</th>
						<th>Tahun Terbit
							<br />
							{!! Form::text('terbit', null, ['class' => 'form-control searchBar', 'id' => 'terbit', 'onkeyup' => 'search();return false']) !!}
						</th>
						<th>Action
							<br />
							<button class="btn btn-danger btn-sm" type='button' onclick="clearBar();return false;">clear</button>
						</th>
					</tr>
				</thead>
				<tbody id="daftarBuku">
				</tbody>
			</table>
		</div>
	</div>
</div>

{!! Form::open(['url' => 'library/import', 'method' => 'post', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
		{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
		{!! Form::file('file') !!}
		{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
	</div>
{!! Form::close() !!}
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	view();
	function view(nomor_buku, nama_buku, pengarang, terbit){
		$.get('{{ url('library/view') }}',
			{ 
				nomor_buku: nomor_buku,
				nama_buku: nama_buku,
				terbit: terbit,
				pengarang: pengarang,
			},
			function (data, textStatus, jqXHR) {
				var temp = '';
				for (var i = 0; i < data.length; i++) {
					temp += '<tr>';
					temp += '<td>' + data[i].nomor_buku + '</td>';
					temp += '<td>' + data[i].nama_buku + '</td>';
					temp += '<td>' + data[i].pengarang + '</td>';
					temp += '<td>' + data[i].terbit + '</td>';
					temp += '<td><a href="{{url('library/')}}/' + data[i].id + '" class="btn btn-sm btn-primary">Show</button></td>';
					temp += '</tr>'
				}
				$('#daftarBuku').html(temp);
			}
		);
	}
	function search(){
		var nomor_buku = $('#nomor_buku').val();
		var nama_buku = $('#nama_buku').val();
		var terbit = $('#terbit').val();
		var pengarang = $('#pengarang').val();
		view(nomor_buku, nama_buku, pengarang, terbit);
	}
	function clearBar(){
		$('.searchBar').val('');
		view('','','','');
	}
</script>
@stop

