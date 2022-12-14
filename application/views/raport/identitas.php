<style>
    .blink {
        animation: blinker 1.5s linear infinite;
        color: red;
        font-family: serif;
        font-weight: 800;
        font-size: 36px;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="text-align: center;">IDENTITAS SANTRI</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col elevation-1" id="isi">
           <table >
            <?php $id=0; $no=1; foreach ($kol as $k): ?>
             <tr style="height: 23px">
               <td style="width: 300px ; font-size: 17px; ">
                <?php 
                  $sub = substr($k,1,1);
                  if ($sub == '.') {
                    echo '&nbsp&nbsp&nbsp&nbsp'.$k;
                  }else{
                     echo $no++.'. '.$k;
                  }
                ?>
                </td>
               <td>:</td>
               <td style="width: 500px; padding-left: 10px; font-size: 17px;">
                <?php
                $id++;

                if ($id == '4') {
                    echo $jenis;
                  }
                
                if (
                    $id != '4'
                    ){
                    echo $detail[$id];
                }
                if ($id == '2') {
                    echo $idk_mii;
                  }
                ?>
               </td>
             </tr>
            <?php endforeach ?>
           </table>
           <br>
           <div  style="border: 1px solid grey; height:110px; width:75px; float:left; font-size: 17px; margin-left: 100px; margin-top: 40px;"></div>
           <div class="kepala" style="font-size: 17px; margin-left: 450px"> 
                <?php
                  $tahun = $tanggal[2];
                  $bulan = $tanggal[1];
                  $hari = $tanggal[0];

                  switch ($bulan) {
                    case "01":
                      $bulan = 'Januari';
                      break;
                    case "02":
                      $bulan = 'Februari';
                      break;
                    case "03":
                      $bulan = "Maret";
                      break;
                    case "04":
                      $bulan = "April";
                      break; 
                    case "05":
                      $bulan = "Mei";
                      break;  
                    case "06":
                      $bulan = 'Juni';
                      break;
                    case "07":
                      $bulan = 'Juli';
                      break;
                    case "08":
                      $bulan = "Agustus";
                      break;
                    case "09":
                      $bulan = "September";
                      break;
                    case "10":
                      $bulan = "Oktober";
                      break;
                    case "11":
                      $bulan = "November";
                      break;
                    case "12":
                      $bulan = "Desember";
                      break;
                    default:
                      $bulan = "Juli";
                  }

                ?>
                <div>Sampang, <?=$hari.' '.$bulan.' '.$tahun?></div>
                <div>Mengetahui,</div>
                <div>Mudir Ma'had</div>
                <div style="margin-top: 90px; font-weight: bold;">Dr. Achmad Junaidi, Lc., MA.</div>
                <div>NIY. 940613045</div>
           </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div style="page-break-after: always;"> </div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="text-align: center;">IDENTITAS SISWA</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col elevation-1" id="isi">
           <table >
          
            <?php $id=0; $no=1; foreach ($kol as $k): ?>
             <tr style="height: 23px">
               <td style="width: 300px ; font-size: 17px; ">
                <?php 
                  $id++;
                  $sub = substr($k,1,1);
                  if ($sub == '.') { // atur indent sub bagian
                    echo '&nbsp&nbsp&nbsp&nbsp'.$k;
                  }else{
                    if ($id == 10) { // mengubah ma'had jadi sekolah
                      echo $no++.'. Diterima di Sekolah ini';
                    }
                    if ($id == 1) { // santri => Peserta didik 
                      echo $no++.'. Nama Peserta Didik';
                    }

                    if ($id != 10 && $id!=1){
                      echo $no++.'. '.$k;
                    }
                  }
                ?>
                </td>
               <td>:</td>
               <?php
                    if ($id == '3' || $id== '12' ) {
                        $class = "format-tgl";
                    }else {
                        $class = '';
                    }
               ?>
               <td class="<?= $class ?>" style="width: 500px; padding-left: 10px; font-size: 17px;">
                <?php
                  if ($id == '11') {
                    echo $kelas_terima;
                  }
                  if ($id == '12') {
                    echo $tgl_terima;
                  }
                  if ($id == '4') {
                    echo $jenis;
                  }
                  if (
                    $id != '4' AND
                    $id != '11' AND
                    $id != '12' 
                  ) {
                    echo $detail[$id];
                  }
                  if ($id == '2') {
                    echo $induk_sm;
                  }
                ?>  
                </td>
             </tr>
            <?php endforeach ?>
           
           </table>
           <br>
            <div  style="border: 1px solid grey; height:110px; width:75px; float:left; font-size: 17px; margin-left: 100px; margin-top: 40px;"></div>
                <?php
                if (!isset($tanggal_sm[2]) ) {
                    echo '<div class="blink"> Tanggal diterima/awal sekolah belum diisi, silahkan isi di menu <a href='.base_url().'santri/edit/'.$santri_id.'>edit</a> !</div>';
                    die();
                  }
                ?>
           <div class="kepala" style="font-size: 17px; margin-left: 450px"> 
                  <?php
                  $tahun = $tanggal_sm[2];
                  $bulan = $tanggal_sm[1];
                  $hari = $tanggal_sm[0];

                  switch ($bulan) {
                    case "01":
                      $bulan = 'Januari';
                      break;
                    case "02":
                      $bulan = 'Februari';
                      break;
                    case "03":
                      $bulan = "Maret";
                      break;
                    case "04":
                      $bulan = "April";
                      break; 
                    case "05":
                      $bulan = "Mei";
                      break;  
                    case "06":
                      $bulan = 'Juni';
                      break;
                    case "07":
                      $bulan = 'Juli';
                      break;
                    case "08":
                      $bulan = "Agustus";
                      break;
                    case "09":
                      $bulan = "September";
                      break;
                    case "10":
                      $bulan = "Oktober";
                      break;
                    case "11":
                      $bulan = "November";
                      break;
                    case "12":
                      $bulan = "Desember";
                      break;
                    default:
                      $bulan = "Juli";
                  }
                ?>
                <div>Sampang, <?=$hari.' '.$bulan.' '.$tahun?></div>
                <div>Mengetahui,</div>
                <div>Kepala <?= $jenjang ?></div>
                <div style="margin-top: 90px; font-weight: bold;"><?= $kepala ?>
                </div>
                <div>NIY. <?= $niy ?></div>
           </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
    document.title = "<?php echo  $detail[1] ?>"
    function namaBulan(bulan) {
        bulanText = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        bulan = parseInt(bulan)
        if (bulan >=1 && bulan<=12 ) {
            return(bulanText[bulan-1])
        }else{
            return 'range salah'
        }
    }
    objek = document.querySelectorAll('.format-tgl')
    objek.forEach(element => {
        hasil = element.innerText.split("-")
        element.innerText = hasil[0] +' '+ namaBulan(hasil[1]) +' '+ hasil[2] 
    });
</script>

