<style>
	.text-menu{
		font-size: 20px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Absensi Pegawai / Guru</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg mb-2">
		        <div class="info-box bg-success">
	              	<span class="info-box-icon"><a href="<?= base_url('absensi/rekapPerCivitas')?>/1"><i class="far fa-calendar-alt"></i></a></span>
	              <div class="info-box-content">
	                <span class="info-box-number" style="font-size: 18px"><?= $jam; ?></span>
	                <span class="progress-description" style="font-size: 18px">
	                  <?= $tanggal; ?>
	                </span>
	              </div>
		        </div>
    		</div>
    	</div>
	    <div class="row">
		<?php if ($kategori == 1): ?>
	    	<?php foreach ($jadwal as $j): ?>
	    		<div class="col-lg-4 col-12">
		            <!-- small box -->
		            <div class="small-box bg-primary">
		              <div class="p-3 inner">
		              	<span class="text-menu badge badge-secondary"><?= $j['jamke'] ?></span> &nbsp&nbsp | &nbsp&nbsp
		              	<span class="text-menu"><?= $j['nama_kelas'] ?></span><br>
		              	<span class="text-menu" style="font-weight: bold;"><?= $j['mapel_alias'] ?></span><br>
		                <!-- <span>User Registrations</span><br> -->
		              </div>
		              <div class="icon">
		                <i class="fas fa-edit fa-sm"></i>
		              </div>
		              <a href="<?= base_url('absensi/dhsantri/').$j['id_kbm']?>" class="klik-lama small-box-footer py-3">Absen <i class="fas fa-arrow-circle-right"></i></a>
		            </div>
		        </div>
	    	<?php endforeach ?>
			<?php else: ?>
	        <div class="col-lg-6 col-12">
              	<?php 
              		$hari = $atribut['nama_hari'];
              		$tanggal = $atribut['tgl'];
              		$bulan = $atribut['bulan'];
              		$tahun = $atribut['tahun'];
              		$id = $id_pegawai.$tanggal.$bulan.$tahun;
              		$datang = $atribut['jam'].':'.$atribut['menit'];
              		$pulang = $atribut['jam'].':'.$atribut['menit'];

              		$ada = $this->db->get_where('t_jurnal_pegawai', ['id'=> $id])->row_array();
              	 ?>
              	 <?php if ( !$ada['pulang'] ): ?>
              	 	
	              	 <?php if ($ada < 1 ): ?>
			            <div class="small-box bg-light p-3">
			            <form method="post" action="absensi/simpanPegawai">
			              <div class="inner form-group">
			                <h4><?= $level['nama_rule'] ?></h4>
							<p id="latitude"></p>
			                <p id="longitude"></p> 
			                <p id="tampilkan"></p> 
			              </div>
			              <div class="icon">
			                <i class="fas fa-edit fa-sm"></i>
			              </div>
			              <input hidden type="text" value="<?= $id ?>" name="id">
			              <input hidden type="text" value="<?= $id_pegawai ?>" name="asatid_id">
			              <input hidden type="text" value="<?= $semester_id ?>" name="semester_id">
			              <input hidden type="text" value="<?= $hari ?>" name="hari">
			              <input hidden type="text" value="<?= $tanggal ?>" name="tanggal">
			              <input hidden type="text" value="<?= $bulan ?>" name="bulan">
			              <input hidden type="text" value="<?= $tahun ?>" name="tahun">
			              <input hidden type="text" value="<?= $datang ?>" name="datang">
			              <button type="submit"class="btn btn-success my-2 float-right mr-4">Hadir <i class="fas fa-arrow-circle-right"></i></button>
			          </form>
			              <br>
			              <br>
			              <br>
			            </div>
	              	 <?php else : ?>
	              	 	<div class="small-box p-3 ">
			            <form method="post" action="absensi/simpanPegawai">
			              <div class="inner form-group">
			                <h4><?= $level['nama_rule'] ?></h4>
							<p id="latitude"></p>
			                <p id="longitude"></p> 
			                <p id="tampilkan"></p> 
			                <label class="mt-3" for="">Kegiatan</label>
			                <input class="form-control" type="text" value="" list="fruits" name="kegiatan" required />
							<datalist id="fruits">
							  <option value="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione voluptatem similique iure praesentium cumque cupiditate numquam alias. Earum adipisci aspernatur assumenda cumque omnis unde delectus fugiat sit ex aliquam aut itaque, nulla voluptas nam totam illo excepturi numquam vitae error beatae. Dicta voluptate fugiat voluptatem, molestiae similique nulla dignissimos recusandae natus quia, hic doloremque fugit consequatur sunt cumque, mollitia error eaque necessitatibus reiciendis perferendis asperiores minima distinctio tenetur quo porro. Maiores voluptates sed doloribus beatae, explicabo nisi, minima quae, iusto facere modi sunt, commodi cumque ea sapiente deleniti quaerat dolor qui voluptatibus a ipsa libero. Voluptatibus odit, explicabo unde reiciendis."></option>
							</datalist>
			              </div>
			              <p class="text-right">Jam Kedatangan: <?= $ada['datang'] ?></p>
			              <div class="icon">
			                <i class="fas fa-edit fa-sm"></i>
			              </div>
			              <input hidden type="text" value="<?= $id ?>" name="id">
			              <input hidden type="text" value="<?= $pulang ?>" name="pulang">
			              <button type="submit"class="btn btn-warning my-2 float-right ">Pulang <i class="fas fa-arrow-circle-right text-light"></i></button>
			          </form>
			              <br>
			              <br>
			              <br>
			            </div>
	              	 <?php endif ?>
              	 <?php endif ?>
	        </div>
		<?php endif ?>
	   	</div>
    </div>
  </section>
</div>

<script>
   	getLocation();

	var lang = document.getElementById("latitude");
	var long = document.getElementById("longitude");
	var view = document.getElementById("tampilkan");

	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition, showError);
	    } else {
	        view.innerHTML = "Browser anda tidak support Geolocation, silahkan gunakan Google Chrome terbaru..";
	    }
	}
	 function showPosition(position) {
	    lang.innerHTML = "Latitude: " + position.coords.latitude; 
	    long.innerHTML = "Longitude: " + position.coords.longitude;
	     
	 }
	 
	 function showError(error) {
	 	console.log('hilangkan tombol absen');
	    switch(error.code) {
	        case error.PERMISSION_DENIED:
	            view.innerHTML = "<span class='text-danger'>Mohon izinkan pengaturan deteksi lokasi<span>"
	            break;
	        case error.POSITION_UNAVAILABLE:
	            view.innerHTML = "Info lokasi anda tidak jelas"
	            break;
	        case error.TIMEOUT:
	            view.innerHTML = "Request timeout"
	            break;
	        case error.UNKNOWN_ERROR:
	            view.innerHTML = "An unknown error occurred."
	            break;
	    }
	 }
</script>