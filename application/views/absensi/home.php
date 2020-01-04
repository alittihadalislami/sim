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
	              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
	              <div class="info-box-content">
	                <span class="info-box-number" style="font-size: 18px"><?= $jam; ?></span>
	                <span class="progress-description" style="font-size: 18px">
	                  <?= $tanggal; ?>
	                </span>
	              </div>
		        </div>
    		</div>
    	</div>

    	<?php foreach ($jadwal as $j): ?>
    	<div class="row">
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
	              <a href="<?= base_url('absensi/dhsantri/').$j['id_kbm']?>" class="small-box-footer py-3">Absen <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
	        </div>
	        <!-- <div class="col-lg-4 col-12">
	            <div class="small-box bg-secondary">
	              <div class="inner">
	                <h4>Selasa,  20 November 1989</h4>
	                <h5>Hari: Senin</h5>
	                <h5>Jam: 08.00 - 09.00</h5>

	                <p id="latitude">User Registrations</p>
	                <p id="longitude">User Registrations</p>
	              </div>
	              <div class="icon">
	                <i class="fas fa-edit fa-sm"></i>
	              </div>
	              <a href="<?= base_url('absensi/dhsantri') ?>" class="small-box-footer py-3">Absen <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
	        </div> -->
    	</div>
    	<?php endforeach ?>
    </div>
  </section>
</div>

<script>
   	getLocation();

	var lang = document.getElementById("latitude");
	var long = document.getElementById("longitude");
	// var view = document.getElementById("tampilkan");
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
	    switch(error.code) {
	        case error.PERMISSION_DENIED:
	            view.innerHTML = "Yah, mau deteksi lokasi tapi ga boleh :("
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