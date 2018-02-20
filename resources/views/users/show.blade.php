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
    <li role="presentation"><a href="#tugas" aria-controls="tugas" role="tab" data-toggle="tab">Tugas</a></li>
    <li role="presentation"><a href="#ujian" aria-controls="ujian" role="tab" data-toggle="tab">Ujian</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="home">
		@include('users.detil')	
	</div>
	<div role="tabpanel" class="tab-pane" id="stase">
			@include('users.stase')
	</div>
	<div role="tabpanel" class="tab-pane" id="pembacaan">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="panelLeft">
						Pembacaan
					</div>	
					<div class="panelRight">
						<a class="btn btn-primary" href="{{ url('users/' . $user->id . '/pembacaans/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Pembacaan</a>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				@include('pembacaans.pembacaan')	
			</div>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="tugas">
		<div class="panel panel-info">
			<div class="panel-body">
				@include('tugas')
			</div>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="ujian">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="panelLeft">
						Ujian
					</div>
					<div class="panelRight">
						<a class="btn btn-primary" href="{{ url('users/' . $user->id . '/create/ujians') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Ujian</a>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Jenis Ujian</th>
								<th>Penguji</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if($user->ujian->count() > 0)
								@foreach($user->ujian as $ujian)
									<tr>
										<td>{{ $ujian->tanggal->format('d M Y') }}</td>
										<td>{{ $ujian->jenisUjian->jenis_ujian }}</td>
										<td>
											@foreach( $ujian->penguji as $penguji )
												<li>{{ $penguji->user->nama }}</li>
											@endforeach
										</td>
										<td nowrap class="autofit">
											{!! Form::open(['url' => 'ujians/' . $ujian->id, 'method' => 'delete']) !!}
												<a class="btn btn-warning btn-sm" href="{{ url('users/' . $user->id . '/ujians/'. $ujian->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
												{!! Form::hidden('user_delete', $user->id, ['class' => 'form-control']) !!}
												{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
												<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $ujian->id }} - {{ $ujian->jenisUjian->jenis_ujian }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3" class="text-center">Tidak ada data untuk ditampilkan</td>
								</tr>
							@endif
						</tbody>
					</table>
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

