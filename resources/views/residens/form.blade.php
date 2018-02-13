<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nama')) has-error @endif">
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
			@if( isset($residen) )
				{!! Form::text('tanggal_lahir', $residen->tanggal_lahir->format('d-m-Y'), array(
				'class'         => 'form-control tanggal'
			))!!}
			@else
			{!! Form::text('tanggal_lahir', null, array(
				'class'         => 'form-control tanggal'
			))!!}
			@endif
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
		  @if( isset($residen) )
			  {!! Form::text('bulan_masuk_ppds', $residen->bulan_masuk_ppds->format('m-Y'), array(
				'class'         => 'form-control bulanTahun'
			))!!}
		  @else
			{!! Form::text('bulan_masuk_ppds', null, array(
				'class'         => 'form-control bulanTahun'
			))!!}
		  @endif
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
		@if( isset($residen) )
			{!! Form::textarea('no_telps', json_encode( $residen->arraytelp ), array(
				'class' => 'form-control',
				'id'    => 'telps'
			))!!}
		@else
			{!! Form::textarea('no_telps', null, array(
				'class' => 'form-control',
				'id'    => 'telps'
			))!!}
			
		@endif
		</div>
	</div>
</div>
