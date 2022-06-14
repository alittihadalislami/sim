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
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>UAMII <?= $str_tahun ?></h1>
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
                <h5 class="card-title float-left">Leger Nilai Ujian Akhir Ma'had Al Ittihad Al Islami</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="leger_nilai" class="table table-striped table-hover">
                  <thead>                  
                    <tr>
                      <?php $css = 'style="border-top: 5px solid darkgreen"'; ?>
                      <th>No</th>
                      <th>Nama Santri</th>
                      <th>Kelas</th>
                      <th>Nilai Suluk</th>
                      <?php foreach ($mapel as $m): ?>
                        <th><a href="<?= base_url('penilaian/uamii_form/').$m['id_mapel'] ?>"><?= $m['mapel_alias'] ?></a></th>
                      <?php endforeach ?>
                      <th><a href="<?php base_url()?>uamii_form_karya">Karya Ilmiyah</a></th>
                      <th>Jumlah</th>
                      <th>Rata-rata</th>
                    </tr>
                  </thead>
                  <tbody class="nilai_ijazah">
                    <?php $no=1; foreach ($santri as $s): ?>
                      <tr data-key="<?= $no ?>">
                        <td><?= $no++ ?></td>
                        <td data-key="<?=$s['id_santri']?>"><?= $s['nama_santri'] ?></td>
                        <td><?= $s['nama_kelas'] ?></td>
                        <td>
                          <?php
                            foreach ($suluk as $slk) {
                              if ($slk['santri_id'] == $s['id_santri']) {

                                if ($slk['slk'] == null) {
                                  $suluk_k = 'E';
                                }else{
                                  switch ( $slk['slk'] ) {
                                    case $slk['slk'] > 90 :
                                      $suluk_k = "A";
                                      break;
                                    case $slk['slk'] > 80 :
                                      $suluk_k = "B";
                                      break;
                                    case $slk['slk'] > 70 :
                                      $suluk_k = "C";
                                      break;
                                    case $slk['slk'] > 60 :
                                      $suluk_k = "D";
                                      break;
                                    default:
                                      $suluk_k = "E";
                                      break;
                                  } 
                                }
                                echo $suluk_k.'  ';
                                echo '('.round($slk['slk'],0).')';
                                }
                            }
                          ?>
                        </td>
                        <?php $nilai = 0; foreach ($mapel as $m): ?>
                          <td data-key="<?= $m['id_mapel'] ?>">
                            <?php 
                              echo $nilai_ijz = $this->km->nilaiIjz($s['id_santri'],$m['id_mapel'],$id_tahun)['ijz'] ;
                              $nilai += $nilai_ijz;
                            ?>
                          </td>
                        <?php endforeach ?>
                        <td data-key="kti">
                          <?php 
                            $karya_ilmiyah = null;
                            foreach ($karya as $k) {
                              if ($k['santri_id'] == $s['id_santri']) {
                                $karya_ilmiyah = $k['nilai_karya'];
                              }
                            }
                            echo $karya_ilmiyah;
                          ?>
                        </td>
                        <td data-key="jml">
                          <?php  
                            if ($nilai + $karya_ilmiyah > 0) {
                               echo $nilai + $karya_ilmiyah;
                             } 
                          ?>
                        </td>
                        <td data-key="rata">
                          <?php  
                            if ($nilai + $karya_ilmiyah > 0) {
                               echo round(($nilai + $karya_ilmiyah)/26,1);
                             } 
                          ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                                     
                  </tbody>
                </table>
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

    var table = $('#leger_nilai').DataTable({
        scrollY:        "600px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        }
    });
  });
</script>
