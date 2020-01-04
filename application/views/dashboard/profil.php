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
          <div class="card-header bg-success">
            <h3 class="card-title">Ubah No HP</h3>
          </div>
            <div class="card-body">
          <form action="<?= base_url() ?>dashboard/profil" method="post">

              <div class="judul">
                <label for=""><?= $asatid['nama']; ?></label>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="No. hp lama" value="<?= $asatid['nohp'] ?  $asatid['nohp'] : ''; ?>" readonly>
              </div>

              <?= form_error('nohp', '<div class="text-danger"><small>', '</small></div>');?>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="No. hp baru" name="nohp" type="number" required="true">
              </div>
                <input type="text" name="id_user" value="<?= $asatid['id_user'] ?>" hidden="true">
              <button type="sumbit" class="btn btn-primary float-right" name="simpan">Ubah</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>
