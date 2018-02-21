@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Buat Ujian Baru

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Buat Ujian Baru</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>	Kulkel UNDIP | Buat Ujian Baru</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Ujian Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'ujians', 'method' => 'post']) !!}
						@include('ujians.form')
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
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
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function jenisUjianBlur(control){
			var jenis_ujian_id = $(control).val();
			console.log(jenis_ujian_id);
			$.get('{{ url('ujians/getPenguji') }}',
				{ 'jenis_ujian_id': jenis_ujian_id },
				function (data, textStatus, jqXHR) {
					console.log(data);
					$('#penguji').val('');
					for (var i = 0; i < data.length; i++) {
						console.log(data[i]);
						$('#penguji option[value="' + data[i] + '"]').prop('selected', true);
					}
					$('#penguji').selectpicker('refresh');
				}

			);
		}
	</script>
@stop
{{-- | Elin Herlina                                               | Bu Elon               | --}}
{{-- | Yoga Hadi Nugroho                                          | Pak Yoga              | --}}
{{-- | Andarbeni nurwidi                                          | Pak Beni              | --}}
{{-- | Arinal Pahlevi                                             | Pak Arinal            | --}}
{{-- | Clarissa valencia                                          | Bu Clarissa           | --}}
{{-- | Adelia Hanung Puspaningtyas                                | Bu Adel               | --}}
{{-- | Rinda Gita Atikasari                                       | Bu Rinda              | --}}
{{-- | Carissa Adriana                                            | Bu Carissa            | --}}
{{-- | Teguh Priyanto                                             | Pak Teguh             | --}}
{{-- | Maria Leleury                                              | Bu Maria              | --}}
{{-- | Ernawati Hidayat                                           | Bu Aya                | --}}
{{-- | R. Rizcky Erika Pratami                                    | Bu Rizcky             | --}}
{{-- | Fadriani Priutami                                          | Bu Tami               | --}}
{{-- | Dhesi Ariembi                                              | Bu Dhesi              | --}}
{{-- | Nur Camelia                                                | Bu Amel               | --}}
{{-- | Intan Nurmawati Putri                                      | Bu Intan              | --}}
{{-- | Syafria Zidni                                              | Bu Zidny              | --}}
{{-- | Rr Widya Kusumaningsih                                     | Bu Widya              | --}}
{{-- | Eunice Gunawan                                             | Bu Eunice             | --}}
{{-- | Meiza                                                      | Bu Meiza              | --}}
{{-- | Hayra Diah Avianggi                                        | Bu Hayra              | --}}
{{-- | Irvin Aldikha                                              | Pak Irvin             | --}}
{{-- | Husnul cut wahyuni                                         | Bu Ayu                | --}}
{{-- | lydia kurniasari                                           | Bu Lydia              | --}}
{{-- | Yudha Permana                                              | Pak Yudha             | --}}
{{-- | Dr. Asih Budiastuti, Sp.KK (K), FINSDV, FAADV              | Dr. Asih              | --}}
{{-- | Dr. Aria Hendra, Sp. KK                                    | Dr. Aria              | --}}
{{-- | Dr. Buwono Puruhito, Sp.KK, FINSDV                         | Dr. Buwono            | --}}
{{-- | Dr. Diah Andriani Malik, Sp.KK (K), FINSDV, FAADV          | Dr. Diah              | --}}
{{-- | DR. Dr. Puguh Riyanto (K), Sp.KK, FINSDV, FAADV            | DR. Dr. Puguh         | --}}
{{-- | DR. Dr. Renni Yuniati, Sp.KK, FINSDV                       | DR. Dr. Renni         | --}}
{{-- | Dr. Galih Sari Damayanti, Sp.KK                            | Dr. Galih             | --}}
{{-- | Dr. Holy Ametati, Sp.KK                                    | Dr. Holy              | --}}
{{-- | Dr. Liza Afriliana, Sp.KK                                  | Dr. Liza              | --}}
{{-- | Dr. Muslimin, Sp.KK, FINSDV                                | Dr. Muslimin          | --}}
{{-- | Dr. Radityastuti, Sp.KK                                    | Dr. Radit             | --}}
{{-- | Dr. Retno Indar Widayati, Msi, Sp.KK (K), FINSDV, FAADV    | Dr. Retno             | --}}
{{-- | Dr. Widyastuti, Sp.KK                                      | Dr. Widyastuti        | --}}
{{-- | Dr. Y. F. Rahmat Sugianto, Sp.KK                           | Dr. Y. F. Rahmat      | --}}
{{-- | Prof. DR. Dr. Prasetyowati S, Sp.KK (K), FINSDV, FAADV     | Prof. DR. Dr. Pras    | --}}
{{-- | Tamara Friska Ristia Soesman                               | Tamara                | --}}
{{-- | Yulita herdiana                                            | Bu Lita               | --}}
{{-- | Syamsul Arifin                                             | Pak Syamsul           | --}}
{{-- | indriana pratiwi                                           | Bu Indri              | --}}
{{-- | Dr. Soejoto, SpKK(K)                                       | Dr. Soejoto           | --}}
{{-- | Dr. Meilien Himbawani, SpKK(K)                             | Dr. Meilien           | --}}
{{-- | Frista Martha Rahayu                                       | Bu Frista             | --}}
{{-- | Erien Afrinia Asri                                         | Bu Erien              | --}}
{{-- | Maya Rahmanita                                             | Bu Maya               | --}}
{{-- | Milka Wulansari Hartono                                    | Bu Milka              | --}}
{{-- | Suci widya                                                 | Bu Suci               | --}}
{{-- | dr. Dhiana Ernawati, Sp.KK(K), FINSDV, FAADV               | dr. Dhiana            | --}}
{{-- | Inggrid Christiani                                         | Bu Inggrid            | --}}
{{-- | Devi Arini                                                 | Bu Arin               | --}}
{{-- | dr R. Sri Djoko Susanto, Sp.KK(K), FINSDV, FAADV           | Dr. Djoko             | --}}
{{-- | Nadia Meutia R                                             | Bu Nadya              | --}}
{{-- | Putri Nastiti Rarasati                                     | Bu Raras              | --}}
{{-- | dr. Susanto Buditjahjono, Sp.KK(K), FAADV                  | dr. Buditjahjono      | --}}
{{-- | Raymond Suryaatmadja                                       | Pak Raymond           | --}}
{{-- | Widyaratni Pramestisiwi                                    | Bu Siwi               | --}}
{{-- | Ika Midia Sari                                             | Bu Ika                | --}}
{{-- | Dwi Septiana                                               | Bu Dwi                | --}}
{{-- | Dyah Marhaeni Puspitasari                                  | Bu Pipit              | --}}
{{-- | Heny Kurniawati                                            | Bu Heny               | --}}
{{-- | Milany Hari Rahmawati                                      | Bu Milany             | --}}
{{-- | Oktavianus Nugroho Indro P                                 | Pak Indro             | --}}
{{-- | Seca Utami                                                 | Bu Seca               | --}}
{{-- | Meira Fitriah                                              | Bu Meira              | --}}
{{-- | dr. Novi Kusumaningrum, SpKK                               | dr. Novi              | --}}
{{-- | dr. Widyawati, SpKK                                        | dr. Widyawati         | --}}
{{-- | dr Subakir, SpKK                                           | dr Subakir            | --}}
{{-- | dr. Paulus Yogyartono, SpKK (K)                            | dr. Paulus            | --}}
{{-- | dr. E.S. Indrayanti, SpKK (K), FINSDV, FAADV               | dr. Indrayanti        | --}}
{{-- | dr. Lewie Suryaatmadja, SpKK (K),FINSDV, FAADV             | dr. Lewie             | --}}
{{-- | dr. Irma Binarso, SpKK (K), MARS, FINSDV, FAADV            | dr. Irma              | --}}
{{-- | dr. T. M. Sri Redjeki S, SpKK (K), M.Si.Med, FINSDV, FAADV | dr. T. M. Sri Redjeki | --}}
{{-- | dr. Sugastiasri S, SpKK (K), FINSDV                        | dr. Sugas             | --}}

