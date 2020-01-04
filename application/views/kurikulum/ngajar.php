<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
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
    .tambah{
      position: absolute;
      right: 22px;
      top:15px;
      padding-bottom:0; 
      padding-top:0;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Asatid Mengajar</h1>
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
                <h3 class="card-title">Asatid Mengajar</h3>
                <a href="<?= base_url()?>kurikulum/tambah_ngajar" class="float-right tambah"><i class="fas fa-plus text-success"></i> Tambah data mengajar</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="sts_nilai" class="table table-bordered table-hover table-responsive table-small">
                  <thead>                  
                    <tr>
                      <th style="width: 10%">#</th>
                      <th style="width: 10%">Mapel</th>
                      <th style="width: 20%">Kelas</th>
                      <th style="width: 30%">Pengajar</th>
                      <th style="width: 20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($sts_nilai as $sts): ?>                    
                      <tr>
                        <td><?= $no++;?></td>
                        <td><?= $nama_mapel[$sts['mapel_id']];?></td>
                        <td><?= $nama_kelas[$sts['kelas_id']][0].' / '.$nama_kelas[$sts['kelas_id']][1];?></td>
                        <td><?= $nama_asatid[$sts['asatid_id']];?></td>
                        <td>
                          <a class="pl-3" href="#"><i class="fas fa-edit text-primary"></i>Edit</a>
                          <a class="pl-3" href="<?= base_url('kurikulum/hapus/').$sts['id_mengajar']?>" onclick="return confirm('Yakin, menghapus data? ?');"><i class="fas fa-trash-alt text-danger"></i> Hapus</a>
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
<script>
  $(document).ready(function() {
    $('#sts_nilai').DataTable();
} );
</script>
