		viewTelpon();
		function viewTelpon(){
			var telps = parseTelp();
			var temp = '';
			console.log(telps);
			for (var i = 0; i < telps.length; i++) {
				temp += '<tr>';
				temp += '<td class="i hide">' + i + '</td>';
				temp += '<td>' + telps[i].jenis_telpon + '</td>';
				temp += '<td>' + telps[i].no_telp + '</td>';
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
			console.log('jenis_telpon_id' + jenis_telpon_id);
			console.log('jenis_telpon' + jenis_telpon);
			console.log('nomor_telpon' + nomor_telpon);
			var telps = parseTelp();
			console.log(telps);
			var newTelp = {
				'id' : jenis_telpon_id,
				'jenis_telpon' : jenis_telpon,
				'no_telp' : nomor_telpon
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
