<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Entry Tambahan Wali Kelas</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <table class="table table-small" id="tambahan">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach ($santri as $sant): ?>
              
              <tr>
                <th scope="row"><?=$no++; ?></th>
                <td><?=$sant['nama_santri'] ?></td>
                <td>
                  <?php 
                  $ada = $this->um->cekEntry($sant['id_santri'], $kelas_id, $tahun_id);  
                  echo $ada != null ? '<span class="badge badge-primary">ok<span>' : '<span class="badge badge-secondary">belum<span>';
                  ?>
                </td>
                <td>
                  <a class="btn btn-primary" href="<?=base_url('penilaian/f_entry/').$sant['id_santri'].'/'.$kelas_id.'/'.$tahun_id ?>"><i class="fas fw fa-edit"></i> Entry</a>
                </td>
              </tr>
            <?php endforeach ?>
            </tbody>
          </table>

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
    var table = $('#tambahan').DataTable( {
        scrollCollapse: true,
        paging:         false,
        "searching"  : false
    });
  });
</script>
