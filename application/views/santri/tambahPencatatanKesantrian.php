<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

        <div class="card card-success mt-5">
          <div class="card-header">
            <h3 class="card-title">Catatan Santri</h3>
          </div>

          <div class="card-body">
            
            <form action="<?= base_url('santri/tambahPencatatanKesantrian') ?>" method="post">
              <div class="form-group">
                <label for="santri_id">Nama Santri</label>
                <select class="form-control pilih" name="santri_id" id="santri_id" required="true">
                <option value="">--pilih--</option>
                  <?php foreach ($santri as $s): ?>
                    <option value="<?=$s['id_santri'] ?>"><?=$s['nama_santri'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="jenis_catatan_id">Jenis Catatan</label>
                <select class="form-control" name="jenis_catatan_id" id="jenis_catatan_id" required="true">
                <option value="">--pilih--</option>
                  <?php foreach ($jenis_catatan as $catatan): ?>
                    <option value="<?=$catatan['id_jenis_catatan'] ?>"><?=$catatan['jenis_catatan'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <!-- <div class="form-group">
                <label for="penilaian">penilaian</label>
                <input type="text" class="form-control" name="penilaian" required="true">
              </div> -->

              <div class="form-group">
                <label for="tanggal_pencatatan">Tanggal Pencatatan</label>
                <input type="text" class="form-control" name="tanggal_pencatatan" required="true" data-inputmask="'alias': 'date'">
              </div>

              <div class="form-group">
                <label for="keterangan">Keterangan/Detail</label>
                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
              </div>  
            

              <button type="sumbit" class="btn btn-primary float-right" value="simpan">Simpan</button>
            </form>

          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $(":input").inputmask()
    $('.pilih').select2();
});
</script>
