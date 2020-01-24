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
          <h1>Rekapitulasi Absensi SIM</h1>
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
                <h3 class="card-title"><?= $atribut[0] .' - '.$atribut[1]; ?></h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="santri" class="table table-sm table-bordered table-hover" width="100%">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Nama Asatid</th>
                      <th>Jumlah Hadir</th>
                      <?php for ($i=1; $i <= 31 ; $i++) : ?> 
                        <th data-priority="1"><?= $i ?></th>
                      <?php endfor?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($rekap_semua as $k => $rs): ?>    
                      <tr>
                        <?php  
                          echo '<td>'.$no++.'</td>';
                          echo '<td>'.$k.'</td>';
                          echo '<td class="text-center">'.$rs['total'].'</td>';
                          for ($i=1; $i <=31; $i++) { 
                            echo '<td>';
                            foreach ($rekap_semua[$k]['jamke'] as $tgl => $jamke) {
                              if ($tgl == $i) {
                                echo count($jamke);
                              }
                            }
                            echo'</td>';
                          }
                        ?>
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
    $('#santri').dataTable({
      "columnDefs": [ {
        "targets": 0,
        "orderable": false
        }]
    });
  });
</script>