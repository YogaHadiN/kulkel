@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP
@stop

@section('head') 
	<style type="text/css" media="all">
		#tableStase tr td:first-child, #tableStase tr th:first-child {
			width:20%;
		}
		#tableStase tr td:nth-child(2), #tableStase tr th:nth-child(2) {
			width:20%;
		}
		#tableStase tr td:nth-child(3), #tableStase tr th:nth-child(3) {
			width:20%;
		}
		#tableStase tr td:nth-child(4), #tableStase tr th:nth-child(4) {
			width:20%;
		}
	</style>
@stop
@section('page-title') 
<h2>Detil User</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('users')}}">User</a>
	  </li>
	  <li class="active">
		  <strong>{{ $user->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 

<div class="hide" id="user_id">
	{{ $id }}
</div>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Detil {{ $user->role->role }}</a></li>
    <li role="presentation"><a href="#stase" aria-controls="stase" role="tab" data-toggle="tab">Stase</a></li>
    <li role="presentation"><a href="#pembacaan" aria-controls="pembacaan" role="tab" data-toggle="tab">Pembacaan</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{ $user->nama }}</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<tbody>
									<tr>
										<th class="text-left">Nama</th>
										<td>{{ $user->nama }}</td>
									</tr>
									<tr>
										<th class="text-left">Inisial</th>
										<td>{{ $user->inisial }}</td>
									</tr>
									<tr>
										<th class="text-left">Role</th>
										<td>{{ $user->role->role }}</td>
									</tr>
									<tr>
										<th class="text-left">Tanggal Lahir</th>
										<td>{{ $user->tanggal_lahir_format }}</td>
									</tr>
									<tr>
										<th class="text-left">Tempat Lahir</th>
										<td>{{ $user->tempat_lahir }}</td>
									</tr>
									<tr>
										<th class="text-left">Email</th>
										<td>{{ $user->email }}</td>
									</tr>
									<tr>
										<th class="text-left">No KTP</th>
										<td>{{ $user->no_ktp }}</td>
									</tr>
									<tr>
										<th class="text-left">Bulan Masuk PPDS</th>
										<td>{{ $user->bulan_masuk_ppds_format }}</td>
									</tr>
									<tr>
										<th class="text-left">Alamat Semarang</th>
										<td>{{ $user->alamat_semarang }}</td>
									</tr>
									<tr>
										<th class="text-left">Alamat Asal</th>
										<td>{{ $user->alamat_asal }}</td>
									</tr>
									<tr>
										<th class="text-left">No Telp</th>
										<td>
											<ul>
												@foreach($user->no_telps as $no_telp)	
													<li>{{ $no_telp->no_telp }}</li>
												@endforeach
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-primary btn-sm btn-block" href="{{ url('users/' . $user->id . '/edit') }}">Edit</a>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-danger btn-block" href="{{ url('users') }}">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
    <div role="tabpanel" class="tab-pane" id="stase">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							Stase
						</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered" id="tableStase">
								<thead>
									<tr>
										<th>Stase</th>
										<th>Mulai</th>
										<th>Akhir</th>
										<th>Urut</th>
										<th>Now</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($staseResidens as $staseResiden)	
										{{-- @if( new DateTime($staseResiden['urut']) >= new DateTime(date('Y-m-01'))) --}}
										@if(  
											new DateTime(date('Y-m-d')) >= new DateTime($staseResiden['urut']) &&
											new DateTime(date('Y-m-d')) <= new DateTime($staseResiden['urutAkhir'])
										)
											<tr class="info">
										@else
											<tr>
										@endif
											<td title="{{ $staseResiden['stase_id'] }}">{{ $staseResiden['stase'] }}</td>
											<td class="mulai">{{ $staseResiden['mulai'] }}</td>
											<td class="akhir">{{ $staseResiden['akhir'] }}</td>
											<td>{{ $staseResiden['urut'] }}</td>
											<td>{{ date('Y-m-01') }}</td>
											<td title="{{ $staseResiden['jenis_stase_id'] }}">
												<button class="btn btn-xs btn-warning btn-block" type="button" onclick="editStase(this);return false;">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
													Edit
												</button>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
    <div role="tabpanel" class="tab-pane" id="pembacaan">
	
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Pembacaan Sudah</h3>
					</div>
					<div class="panel-body">
						
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Judul</th>
										<th>Pembahas</th>
										<th>Moderator</th>
									</tr>
								</thead>
								<tbody>
									@if(count($pembacaans_sudah) > 0)
										@foreach($pembacaans_sudah as $pembacaan)
											<tr>
												<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
												<td>{{ $pembacaan->judul }}</td>
												<td>
													<ul>
														@foreach($pembacaan->pembahas as $pembahas)	
															<li>{{ $pembahas->user->inisial }}</li>
														@endforeach
													</ul>
												</td>
												<td>
													<ul>
														@foreach($pembacaan->moderator as $moderator)	
															<li>{{ $moderator->user->nama }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4">
												Tidak ada data untuk ditampilkan
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Pembacaan Belum</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Pembahas</th>
										<th>Moderator</th>
									</tr>
								</thead>
								<tbody>
									@if(count($pembacaans_belum) > 0)
										@foreach($pembacaans_belum as $pembacaan)
											<tr>
												<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
												<td>
													<ul>
														@foreach($pembacaan->pembahas as $pembahas)	
															<li>{{ $pembahas->user->inisial }}</li>
														@endforeach
													</ul>
												</td>
												<td>
													<ul>
														@foreach($pembacaan->moderator as $moderator)	
															<li>{{ $moderator->user->nama }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4">
												Tidak ada data untuk ditampilkan
											</td>
										</tr>
									@endif
							</table>
								</tbody>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
  </div>
</div>

	
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		function editStase(control){
			var mulai = $(control).closest('tr').find('.mulai').html();
			var akhir = $(control).closest('tr').find('.akhir').html();

			$('.updateButton').each(function(){
				cancelUpdate(this);
			});

			$(control).closest('tr').find('.mulai').html("<input type='text' class='form-control tanggal inputMulai' title='" + mulai + "' value='" + mulai + "'/>");
			$(control).closest('tr').find('.akhir').html("<input type='text' class='form-control tanggal inputAkhir' title= '" + akhir + "' value='" + akhir + "'/>");


            $('.tanggal').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd-mm-yyyy'
            });



			$(control).closest('td').html('<button class="btn btn-xs btn-primary updateButton" type="button" onclick="updateStase(this);return false;"> Update</button>  <button class="btn btn-xs btn-danger" type="button" onclick="cancelUpdate(this);return false;"> Cancel</button>');
		}
		function cancelUpdate(control){
			var mulai = $(control).closest('tr').find('.inputMulai').attr('title');
			var akhir = $(control).closest('tr').find('.inputAkhir').attr('title');
			$(control).closest('tr').find('.mulai').html(mulai);
			$(control).closest('tr').find('.akhir').html(akhir);

			$(control).closest('td').html('<button class="btn btn-xs btn-warning btn-block" type="button" onclick="editStase(this);return false;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button>');
		}
		function updateStase(control){
			var mulai = $(control).closest('tr').find('.inputMulai').val();
			var akhir = $(control).closest('tr').find('.inputAkhir').val();
			var stase_id = $(control).closest('tr').find('td:first-child').attr('title');
			var jenis_stase_id = $(control).closest('td').attr('title');
			var user_id = $('#user_id').html();
			console.log(stase_id);
			console.log(mulai);
			console.log(akhir);
			console.log(user_id);
			console.log('jenis_stase_id  = ' + jenis_stase_id);
			$.post('{{ url('users/ajax') }}',
				{ 
					mulai : mulai,
					jenis_stase_id : jenis_stase_id,
					akhir : akhir,
					stase_id : stase_id,
					user_id : user_id
				},
				function (data, textStatus, jqXHR) {
					data = $.trim(data);
					console.log('date = ' + data);
					$(control).closest('tr').find('.mulai').html(mulai);
					$(control).closest('tr').find('.akhir').html(akhir);
					if( data != '' ){
						alert('yuhuuudffdf');
						$(control).closest('tr').find('td:first-child').attr('title', data);

					}
					$(control).closest('td').html('<button class="btn btn-xs btn-warning btn-block" type="button" onclick="editStase(this);return false;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button>');


				}
			);
		}
	</script>
	
@stop

