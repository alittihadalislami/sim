
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="box elevation-2 p-2 mb-2" style="border-top: 6px solid green; background-color: white; border-radius: 15px;">
            <div class="box-header mt-5">
             <h4 style="text-align: center;">Rekapitulasi Absensi Kehadiran Asatidz <br/>Bulan: Agustus 2019</h4>
            </div>
            <div class="box-body table-responsive no-padding mt-1 p-3">
              <table class="table table-small table-hover table-bordered">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                    <?php for ($i=1; $i<=31 ; $i++) :?>
                      <th style="width: 40px"><?= $i ?></th>
                    <?php endfor ?>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($rekap_semua as $k => $rs): ?>    
                <tr>
                  <?php  
                    echo '<td>'.$no++.'</td>';
                    echo '<td>'.$k.'</td>';
                    for ($i=1; $i <=31 ; $i++) { 
                      echo '<td>';
                      foreach ($rekap_semua[$k]['jamke'] as $tgl => $jamke) {
                        if ($tgl == $i) {
                          echo count($jamke);
                        }
                      }
                      echo'</td>';
                    }
                    echo '<td>'.$rs['total'].'</td>';
                  ?>
                </tr>
                <?php endforeach ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </div>
  </section>
</div>
