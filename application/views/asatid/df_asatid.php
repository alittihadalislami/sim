<style>
  body.modal-open .modal {
    display: flex !important;
    height: 100%;
} 

body.modal-open .modal .modal-dialog {
    margin: auto;
}
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card card-secondary mt-5">
          <div class="card-header">
            <span class="card-title">Asatidz Ma'had Al Ittihad Al Islami</span>
            <a href="#" class="btn btn-sm btn-outline-success float-right mt-2" data-toggle="modal" data-target="#modal"><i class="fas fa-plus"></i> Tambah</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>NIY</th>
                  <th>No HP</th>
                  <th>Gol</th>
                  <th>Status</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($asatid as $as): ?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><a class="text-dark" href="<?=base_url('asatid/detail/').$as['niy']?>"><b><?= $as['nama_asatid']; ?></b></a></td>
                    <td><?= $as['niy'] == 0 ? '' : $as['niy']  ?></td>
                    <td><?= $as['nohp']; ?></td>
                    <td><?= $as['kategori'] ==  1 ? '<span class="badge badge-success"> Guru </span>' : '<span class="badge badge-info badge-warning" > Pegawai </span>' ?></td>
                    <td><?= $as['sts'] == 1 ? '<span class="badge badge-success"> Aktif </span>' : '<span class="badge badge-secondary"> Nonaktif</span>' ?></td>
                    <td><a href="<?=base_url('asatid/input/').$as['id_asatid']?>"><i class="fas fa-edit"></i></a></td>
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

<div class="modal fade" id="modal" style="display: none;" >
  <div class="modal-dialog" style="width: 500px">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Civitas</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url()?>asatid/tambahCivitas" method="POST" >
          <div class="form-group">
            <label for="nama_asatid">Nama asatid</label>
            <input type="text" class="form-control" name="nama_asatid" id="namaasatid" placeholder="Nama asatid">
          </div>
          <div class="form-group">
            <label for="nohp_asatid">HP asatid</label>
            <input type="text" class="form-control" name="nohp" id="nohp_asatid" placeholder="No hp asatid">
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" name="kategori" id="kategori"  required="true">
                <option value="">pilih</option>
              <?php foreach ($kategori as $k => $v): ?> 
                <option class="text-capitalize" value="<?=$k?>"><?=$v?></option>
              <?php endforeach ?> 
            </select>
          </div>
          </div>
           <input type="text" name="sts" value="1" hidden="true">
           <input type="text" name="tetap" value="0" hidden="true">
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
