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
    .under-kkm{
      color: red;
      font-weight: bold;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kelas : <?php $kelas = $this->um->showNamaKelas($this->uri->segment(3)); echo $kelas['nama_kelas'].' / '.$kelas['kelas_alias'] ?></h1>
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
                <h5 class="card-title">Daftar Nilai Kolektif <a href="<?= base_url('raport/InsertDknRaport/').$this->uri->segment(3).'/'.$this->uri->segment(4) ?>"><i class="fa fa-paper-plane text-danger"></i></a></h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h1 id="kls_terpilih" class="badge badge-success" style="font-size: 30px; font-weight: lighter;"></h1>
                
                <table id="dkn" class="table table-striped table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                    <?php foreach ($mapel as $mp): ?>
                      <?php 
                        $mapel_id = $mp['mapel_id'];
                        $kelas_id = $this->uri->segment(3);
                        $kkm = $this->rm->kkm($kelas_id, $mapel_id, $this->tahunAktif['id_tahun'])
                      ?>
                      <th colspan="2"><?=$mp['nama_mapel'].'<br>(P-K)'?><br><span class="badge badge-success">KKM: <?=$kkm?></span></th>
                    <?php endforeach ?>
                    </tr>
                  </thead>                             
                  <tbody>
                    <?php $no=1; foreach ($dkn as $dk) : ?>
                    <tr>
                      <td><?=$no++ ?></td>
                      <td><?= $dk['nama_santri'] ?></td>
                      <?php foreach ($dk['mapel'] as $idm => $dt): ?>
                      <?php
                      if (isset($dk['mapel'][$idm]['p']) and isset($dk['mapel'][$idm]['k'])) {
                        $p = $dk['mapel'][$idm]['p'] ; 
                        $k = $dk['mapel'][$idm]['k'] ; 
                        $mapel_id = $dk['mapel'][$idm]['mapel_id'];
                        $kelas_id = $this->uri->segment(3);
                        $kkm = $this->rm->kkm($kelas_id, $mapel_id, $this->tahunAktif['id_tahun']);
                       } 
                      ?>
                        <td <?= $p<$kkm? 'class="under-kkm"':null ?> ><?= $p ?></td>
                        <td <?= $k<$kkm? 'class="under-kkm"':null ?> ><?= $k ?></td>
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
    var table = $('#dkn').DataTable( {
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
