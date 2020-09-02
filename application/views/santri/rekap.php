<!-- load datatable boostrap css -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Santri</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg lebar">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rekapitulasi Santri</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <table id="santri" class="table table-bordered table-hover display responsive">
                      <thead>                  
                        <tr>
                          <th>Nama Kelas</th>
                          <?php $total_semua = 0; foreach ($atribut['rombel'] as $r): ?>
                            <th><?= $r ?></th>
                          <?php endforeach ?>
                          <th>Putra</th>
                          <th>Putri</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                        <?php  foreach ($atribut['kelas'] as $k): ?>
                          <tr>
                            <td><?= $k ?></td>
                            <?php foreach ($atribut['rombel'] as $r): ?>
                              <td><?php 
                                foreach ($rekap as $rkp) {
                                  if ($rkp['nama_kelas'] == $k.$r) {
                                    echo $rkp['jumlah'];
                                  }
                                }
                                ?>
                              </td>
                            <?php endforeach ?>    
                            <td>
                              <?php
                                $jumlah_tra = 0;
                                foreach ($rekap as $rkp) {
                                  if($rkp['rombel'] == $k
                                      AND $rkp['tra_tri'] == 'tra') {
                                    $jumlah_tra += $rkp['jumlah'];
                                  }
                                }
                                echo $jumlah_tra;
                              ?>
                            </td>
                            <td>
                              <?php
                                $jumlah_tri = 0;
                                foreach ($rekap as $rkp) {
                                  if($rkp['rombel'] == $k
                                      AND $rkp['tra_tri'] == 'tri') {
                                    $jumlah_tri += $rkp['jumlah'];
                                  }
                                }
                                echo $jumlah_tri;
                              ?>
                            </td>
                            <td>
                              <?php
                                $total_kelas = 0;
                                foreach ($rekap as $rkp) {
                                  if ($rkp['rombel'] == $k) {
                                    $total_kelas += $rkp['jumlah'];
                                  }
                                }
                                $total_semua += $total_kelas;
                                echo $total_kelas;
                              ?>
                            </td>
                          </tr>
                        <?php endforeach ?>
                        <tr>
                          <td colspan="7" style="text-align: right;"><b>JUMLAH</b></td>
                          <td><?= $total_semua ?></td>
                        </tr>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table id="santri" class="table table-bordered table-hover display responsive">
                      <thead>                  
                        <tr>
                          <th>Tingkat</th>
                          <th>Putra</th>
                          <th>Putri</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                        <?php  
                          $tingkat = [1=>'SMP', 'MA', 'Takhassus'];
                          $total_tra = 0 ;
                          $total_tri = 0 ;
                        ?>
                        <?php  for ($i=1; $i<=3; $i++): ?>
                          <tr>
                            <td><?= $tingkat[$i] ?></td>
                            <td>
                              <?php $jumlah_tra=0; foreach ($rekap as $rkp) {
                                if ($rkp['jenjang'] == $i && $rkp['tra_tri']=='tra') {
                                  $jumlah_tra += $rkp['jumlah'];
                                }                           
                              }
                              echo $jumlah_tra;
                              $total_tra += $jumlah_tra;
                              ?>
                            </td>
                            <td>
                              <?php $jumlah_tri=0; foreach ($rekap as $rkp) {
                                if ($rkp['jenjang'] == $i && $rkp['tra_tri']=='tri') {
                                  $jumlah_tri += $rkp['jumlah'];
                                }                           
                              }
                              echo $jumlah_tri;
                              $total_tri += $jumlah_tri;
                              ?>
                            </td>
                            <td><?= $jumlah_tri+$jumlah_tra ?></td>
                          </tr>
                        <?php endfor ?>
                        <tr>
                          <td style="text-align: right;"><b>JUMLAH</b></td>
                          <td><?= $total_tra ?></td>
                          <td><?= $total_tri ?></td>
                          <td><?= $total_tra+$total_tri ?></td>
                        </tr>
                      <tbody>
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


<!-- load js datatable -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script>
  $(document).ready(function() {
    
  });
</script>
