<style>
  .ling{
    border-radius: 20px 20px;
    width: 30px;
    height: 30px;
    padding: 2px;
    font-weight: bold;
  }
  .nama{
    font-size: 20px;
  }
  .judul{
    font-size: 18px;
    font-weight: bold;
    background-color: whitesmoke;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jurnal Mengajar</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mt-1">
        <div class="col-lg-6">
          <?php
            $cek = $this->am->cekJurnal($kbm['id_kbm'],$tanggal);
          ?>
          <form action="<?= base_url('absensi/simpanDaftarHadir') ?>" method="post">
            <div class="card text-center">
              <div class="card-header">
                <h5 class="card-title"><strong><?= $this->um->showNamaAsatid($kbm['id_asatid'])['nama_asatid']?></strong></h5>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $tanggal ?></h5>
                <h6 class="card-text">Jam ke: <?= $kbm['jamke'] ?>, Kelas: <?= $this->um->showNamaKelas($kbm['id_kelas'])['nama_kelas']?></h6>
                <p class="card-text"><strong><?= $this->um->showNamaMapel($kbm['id_mapel'])['mapel_alias']?></strong></p>

                <input type="text" value="<?= $kbm['id_kbm'] ?>" name="id_kbm" hidden="true">
                <input type="text" value="<?= $tanggal ?>" name="tanggal" hidden="true">

                <textarea class="rounded mt-2 py-4" name="materi" style="width:100%; text-align: center;" placeholder="Materi yang diajarkan" required oninvalid="this.setCustomValidity('Materi harus diisi..')" oninput="setCustomValidity('')"><?= isset($cek) ? $cek['materi'] : null ?></textarea>
                
              </div>
            </div>
            
            <div class=" mx-auto mt-2 p-3 alert alert-secondary alert-dismissible" id="alert">
	          <button type="button" class="close mx" data-dismiss="alert" aria-hidden="true">×</button>
	          <!-- <h4 class="mt-2 ml-3"><i class="fas fa-exclamation-triangle text-success mr-2"></i> Keterangan..!!</h4> -->
	         	<br>
	            <span class="btn btn-success ling mt-1">H</span>&nbsp&nbsp: Hadir <br>
	            <span class="btn btn-outline-success ling mt-1">D</span>&nbsp&nbsp: Dispensasi = tidak masuk kelas karena tugas kepesantrenan<br>
	            <span class="btn btn-primary ling mt-1">S</span>&nbsp&nbsp: Sakit<br>
	            <span class="btn btn-warning ling mt-1">I</span>&nbsp&nbsp: Izin<br>
	            <span class="btn btn-danger ling mt-1">A</span>&nbsp&nbsp: Tanpa keterangan<br>
	         
	        </div>

            <ul class="list-group">
              <li class="list-group-item judul ">Daftar Hadir Santri :</li>
              <?php $no=1; foreach ($santri as $sa): ?>
              
              <?php
                $absensi = $this->am->cekAbsensi($cek['id_jurnal'],$sa['id_santri']);
                
                $kelas = "btn btn-success";
                $huruf = "H";

                if (isset($absensi['absen']) and ($absensi['absen'] == 3)  ) {
                  $kelas = "btn btn-outline-success";
                  $huruf = "D";
                }
                if (isset($absensi['absen']) and ($absensi['absen'] == 2)  ) {
                  $kelas = "btn btn-primary";
                  $huruf = "S";
                }
                if (isset($absensi['absen']) and ($absensi['absen'] == 1)  ) {
                  $kelas = "btn btn-warning";
                  $huruf = "I";
                } 
                if (isset($absensi['absen']) and ($absensi['absen'] == 0)  ) {
                  $kelas = "btn btn-danger";
                  $huruf = "A";
                }
              ?>
              
              <input type="text" hidden="true" id="k-<?=$sa['id_santri']?>" name="kehadiran-<?=$sa['id_santri']?>" value="<?= isset($absensi['absen']) ? $absensi['absen'] : 4 ?>">

              <li class="list-group-item nama" id="<?=$sa['id_santri']?>"><span id="ket-<?=$sa['id_santri']?>" class="btn <?= $kelas ?> ling"><?= $huruf ?></span>  <?= $no++ .'. '. $sa['nama_santri'] ?></li>
              
              <?php endforeach ?>
            </ul>
            <button class="btn btn-success btn-block my-3" name="simpan">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  $( document ).ready(function() {
    $('.nama').click(function(){
      
      let id = $(this).attr('id');
      let nilai = $('#k-'+id+' ').val();
      
      if (nilai > 0) {
        nilai = nilai - 1;
      }else{
        nilai = 4;
      }
      
      $('#k-'+id+' ').val(nilai);

      if (nilai == 0) {
        $('#ket-'+id).replaceWith( '<span id="ket-'+id+'" class="btn badge-danger ling">A</span> ' );
      }
      if (nilai == 1) {
        $('#ket-'+id).replaceWith( '<span id="ket-'+id+'" class="btn btn-warning ling">I</span> ' );
      }
      if (nilai == 2) {
        $('#ket-'+id).replaceWith( '<span id="ket-'+id+'" class="btn btn-primary ling">S</span> ' );
      }
      if (nilai == 3) {
        $('#ket-'+id).replaceWith( '<span id="ket-'+id+'" class="btn btn-outline-success ling">D</span> ' );
      }
      if (nilai == 4) {
        $('#ket-'+id).replaceWith( '<span id="ket-'+id+'" class="btn btn-success ling">H</span> ' );
      }



    });
  });
</script>
