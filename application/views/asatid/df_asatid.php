<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6 mx-auto">

        <div class="card card-info mt-5">
          <div class="card-header">
            <h3 class="card-title">Asatidz Ma'had Al Ittihad Al Islami</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>No HP</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($asatid as $as): ?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?= $as['nama_asatid']; ?></td>
                    <td><?= $as['nohp']; ?></td>
                    <td><a href="<?=base_url('asatid/input/').$as['id_asatid']?>" class="badge <?=$as['nohp'] == null ? ' bg-danger' : ' bg-primary'?>">input</a></td>
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
