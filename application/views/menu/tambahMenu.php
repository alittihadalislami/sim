<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3" style="color: darkgreen">
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
              <form role="form">
                <div class="form-group">
                  <label for="namaMenu">Nama Menu</label>
                  <input type="text" class="form-control" id="namaMenu" placeholder="Nama Menu">
                </div>
                <div class="form-group">
                  <label for="urlMenu">URL</label>
                  <input type="text" class="form-control" id="urlMenu" placeholder="URL Menu">
                </div>
                <div class="form-group">
                  <label for="iconMenu">ICON</label>
                  <input type="text" class="form-control" id="urlMenu" placeholder="URL Menu">
                </div>
                <div class="form-group">
                  <label for="headMenu">Heading Menu</label>
                  <input type="text" class="form-control" id="headMenu" placeholder="Header Menu">
                </div>
                <button type="submit" class="btn btn-success float-right">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
