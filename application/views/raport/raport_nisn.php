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
          <h1>Entry NISN</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <table class="table table-small table-straped" id="tambahan">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>NISN</th>
              </tr>
            </thead>
            <tbody>
              <form action="" method="post">
                <?php $no=1; foreach ($santri as $sa): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $sa['nama_santri'] ?></td>
                    <?php
                      $id_santri = $sa['id_santri'];
                      $hasil = $this->db->get_where('m_santri', ['id_santri' => $id_santri])->row_array();
                      $nisn = $hasil['nisn'];

                      if ( !isset($nisn) ) {
                        $nisn = null;
                      } 
                    ?>
                    <td><input type="number" class="form-control" name="nisn-<?=$id_santri?>" value="<?= $nisn ?>"></td>
                  </tr>
                <?php endforeach ?>
            </tbody>
          </table>
                <button class="btn btn-primary float-right mb-5" type="submit" name="simpan" value="simpan">Simpan</button>
              </form>
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
        "bInfo" : false
        scrollCollapse: true,
        paging:         false,
        "searching"  : false
    });
  });
</script>
