<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3" >
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Menu Manejemen</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card elevation-2">
            <div class="card-header bg-success">
              <h5><?= $judul ?></h5>
            </div>
            <div class="card-body">
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
