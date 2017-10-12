@extends('layouts.master')

@section('title') 
Klinik Jati Elok | Buat Residen Baru

@stop
@section('page-title') 
<h2>Buat Residen Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Buat Residen Baru</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Residen Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'residens', 'method' => 'post']) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('nama'))has-error @endif">
								  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
									{!! Form::text('nama', null, array(
										'class'         => 'form-control rq'
									))!!}
								  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group @if($errors->has('tanggal_lahir'))has-error @endif">
								  {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'control-label']) !!}
									{!! Form::text('tanggal_lahir', null, array(
										'class'         => 'form-control tanggal'
									))!!}
								  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group @if($errors->has('tempat_lahir'))has-error @endif">
								  {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'control-label']) !!}
									{!! Form::text('tempat_lahir', null, array(
										'class'         => 'form-control'
									))!!}
								  @if($errors->has('tempat_lahir'))<code>{{ $errors->first('tempat_lahir') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group @if($errors->has('bulan_masuk_ppds'))has-error @endif">
								  {!! Form::label('bulan_masuk_ppds', 'Bulan Masuk PPDS', ['class' => 'control-label']) !!}
									{!! Form::text('bulan_masuk_ppds', null, array(
										'class'         => 'form-control bulanTahun'
									))!!}
								  @if($errors->has('bulan_masuk_ppds'))<code>{{ $errors->first('bulan_masuk_ppds') }}</code>@endif
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group @if($errors->has('no_ktp'))has-error @endif">
								  {!! Form::label('no_ktp', 'Nomor KTP', ['class' => 'control-label']) !!}
									{!! Form::text('no_ktp', null, array(
										'class'         => 'form-control'
									))!!}
								  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('nama_pasangan'))has-error @endif">
								  {!! Form::label('nama_pasangan', 'Nama Pasangan', ['class' => 'control-label']) !!}
									{!! Form::text('nama_pasangan', null, array(
										'class'         => 'form-control'
									))!!}
								  @if($errors->has('nama_pasangan'))<code>{{ $errors->first('nama_pasangan') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('alamat_semarang'))has-error @endif">
								  {!! Form::label('alamat_semarang', 'Alamat Semarang', ['class' => 'control-label']) !!}
									{!! Form::textarea('alamat_semarang', null, array(
										'class'         => 'form-control textareacustom'
									))!!}
								  @if($errors->has('alamat_semarang'))<code>{{ $errors->first('alamat_semarang') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm- col-md- col-lg-">
								<div class="table-responsive">
									<table class="table table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th>Jenis Telpon</th>
												<th>Nomor</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="body_telpon">

										</tbody>
										<tfoot>
											<tr>
												<td>
													{!! Form::select('jenis_telpon', App\JenisTelpon::list(), null, array(
														'class'         => 'form-control jenis_telpon_id inp_tel',
														'id'         => 'jenis_telpon_id'
													))!!}
												</td>
												<td>
													{!! Form::text('nomor_telpon',  null, array(
														'class'         => 'form-control nomor_telpon inp_tel'
													))!!}
												</td>
												<td>
													<button class="btn btn-sm btn-info btn-block" onclick="inputTelpon(this);return false;" type="button">Input</button>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm- col-md- col-lg-">
								<div class="table-responsive">
									<table class="table table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th>Nama Anak</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="body_anak">

										</tbody>
										<tfoot>
											<tr>
												<td>
													{!! Form::text('nama_anak',  null, array(
														'class'         => 'form-control nama_anak',
														'id'         => 'nama_anak'
													))!!}
												</td>
												<td>
													<button class="btn btn-sm btn-info btn-block" onclick="inputAnak(this);return false;" type="button">Input</button>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('alamat_asal'))has-error @endif">
								  {!! Form::label('alamat_asal', 'Alamat Asal', ['class' => 'control-label']) !!}
									{!! Form::textarea('alamat_asal', null, array(
										'class'         => 'form-control textareacustom'
									))!!}
								  @if($errors->has('alamat_asal'))<code>{{ $errors->first('alamat_asal') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('judul_thesis'))has-error @endif">
								  {!! Form::label('judul_thesis', 'Judul Thesis', ['class' => 'control-label']) !!}
									{!! Form::text('judul_thesis', null, array(
										'class'         => 'form-control'
									))!!}
								  @if($errors->has('judul_thesis'))<code>{{ $errors->first('judul_thesis') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
							</div>
						</div>
						<div class="row ">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									{!! Form::textarea('telps', null, array(
										'class' => 'form-control',
										'id'    => 'telps'
									))!!}
								</div>
							</div>
						<div class="row ">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									{!! Form::textarea('anaks', null, array(
										'class' => 'form-control',
										'id'    => 'anaks'
									))!!}
								</div>
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
		viewTelpon();
		viewAnak();
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function viewTelpon(){
			var telps = parseTelp();
			var temp = '';
			for (var i = 0; i < telps.length; i++) {
				temp += '<tr>';
				temp += '<td class="i hide">' + i + '</td>';
				temp += '<td>' + telps[i].jenis_telpon + '</td>';
				temp += '<td>' + telps[i].nomor_telpon + '</td>';
				temp += '<td>  <button type="button" class="btn btn-danger btn-sm btn-block" onclick="hapusTelp(this); return false;">hapus</button>  </td>';
				temp += '</tr>';
			}
			$('#body_telpon').html(temp);
		}
		function parseTelp(){
			var telps = $('#telps').val();
			if($.trim(telps) == ''){
				telps = '[]';
			}
			var telps = JSON.parse(telps)
			return telps;
		}
		function inputTelpon(control){
			var jenis_telpon_id = $(control).closest('tr').find('.jenis_telpon_id').val();
			var jenis_telpon = $(control).closest('tr').find('.jenis_telpon_id option:selected').text();
			var nomor_telpon = $(control).closest('tr').find('.nomor_telpon').val();
			var telps = parseTelp();
			console.log(telps);
			var newTelp = {
				'jenis_telpon_id' : jenis_telpon_id,
				'jenis_telpon' : jenis_telpon,
				'nomor_telpon' : nomor_telpon
			};

			telps.push(newTelp);
			telps = JSON.stringify(telps);
			$('#telps').val(telps);
			viewTelpon();
			$('.inp_tel').val('');
			$('#jenis_telpon_id').focus();
		}
		function hapusTelp(control){
			var i = $(control).closest('tr').find('.i').html();
			var telps = parseTelp();
			telps.splice(i,1);
			console.log(telps);
			telps = JSON.stringify(telps);
			$('#telps').val(telps);
			viewTelpon();
		}
		function viewAnak(){
			var anaks = parseAnak();
			var temp = '';
			for (var i = 0; i < anaks.length; i++) {
				temp += '<tr>';
				temp += '<td class="i hide">' + i + '</td>';
				temp += '<td>' + anaks[i].nama_anak + '</td>';
				temp += '<td> <button type="button" class="btn btn-danger btn-sm btn-block" onclick="hapusAnak(this); return false;">hapus</button> </td>';
				temp += '</tr>';
			}
			$('#body_anak').html(temp);
		}
		function parseAnak(){
			var anaks = $('#anaks').val();
			if($.trim(anaks) == ''){
				anaks = '[]';
			}
			anaks = JSON.parse(anaks);
			return anaks;
		}
		function inputAnak(control){
			var nama_anak = $(control).closest('tr').find('.nama_anak').val();
			var anaks = parseAnak();
			var newAnak = {
				'nama_anak' : nama_anak
			};
			anaks.push(newAnak);
			anaks = JSON.stringify(anaks);
			$('#anaks').val(anaks);
			viewAnak();
			$('.nama_anak').val('');
			$('#nama_anak').focus();
		}
		function hapusAnak(control){
			var i = $(control).closest('tr').find('.i').html();
			var anaks = parseAnak();
			anaks.splice(i,1);
			anaks = JSON.stringify(anaks);
			$('#anaks').val(anaks);
			viewAnak();
			$('.nama_anak').val('');
			$('#nama_anak').focus();
		}
	</script>
@stop

