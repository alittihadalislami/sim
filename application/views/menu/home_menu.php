<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Managemen Menu dan Submenu</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card elevation-2">
            <div class="card-header bg-success">
              <a href="#" class="badge badge-outline-light elevation-2 float-right" data-toggle="modal" data-target="#modal-default">+ Submenu</a>
              <a href="#" class="badge badge-warning elevation-2 float-right mr-2" data-toggle="modal" data-target="#modal-default-2">+ Menu</a>
            </div>

            <div class="card-body">

              <div class="box">

                <div class="box-body no-padding">
                  
                  <table class="table table-sm table-striped">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Menu | Submenu</th>
                      <th>Status</th>
                      <th>Opsi</th>
                    </tr>
                    
                    <?php $no=1; foreach ($menu as $m): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $m->nama_menu ?></td>
                        <td><span class="badge badge-warning">menu</span></td>
                        <td>
                          <a href="<?= base_url() ?>menu/ubahMenu/<?=$m->id_menu?>" class="badge badge-primary">ubah</a>
                          <a href="<?= base_url() ?>menu/deleteMenu/<?= $m->id_menu.'/'.$m->kategori ?>" class="badge badge-danger">hapus</a>
                        </td>
                      </tr>
                      <?php $urut=1; foreach ($sub_menu as $s): ?>
                        <?php if ($s->menu_id == $m->id_menu): ?>
                          <td></td>
                            <td><?=($no-1).'.'.$urut++.' &nbsp '. $s->nama_submenu ?></td>
                            <td><span class="badge badge-success">Submenu</span></td>
                            <td>
                              <a href="#" class="badge badge-primary">ubah</a>
                              <a href="<?= base_url() ?>menu/deleteMenu/<?= $s->id_submenu.'/'.$s->kategori ?>" class="badge badge-danger">hapus</a>
                            </td>
                          </tr>
                        <?php endif ?>
                      <?php endforeach ?>
                    <?php endforeach ?>

                  </tbody></table>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section> 
    <div class="modal fade mt-5" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h3>Tambah submenu</h3>
          </div>
              <div class="modal-body bg-light">
                <div class="box-body">
                  <form action="<?= base_url('menu/aksiTambahSubmenu') ?>" method="post">
                    <div class="form-group">
                      <label for="headSubmenu">Menu</label>
                      <select class="form-control" name="menu_id" id="headSubmenu"  required="true">
                        <?php foreach ($menu as $m): ?> 
                          <option value="<?=$m->id_menu?>"><?=$m->nama_menu?></option>
                        <?php endforeach ?> 
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="namaSubmenu">Nama Submenu</label>
                      <input type="text" class="form-control" name="nama_submenu" id="namaSubmenu" placeholder="Nama Submenu">
                    </div>
                    <div class="form-group">
                      <label for="urlSubmenu">URL</label>
                      <input type="text" class="form-control" name="url" id="urlSubmenu" placeholder="URL Submenu">
                    </div>
                    <div class="form-group">
                      <label for="iconSubmenu">ICON</label>
                      <input type="text" class="form-control" name="icon" id="iconSubmenu" placeholder="URL Submenu">
                    </div>
                    <div class="form-group">
                      <label for="urutSubmenu">Urut</label>
                      <input type="text" class="form-control" name="urutan" id="urutSubmenu" placeholder="uruter Submenu">
                    </div>
                </div>
              </div>
              <div class="modal-footer bg-faded">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade mt-5" id="modal-default-2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h3>Tambah Menu</h3>
          </div>
              <div class="modal-body bg-light">
                <div class="box-body">
                  <form action="<?= base_url('menu/aksiTambahMenu') ?>" method="post">
                    <div class="form-group">
                      <label for="headMenu">Heading</label>
                      <select class="form-control" name="head_id" id="headMenu" placeholder="Menu" required="">
                        <option value="">Pilih head</option>
                        <?php foreach ($head as $h): ?> 
                          <option value="<?=$h->id_head?>"><?=$h->nama?></option>
                        <?php endforeach ?> 
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="namaMenu">Nama Menu</label>
                      <input type="text" class="form-control" name="nama_menu" id="namamenu" placeholder="Nama Menu">
                    </div>
                    <div class="form-group">
                      <label for="urlMenu">URL</label>
                      <input type="text" class="form-control" name="url" id="urlMenu" placeholder="URL Menu">
                    </div>
                    <div class="form-group">
                      <label for="iconMenu">ICON</label>
                      <input type="text" class="form-control" name="icon" id="iconMenu" placeholder="URL Menu">
                    </div>
                    <div class="form-group">
                      <label for="urutMenu">Urut</label>
                      <input type="text" class="form-control" name="urutan" id="urutMenu" placeholder="Urut Menu">
                    </div>
                </div>
              </div>
              <div class="modal-footer bg-faded">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </section>
</div>

