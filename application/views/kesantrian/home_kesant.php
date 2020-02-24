<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="p-3"><?= $judul ?></h3>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8 col-md-6 bg-white py-3 elevation-4">
          
          <table id="daftar-minat" class="table table-sm table-striped table-bordered">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Nama minat</th>
                  <th>Kategori</th>
                  <th>Anggota</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($minat as $m): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <a class="alert-link alert-heading" href="<?= base_url('kesantrian/klub/'.$m->id_minat)?>"><?=$m->nama_minat?></a>
                  </td>
                  <td><?= $m->kategori_minat ?></td>
                  <td><?= $this->sm->santriPerKlub($m->id_minat) ?></td>
                </tr>
              <?php endforeach ?>

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </section>
</div>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {

      $('#daftar-minat').DataTable( {
      })

  });
</script>