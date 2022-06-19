<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css">

<style>
  @media only screen and (min-width: 769px) {
    .content-wrapper{
      padding-left: 5px;
    }
  }
  .lebar{
    padding:0px;
  }
  tbody tr td.tandai{
    border-left: 5px solid #7E4040
  }
  .table-border td, .table-border th{
    border-color: #8b8c8b !important;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Analisa hasil ujian</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lebar">
          
          <div class="card">
              <div class="card-header">
                <h5 class="card-title">pilihlah kelas berikut:</h5>
                <?php if (isset($semua_kelas)) : ?>
                  <?php $id=1; foreach ($semua_kelas as $sk): ?>
                    <a href="<?=base_url('kurikulum/analisa/').$sk['id_kelas']?>" class="kelas badge badge-success" style="font-size: 15px; font-weight: lighter;" id="<?= $id++?>" data-id="<?= $sk['id_kelas'] ?>" ><?=$sk['nama_kelas']?></a>
                  <?php endforeach ?>
                <?php endif ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button id ="klik" class="btn btn-success" data-toggle="collapse" data-target="#demo">#<?=$nama_kelas['nama_kelas']?></button>
                <div id="demo" class="collapse">
                  <table id="leger_nilai" class="table table-striped table-hover">
                    <thead>                  
                      <tr>
                        <th>#</th>
                        <th>Nama Santri</th>
                        <th>Suluk</th>
                        <?php foreach ($mapel_perkelas as $mk): ?>
                          <th><?=$mk['nama_mapel'] ?></th>
                        <?php endforeach ?>
                          <th>Rata-Rata</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($santri as $s): ?>
                      <tr>
                        <td><?=$no++;?></td>
                        <td><?= $s['nama_santri'] ?></td> 
                        <td><?= $suluk[$s['id_santri']] ?></td> 
                          <?php 
                            $nkh = 0; 
                            $nrp = 0; 
                            $jml_mapel = 0;                         
                          ?>
                          <?php foreach ($mapel_perkelas as $mk): ?>
                          <td>
                            <?php 
                              $nilai_mapel = 0; 
                              $jml_santri = 0; 
                            ?>
                            <?php foreach ($nilai_perkelas as $nilai): ?>
                              <?php
                                if ( $nilai['mapel_id'] == $mk['mapel_id'] and $nilai['santri_id'] ==  $s['id_santri'] ) {
                                  echo $nilai['nrp'];
                                  $nrp = $nrp + $nilai['nrp'];
                                  $nkh = $nkh + $nilai['nkh'];
                                  $jml_mapel = $jml_mapel + 1;
                                }
                                if ( $nilai['mapel_id'] == $mk['mapel_id'] ) {
                                    $nilai_mapel = $nilai_mapel + $nilai['nrp'];
                                    $jml_santri = $jml_santri + 1;
                                }
                              ?>
                            <?php endforeach ?>  
                            <?php
                              if ($nilai_mapel>0) {
                                $rata2mapel[$mk['mapel_id']] = round($nilai_mapel/$jml_santri,2) ;
                              }else{
                                $rata2mapel[$mk['mapel_id']] = 0;
                              }
                            ?>                  
                          </td>
                          <?php endforeach ?>
                          <?php 
                            $rata2santri = round($nrp/$jml_mapel,2);
                            $rata2kehadiran = round($nkh/$jml_mapel,2) ;
                          ?> 
                          <td><?=$rata2santri?></td>
                      </tr>
                        <?php
                          $nama = $s['nama_santri'];
                          $nilai_suluk = $suluk[$s['id_santri']];
                          $kolektif_suluk[$s['id_santri']] = $nilai_suluk;
                          $kolektif_ujian[$s['id_santri']] = $rata2santri;
                          $kolektif_kehadiran[$s['id_santri']] = $rata2kehadiran;
                          
                          $nilai_kreteria [$s['id_santri']] = [
                            'Aqidah' => null, //'Aqidah'
                            'Ilmu Akhlaq' => null, //'Ilmu Akhlaq'
                            'Fiqih' => null  //'Fiqih'
                          ];
  
                          ?>
                      <?php endforeach ?>                      
                    </tbody>
                  </table>  
                </div>
                <?php 
                  arsort($kolektif_ujian);
                  arsort($kolektif_suluk);
                  arsort($kolektif_kehadiran);
                  arsort($rata2mapel);

                  // var_dump($kolektif_ujian);
                  // var_dump($nilai_perkelas);

                  $suluk_tertinggi = array_slice($kolektif_suluk,0,3,true);
                  foreach ($suluk_tertinggi as $key => $value) {
                    $suluk_tertinggi_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $nilai_tertinggi = array_slice($kolektif_ujian,0,3,true);
                  foreach ($nilai_tertinggi as $key => $value) {
                    $nilai_tertinggi_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $kehadiran_tertinggi = array_slice($kolektif_kehadiran,0,3,true);
                  foreach ($kehadiran_tertinggi as $key => $value) {
                    $kehadiran_tertinggi_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $rata2mapel_tertinggi = array_slice($rata2mapel,0,3,true);
                  foreach ($rata2mapel_tertinggi as $key => $value) {
                    $rata2mapel_tertinggi_index [] = ['id_mapel'=>$key,'nilai'=>$value];
                  }

                  $suluk_terendah = array_slice($kolektif_suluk,-3,3,true);
                  asort($suluk_terendah);
                  foreach ($suluk_terendah as $key => $value) {
                    $suluk_terendah_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $nilai_terendah = array_slice($kolektif_ujian,-3,3,true);
                  asort($nilai_terendah);
                  foreach ($nilai_terendah as $key => $value) {
                    $nilai_terendah_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $kehadiran_terendah = array_slice($kolektif_kehadiran,-3,3,true);
                  asort($kehadiran_terendah);
                  foreach ($kehadiran_terendah as $key => $value) {
                    $kehadiran_terendah_index [] = ['id_santri'=>$key,'nilai'=>$value];
                  }
                  $rata2mapel_terendah = array_slice($rata2mapel,-3,3,true);
                  asort($rata2mapel_terendah);
                  foreach ($rata2mapel_terendah as $key => $value) {
                    $rata2mapel_terendah_index [] = ['id_mapel'=>$key,'nilai'=>$value];
                  }

                  // foreach ($nilai_perkelas as $nilai) {
                  //   //cek mapel aqidah(2), akhlaq(3), Fiqih (8)
                  //   if ($nilai["mapel_id"] == 2 || $nilai["mapel_id"] == 3 || $nilai["mapel_id"] == 8 ) {
                  //     //cek jika nilainya kurang dari 70
                  //     if ($nilai["nrp"] < 70) { 
                  //       if (isset($santri_tidak_memenuhi_kreteria[$nilai["santri_id"]])){
                  //         array_push($santri_tidak_memenuhi_kreteria[$nilai["santri_id"]], [
                  //           'mapel_id' => $nilai["mapel_id"] , 
                  //           'nrp'=>$nilai["nrp"]
                  //         ]);
                  //       }else{
                  //         $santri_tidak_memenuhi_kreteria[$nilai["santri_id"]] = [[
                  //           'mapel_id' => $nilai["mapel_id"] , 
                  //           'nrp'=>$nilai["nrp"]]
                  //         ];
                  //       }
                  //     }
                  //   }
                  // }

                  foreach ($nilai_perkelas as $nilai) {
                    if ($nilai["mapel_id"] == 2 || $nilai["mapel_id"] == 3 || $nilai["mapel_id"] == 8 ) {
                      $nilai_mapel_utama = $nilai['nrp'];
                      if ($nilai_mapel_utama < 70) {
                        $nama_mapel_utama = $this->um->showNamaMapel($nilai["mapel_id"])['mapel_alias'];
                        $nilai_kreteria [$nilai['santri_id']][$nama_mapel_utama] = $nilai_mapel_utama;
                      }else{
                        $nama_mapel_utama = $this->um->showNamaMapel($nilai["mapel_id"])['mapel_alias'];
                        unset($nilai_kreteria [$nilai['santri_id']][$nama_mapel_utama]);
                      }
                      $nilai_rata_santri = $kolektif_ujian[$nilai['santri_id']];
                      if ($nilai_rata_santri < 60 ) {
                        $nilai_kreteria [$nilai['santri_id']]['RataSantri'] = $kolektif_ujian[$nilai['santri_id']] ;
                      }
                      $nilai_suluk_santri = $kolektif_suluk[$nilai['santri_id']];
                      $nilai_suluk_de = substr($nilai_suluk_santri,-1) == 'D' || substr($nilai_suluk_santri,-1) == 'E';
                      if ($nilai_suluk_de){
                        $nilai_kreteria [$nilai['santri_id']]['Suluk'] = $nilai_suluk_santri ;
                      }
                    }
                  }
                  foreach ($nilai_kreteria as $key => $value) {
                    if (count($value) < 1) {
                      unset($nilai_kreteria[$key]);
                    }
                  }
                  ?>
                <hr class="my-4 py-4">

                <div class="row ml-1 mt-4">
                  <div class="col-lg-8 col-sm-12 mb-4">
                    <h5 class="text-center">Analisa Hasil Ujian</h5>
                    <div class="my-4">
                      <div class="row">
                        <div class="col-4 pl-0">Kelas</div>
                        <div class="col-8 text-bold pl-0">: <?= $nama_kelas['nama_kelas'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-4 pl-0">Nama Wali</div>
                        <div class="col-8 text-bold pl-0">: <?=$nama_wali['nama_asatid'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-4 pl-0">Semester</div>
                        <div class="col-8 text-bold pl-0">: <?= $this->tahunAktif['semester'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-4 pl-0">Tahun Pelajaran</div>
                        <div class="col-8 text-bold pl-0">: <?= $this->tahunAktif['nama_tahun'] ?></div>
                      </div>
                    </div>
                    <div class="row my-4 table-responsive">
                      <table class="table table-bordered table-sm table-striped">
                        <thead>
                          <tr>
                            <th>Santri dengan nilai</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Memenuhi kriteria *)</td>
                            <td><?= ($no-1)-count($nilai_kreteria) ?> santri</td>
                          </tr>
                          <tr>
                            <td>Tidak memenuhi kriteria</td>
                            <td><?= count($nilai_kreteria) ?> santri</td>
                          </tr>
                          <tr class="text-bold">
                            <td>Total</td>
                            <td><?=$no-1?> santri</td>
                          </tr>
                        </tbody>
                        </table>
                        <small class="text-bold my-0 text-secondary">__________________________</small> <br>
                        <small class="text-bold mb-0">*)</small> <br>
                        <div class="ml-2">
                          <small class="text-bold">1. Nilai mata pelajaran Aqidah, Ilmu Akhlaq, dan Fiqih minimal 70</small><br>
                          <small class="text-bold">2. Nilai suluk/prilaku minimal C</small><br>
                          <small class="text-bold">3. Nilai rata-rata dari semua mata pelajaran minimal 60</small><br>
                        </div>
                    </div>
                    <?php 
                      count($nilai_kreteria)>0 ? $tampil = '' : $tampil = 'd-none';
                    ?>
                    <div class="<?=$tampil?> row my-4 table-responsive">
                      <h6>Santri tidak memenuhi kriteria</h6>
                      <table class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                          <th>No</th>
                          <th>Santri</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>
                          <?php $no=1; foreach ($nilai_kreteria as $id => $stmk): ?>
                          <tr>
                            <td class="text-center"><?=$no++;?>.</td>
                            <td><?= $this->um->showNamaSantri($id)['nama_santri']?></td>
                            <td>
                              <?php foreach ($stmk as $ket=>$val) : ?>
                                <div class="badge badge-danger py-1">
                                  <?=$ket.': '.$val?>
                                </div>
                              <?php endforeach ?>
                            </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row my-4 table-responsive"">
                      <h6>Ringkasan nilai</h6>
                      <table class="table table-bordered table-stripped table-hover table-sm">
                        <thead>
                          <tr>
                            <th rowspan="2">Jenis nilai</th>
                            <th colspan="2" class="text-center bg-success">Tertinggi</th>
                            <th colspan="2" class="text-center bg-secondary">Terendah</th>
                          </tr>
                          <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                          </tr>
                        </thead>
                        <tbody class="text-nowrap">
                          <tr>
                            <td rowspan="3">Ujian</td>
                            <td><?=$this->um->showNamaSantri($nilai_tertinggi_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_tertinggi_index[0]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($nilai_terendah_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_terendah_index[0]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($nilai_tertinggi_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_tertinggi_index[1]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($nilai_terendah_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_terendah_index[1]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($nilai_tertinggi_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_tertinggi_index[2]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($nilai_terendah_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$nilai_terendah_index[2]['nilai']?></td>
                          </tr>
                          <tr>
                            <td rowspan="3">Suluk/prilaku</td>
                            <td><?=$this->um->showNamaSantri($suluk_tertinggi_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_tertinggi_index[0]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($suluk_terendah_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_terendah_index[0]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($suluk_tertinggi_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_tertinggi_index[1]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($suluk_terendah_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_terendah_index[1]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($suluk_tertinggi_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_tertinggi_index[2]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($suluk_terendah_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$suluk_terendah_index[2]['nilai']?></td>
                          </tr>
                          <tr>
                            <td rowspan="3">Kehadiran</td>
                            <td><?=$this->um->showNamaSantri($kehadiran_tertinggi_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_tertinggi_index[0]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($kehadiran_terendah_index[0]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_terendah_index[0]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($kehadiran_tertinggi_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_tertinggi_index[1]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($kehadiran_terendah_index[1]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_terendah_index[1]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaSantri($kehadiran_tertinggi_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_tertinggi_index[2]['nilai']?></td>
                            <td><?=$this->um->showNamaSantri($kehadiran_terendah_index[2]['id_santri'])['nama_santri']?></td>
                            <td><?=$kehadiran_terendah_index[2]['nilai']?></td>
                          </tr>
                          <tr>
                            <td rowspan="3">Rata-rata<br/>nilai mapel</td>
                            <td><?=$this->um->showNamaMapel($rata2mapel_tertinggi_index[0]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_tertinggi_index[0]['nilai']?></td>
                            <td><?=$this->um->showNamaMapel($rata2mapel_terendah_index[0]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_terendah_index[0]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaMapel($rata2mapel_tertinggi_index[1]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_tertinggi_index[1]['nilai']?></td>
                            <td><?=$this->um->showNamaMapel($rata2mapel_terendah_index[1]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_terendah_index[1]['nilai']?></td>
                          </tr>
                          <tr>
                            <td><?=$this->um->showNamaMapel($rata2mapel_tertinggi_index[2]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_tertinggi_index[2]['nilai']?></td>
                            <td><?=$this->um->showNamaMapel($rata2mapel_terendah_index[2]['id_mapel'])['mapel_alias']?></td>
                            <td><?=$rata2mapel_terendah_index[2]['nilai']?></td>
                          </tr>
                        </tbody>
                        </table>
                    </div>
                    
                  </div>

                </div>

            </div>

        </div>
      </div>
      
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

<script>
  $(document).ready(function() {
    // var table = $('#leger_nilai').DataTable( {
    //     scrollY:        "600px",
    //     scrollX:        true,
    //     scrollCollapse: true,
    //     paging:         false,
    //     fixedColumns:   {
    //         leftColumns: 2
    //     }
    // });
    klik = 0
    $('#klik').click(function(){
      klik = klik + 1
      if (klik == 1) {
        setTimeout(function(){
          table = $('#leger_nilai').DataTable( {
            scrollY:        "600px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   {
              leftColumns: 2
            }
          });
        }, 200);  
      }
    })

    $('#klik2').click(function(){
      // table.destroy();
      table = $('#leger_nilai').DataTable( {
        scrollY:        "600px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 2
        }
      });
    });

  });
</script>
