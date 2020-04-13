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
          <h1>UAMII 2020</h1>
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
                <h5 class="card-title float-left">Leger Nilai Uamii 2020</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="leger_nilai" class="table table-striped table-hover">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Nama Santri</th>
                      <th>Kelas</th>
                      <th>Nilai Suluk</th>
                      <?php foreach ($mapel as $m): ?>
                        <th><a href="<?= base_url('penilaian/uamii_form/').$m['id_mapel'] ?>"><?= $m['mapel_alias'] ?></a></th>
                      <?php endforeach ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($santri as $s): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $s['nama_santri'] ?></td>
                        <td><?= $s['nama_kelas'] ?></td>
                        <td>
                          <?php
                            foreach ($suluk as $slk) {
                              if ($slk['santri_id'] == $s['id_santri']) {
                                  echo $slk['slk'];
                                }  
                            }
                          ?>
                        </td>
                        <?php foreach ($mapel as $m): ?>
                          <td><?= $this->km->nilaiIjz($s['id_santri'],$m['id_mapel'],3)['ijz'] ?></td>
                        <?php endforeach ?>
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
    var table = $('#leger_nilai').DataTable( {
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
