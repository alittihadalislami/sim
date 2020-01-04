<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<style>
    @media only screen and (min-width: 769px) {
    .content-wrapper{
      padding-left: 5px;
    }
  }
    .lebar{
      padding:0px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Status Nilai</h1>
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
                <h3 class="card-title">Data Nilai Masuk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="sts_nilai" class="table table-bordered table-hover table-responsive table-small">
                  <thead>                  
                    <tr>
                      <th style="width: 5%">#</th>
                      <th style="width: 25%">Mapel</th>
                      <th style="width: 20%">Kelas</th>
                      <!--<th style="width: 5%">KD</th>-->
                      <th style="width: 5%">NH</th>
                      <th style="width: 5%">NA</th>
                      <th style="width: 40%">pengajar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($sts_nilai as $sts): ?>                    
                      <tr>
                        <td><?= $no++;?></td>
                        <td><?= $nama_mapel[$sts['mapel_id']];?></td>
                        <td><?= $nama_kelas[$sts['kelas_id']][0].' / '.$nama_kelas[$sts['kelas_id']][1];?></td>
                        <!--<td><span class="badge <?= $sts['kd'] > 0 ? 'badge-success' : 'badge-danger' ;?>"><?= $sts['kd'];?></span></td>-->
                        <td><span class="badge <?= $sts['nh'] > 0 ? 'badge-success' : 'badge-danger' ;?>"><?= $sts['nh'];?></span></td>
                        <td><span class="badge <?= $sts['na'] > 0 ? 'badge-success' : 'badge-danger' ;?>"><?= $sts['na'];?></span></td>
                        <td><?= $nama_asatid[$sts['asatid_id']];?></td>
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
<script>
  $(document).ready(function() {
    $('#sts_nilai').DataTable({
      "pageLength": 50
    });
} );
</script>
