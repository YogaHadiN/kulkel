<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control rq selectpick', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>

<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
  {!! Form::label('tanggal', 'Tanggal') !!}
  @if(isset($gardenia))
	  {!! Form::text('tanggal' , $gardenia->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
  @else
	<div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			  @if(count( old('tanggal') ))
				  @foreach( old('tanggal') as $k => $tanggal)	
					<tr>
					<td>
						@if( \Session::has('tanggale') && in_array( $k, \Session::get('tanggale') ) )	
						  {!! Form::text('tanggal[]' , null, ['class' => 'form form-control tanggal rq has-error']) !!}
						@else
						  {!! Form::text('tanggal[]' , null, ['class' => 'form form-control tanggal rq']) !!}
						@endif
					</td>
					<td class="action">
						@if($k == count( old('tanggal') ) - 1)
							<button class="btn btn-primary btn-sm btn-block" type="button" onclick="tambah(this);return false;"><i class="fa fa-plus" aria-hidden="true"></i></button>
						@else
							<button class="btn btn-danger btn-sm btn-block" type="button" onclick="kurang(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></button>
						@endif
					</td>
				  </tr>
				  @endforeach
			  @else
				  <tr>
					<td>
					  {!! Form::text('tanggal[]' , null, ['class' => 'form form-control tanggal rq']) !!}
					</td>
					<td class="action">
						<button class="btn btn-primary btn-sm btn-block" type="button" onclick="tambah(this);return false;"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</td>
				  </tr>
			  @endif

			</tbody>
		</table>
	</div>
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
