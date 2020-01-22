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
          <h1>Daftar Santri Dalam Klub</h1>
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
              <div class="card-header bg-success">
                <h3 class="card-title">Santri</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="santri" class="table table-sm table-bordered table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Induk MII</th>
                      <th data-priority="1">Nama Santri</th>
                      <th data-priority="1">Kelas Santri</th>
                      <th data-priority="2">Minat Santri</th>
                      <th data-priority="2">Kategori Minat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($klub as $str): ?>                    
                      <tr>
                        <td><?= $no++;?></td>
                        <td><?= $str['idk_mii'];?></td>
                        <td><?= $str['nama_kelas'];?></td>
                        <td><?= $str['nama_santri'];?></td>
                        <td><?= $str['nama_minat'];?></td>
                        <td><?= $str['kategori_minat'];?></td>
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
    $('#santri').dataTable();
  });
</script>
