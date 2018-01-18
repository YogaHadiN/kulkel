<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick rq', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
@if( isset($stase) )
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group" @if($errors->has('jenis_stase_id')) class="has-error" @endif>
			  {!! Form::label('jenis_stase_id', 'Jenis Stase') !!}
			  {!! Form::select('jenis_stase_id' , App\JenisStase::list(), null, ['class' => 'form-control rq']) !!}
			  @if($errors->has('jenis_stase_id'))<code>{{ $errors->first('jenis_stase_id') }}</code>@endif
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group" @if($errors->has('periode_bulan')) class="has-error" @endif>
			  {!! Form::label('periode_bulan', 'Periode Bulan') !!}
			  {!! Form::text('periode_bulan' , $stase->periode_bulan->format('m-Y'), ['class' => 'form-control bulanTahun rq']) !!}
			  @if($errors->has('periode_bulan'))<code>{{ $errors->first('periode_bulan') }}</code>@endif
			</div>
		</div>
	</div>

@else
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Jenis Stase</th>
				<th>Tanggal</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{!! Form::select('jenis_stase_id[]' , App\JenisStase::list(), null, ['class' => 'form-control rq stase']) !!}</td>
				<td>
					  @if( isset( $stase ) )
						  {!! Form::text('periode_bulan[]' , $stase->periode_bulan->format('m-Y'), ['class' => 'form-control bulanTahun']) !!}
					  @else
						  {!! Form::text('periode_bulan[]' , null, ['class' => 'form-control bulanTahun']) !!}
					  @endif
				</td>
				<td><button class="btn btn-success btn-sm" onclick="tambahInput(this);return false;" type="button"> <i class="fa fa-plus" aria-hidden="true"></i>  </button></td>
			</tr>
		</tbody>
	</table>
</div>
@endif
