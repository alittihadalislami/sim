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
                <h3 class="card-title">Keseluruhan Santri</h3>
                <!-- <a href="<?= base_url()?>santri/tambah_santri" class="float-right tambah"><i class="fas fa-plus text-success"></i> Tambah data santri</a> -->
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="santri" class="table table-bordered table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>ID Santri</th>
                      <th>Induk MII</th>
                      <th data-priority="1">Nama Santri</th>
                      <th data-priority="1">Kelas</th>
                      <th>Data</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($santri as $str): ?>                    
                      <tr>
                        <td><?= $no++;?></td>
                        <td><?= $str['id_santri'];?></td>
                        <td><?= $str['idk_mii'];?></td>
                        <td><?= $str['nama_santri'];?></td>
                        <td><?= $str['nama_kelas'];?></td>
                        <td class="sts">26 /
                          <?php
                          $ada = $this->km->adaDetail($str['id_santri']);
                          if ($ada > 0 ) {
                            foreach ($detail_terisi as $dt) {
                              if ($dt['santri_id'] == $str['id_santri']) {
                                echo $dt['isian'];
                              }
                            }
                          }else{
                            echo 0;
                          }
                          ?>
                        </td>
                        <td>
                          <a class="pl-3" href="<?= base_url('santri/edit/').$str['id_santri']?>"><i class="fas fa-edit text-primary"></i></a> 
                          <?php if ($this->session->userdata('rule_id') < 6): ?>
  	                        &nbsp&nbsp&nbsp
  	                        <a class="pl-3" href="<?= base_url('raport/identitas/').$str['id_santri']?>"><i class="fas fa-list-ol text-success"></i></a> 
                            <a class="ml-3 pl-3" href="<?= base_url('santri/non_aktif/').$str['id_santri']?>" onclick="return confirm('Yakin, mengeluarkan <?= $str['nama_santri'];?> dari kelas <?= $str['nama_kelas'];?> ??');"><i class="fas fa-share-square text-secondary"></i></a>
                          <?php endif ?>
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


<!-- load js datatable -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script>
  $(document).ready(function() {
    
    $('#santri').dataTable( {
      "columnDefs": [{ 'visible': false, 'targets': [2] }]
    });
  });
</script>
