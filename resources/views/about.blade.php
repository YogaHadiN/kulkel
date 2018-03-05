@extends('layouts.face')

@section('title') 
	Kulkel UNDIP | Tentang Kami
@stop
@section('jumbo_image') 
    <header class="business-header" style="background: url('img/fkundip.png') center center no-repeat scroll;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            {{-- <h1 class="display-3 text-center text-white mt-4 gambar"> --}}
			{{-- </h1> --}}
          </div>
        </div>
      </div>
    </header>
@stop
@section('menu')
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('/') }}">Home</a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('beritas') }}">Events</a>
	</li>
	<li class="nav-item active">
	  <a class="nav-link" href="{{ url('about') }}">About
		<span class="sr-only">(current)</span>
	  </a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="{{ url('login') }}">Login</a>
	</li>
@stop
@section('content') 
  <div class="row">
	<div class="col-sm-8">
	  <h2 class="mt-4">Tentang Kami</h2>
	  <p>Bagian Ilmu Penyakit Kulit dan Kelamin berdiri pada tahun 1963.  Sejak tahun 1978 ditetapkan sebagai salah satu Pendidikan Spesialis, yang sampai saat ini telah menghasilkan 139  spesialis tersebar di seluruh tanah air.  Dari waktu ke waktu terjadi perkembangan dan kemajuan yang sangat pesat </p>

	  <p>Hingga saat ini telah terbentuk sub-sub bagian yaitu : Infeksi Menular Seksual (IMS ), Alergi Imunologi, Mikologi, Morbus Hansen, Dermatologi Anak, Kosmetik Medik, Bedah Kulit, Onkologi, Dermatologi Umum dan Histopatologi .  Dengan 18 Staf dan 46 residen  saat ini kami mempunyai produk unggulan antara lain bedah kulit dan kosmetik medik.</p>
	<p>Aktivitas pelayanan kesehatan di Unit Rawat Jalan dan Unit Rawat Inap (Bangsal)  Kulit dilaksanakan oleh para Spesialis dan mahasiswa PPDS (Residen)</p> 

     <p>Sejak tahun 1998, mahasiswa PPDS Bagian Ilmu Penyakit Kulit dan Kelamin mendapat tugas triage di Unit Gawat Darurat, disamping itu residen juga membantu Dokter Spesialis Kulit dan Kelamin di RSU Kotamadya Semarang dan RSU Demak sebagai salah satu tugas tambahan.   Sejak tahun 2005 mengirimkan bantuan tenaga Dokter Spesialis Kulit dan Kelamin ke RSU Kabupaten Batang sesuai surat dari Direktur Badan RSUD Kabupaten Batang kepada Direktur Utama RS.Dr.Kariadi No. 445/320 dan surat dari Bupati Batang Kepada Direktur RS.Dr.Kariadi No. 445 / 380 .</p>  
     <p>Dalam meningkatkan pelayanan masyarakat Bagian / SMF I.K.Kulit dan Kelamin mencetuskan beberapa produk unggulan.  Tahun 1996 mulai dirintis Klinik Kosmetik Medik yang melayani pengelupasan kulit secara kimiawi (chemical peeling)</p> 
     <p>Klinik Bedah Kulit mengalami banyak kemajuan, saat ini dapat dilakukan tindakan eksisi, bedah listrik, bedah beku, dermabrasi, augmentasi jaringan lunak dan skleroterapi dan Bedah Laser.</p>
     <p>Klinik Bedah Kulit mengalami banyak kemajuan, saat ini dapat dilakukan tindakan eksisi, bedah listrik, bedah beku, dermabrasi, augmentasi jaringan lunak dan skleroterapi dan Bedah Laser.</p>
	  <h2 class="mt-4">Visi</h2>
	  <p>Menjadi program studi yang menghasilkan lulusan dokter Spesialis Kulit dan Kelamin yang unggul dibidang kedokteran dan kesehatan khususnya Ilmu Kesehatan Kulit dan Kelamin pada tahun 2025.</p>
	  <h2 class="mt-4">Misi</h2>
	  <p>
	  <ol>
	  	<li>
			Menyelenggarakan pendidikan berkualitas
			nasional dan internasional, menghasilkan
			lulusan yang profesional, berakhlak, peka
			terhadap masalah kesehatan kulit dan kelamin
			secara global serta menguasai perkembangan
			ilmu pengetahuan dan teknologi kedokteran di
			bidang kesehatan kulit dan kelamin terkini.	
		</li>
		<li>
			Menghasilkan penelitian nasional dan
			internasional serta ikut menyumbangkan
			penemuan baru di bidang ilmu kesehatan Kulit
			dan Kelamin.	
		</li>
		<li>
			Melaksanakan pengabdian di bidang ilmu
			kesehatan kulit dan kelamin dalam
			meningkatkan derajat kesehatan dan
			kesejahteraan masyarakat nasional dan
			internasional.	
		</li>
		<li>
			Menyelenggarakan tata kelola profesional yang
			melibatkan dosen, mahasiswa, alumni dan
			tenaga kependidikan untuk menjamin kelulusan
			yang berkualitas nasional dan internasional.
		</li>
	  </ol>

	  <h2 class="mt-4">Tujuan Program Studi</h2>
	  <p>
	  <ol>
		  <li>
			Menghasilkan dokter spesialis
			dermatovenereologi yang kompeten dan
			bermartabat
		  </li>
		  <li>
			Menyebarluaskan serta menerapkan hasil
			penelitian ilmu pengetahuan dan teknologi
			kedokteran.	  
		  </li>
		  <li>
			Meningkatkan status kesehatan masyarakat di
			bidang ilmu kesehatan kulitdan kelamin melalui
			pengelolaan sumber daya manusia dengan
			menjunjung nilai-nilai kearifan lokal.	  
		  </li>
	  </ol>
	  </p>
	  <h2 class="mt-4">Sosialisasi</h2>
	  <p>
		Kepada setiap dosen dan peserta didik PPDS
		I.K. Kulit dan Kelamin untuk memahami Visi, Misi,
		Tujuan dan Sasaran yang telah ditetapkan.
		Sosialisasi ini dilakukan melalui rapat rutin bagian
		dimana visi, misi dan tujuan program studi untuk
		pemahaman semua civitas akademika (dosen dan
		mahasiswa) dan tenaga kependidikan. Untuk tujuan
		sosialisasi internal, visi, misi dan tujuan program
		studi juga dicantumkan dalam Logbook.
		Sosialisasi Eksternal
		Dengan melakukan pemaparan pada setiap
		kesempatan baik di lingkungan fakultas maupun di
		lingkungan universitas; sosialisasi melalui seminarseminar.
		Dari hasil upaya sosialisasi maka sebagian besar
		civitas akademika memahami visi, misi, tujuan dan
		sasaran.
	  </p>
	</div>
	<div class="col-sm-4">
	  <h2 class="mt-4">Hubungi Kami</h2>
	  <address>
		<strong>Fakultas Kedokteran</strong>
		<strong>Bagian Ilmu Kesehatan Kulit Dan Kelamin</strong>
		<br>Jalan Dokter Sutomo 16-18 
		<br>Semarang 50231
		<br>
	  </address>
	  <address>
		<abbr title="Phone">P:</abbr>
		(024) 8314322 Pes. 8054 <br />
		Fax. (024) 8444571
		<br>
		<abbr title="Email">E:</abbr>
		<a href="mailto:#">kulitkelamin.fkundip@yahoo.com</a>
	  </address>
	</div>
  </div>
@stop
@section('footer') 
	
@stop
