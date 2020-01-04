<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto;
    }
  }
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <?= $this->session->flashdata('pesan'); ?>
      <div class="col-md-6 mx-auto">

        <div class="card card-info mt-5">
          <div class="card-header">
            <h3 class="card-title">Mutasi Masuk</h3>
          </div>

          <div class="card-body">
            
            <form action="<?= base_url('santri/tambah_santri') ?>" method="post">

              <div class="form-group">
                <label for="asatid">Nama Santri</label>
                <input type="text" class="form-control" name="nama_santri" required="true">
              </div>
              <div class="form-group">
                <label for="asatid">Kelas</label>
                <input type="text" class="form-control" name="kelas" required="true">
              </div>
              <div class="form-group">
                <label for="asatid">Jenjang</label>
                <input type="text" class="form-control" name="jenjang" required="true">
              </div>
            

              <button type="sumbit" class="btn btn-primary float-right" name="simpan" value="simpan">Simpan</button>
            </form>

          </div>

        </div>
      </div>
    </div>
  </section>
</div>
