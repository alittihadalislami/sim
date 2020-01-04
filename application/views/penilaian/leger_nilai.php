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
          <h1>Rekapitulasi</h1>
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
                <h5 class="card-title">Kompetensi Dasar (KD)</h5>
                <?php if (isset($semua_kelas)) : ?>
                  <?php $id=1; foreach ($semua_kelas as $sk): ?>
                    <a href="#" class="kelas badge badge-success" style="font-size: 15px; font-weight: lighter;" id="<?= $id++?>" data-id="<?= $sk['id_kelas'] ?>" ><?=$sk['nama_kelas']?></a>
                  <?php endforeach ?>
                <?php endif ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h1 id="kls_terpilih" class="badge badge-success" style="font-size: 30px; font-weight: lighter;">#<?=$nama_kelas['nama_kelas']?></h1>
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
                        <?php $rata = 0; $jmlh = 0; foreach ($mapel_perkelas as $mk): ?> 
                          <td>
                          <?php foreach ($nilai_perkelas as $nilai): ?>
                            <?php
                                if ( $nilai['mapel_id'] == $mk['mapel_id'] and $nilai['santri_id'] ==  $s['id_santri'] ) {
                                  echo $nilai['nrp'];
                                  $rata = $rata + $nilai['nrp'];
                                  $jmlh = $jmlh + 1;
                                }
                                ?>
                           
                          <?php endforeach ?>                    
                        </td>
                        <?php endforeach ?>
                        <td><?= round($rata/$jmlh,2) ?></td>
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
