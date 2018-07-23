<tr>
	<td>
	  {!! Form::select('jenis_telpon_id[]' , App\JenisTelpon::list(), null, [
		  'class' => 'form-control jenis_telpon'
	  ]) !!}
	</td>
	<td>
		{!! Form::text('no_telp[]', null, array(
			'class'         => 'form-control no_telp'
		))!!}
	</td>
	<td>
		<button class="btn btn-primary btn-sm" type="button" onclick="tambahTelp(this);">
			<i class="fa fa-plus" aria-hidden="true"></i>
		</button>
	</td>
</tr>
