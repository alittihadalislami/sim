<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha256-EH/CzgoJbNED+gZgymswsIOrM9XhIbdSJ6Hwro09WE4=" crossorigin="anonymous" />

<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto; 
    }
  }

.chosen-container-single .chosen-single {
    width: 100%;
    height: 40px;
    border-radius: 3px;
    border: 1px solid #CCCCCC;
    font-size: 17px;
    padding-top: 3px; 
}
.chosen-container-single .chosen-single span {
    padding-top: 2px;
}
.chosen-container-single .chosen-single div b {
    margin-top: 2px;
}
.chosen-container-active .chosen-single,
.chosen-container-active.chosen-with-drop .chosen-single {
    border-color: #ccc;
    border-color: rgba(82, 168, 236, .8);
    outline: 0;
    outline: thin dotted \9;
    -moz-box-shadow: 0 0 8px rgba(82, 168, 236, .6);
    box-shadow: 0 0 8px rgba(82, 168, 236, .6)
}

label{
  display: block;
}

.form-group{
  padding-right: 8px;
}

</style>
<!-- <link rel="stylesheet" href="<?=base_url('assets')?>/css/bootstrap-chosen.css"> -->

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <?= $this->session->flashdata('pesan'); ?>
      <div class="col-md-6 mx-auto">

        <div class="card card-info mt-5">
          <div class="card-header">
            <h3 class="card-title">Tambah data mengajar</h3>
          </div>

          <div class="card-body">
            
            <form action="<?= base_url('kurikulum/ex_tbh_ngajar') ?>" method="post">

              <div class="form-group">
                <label for="asatid">Asatid</label>
                <select class="chosen-single form-control" id="asatid" name="asatid">
                  <option value="">- pilih -</option>
                  <?php foreach ($asatid as $a): ?>
                    <option value="<?= $a['id_asatid']; ?>"><?= $a['nama_asatid']; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="mapel">Mapel</label>
                <select class="form-control chosen-single" id="mapel" name="mapel">
                  <option value="">- pilih -</option>
                  <?php foreach ($mapel as $a): ?>
                    <option value="<?= $a['id_mapel']; ?>"><?= $a['nama_mapel']; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-control chosen-single" id="kelas" name="kelas[]" multiple="true" data-placeholder="Pilih kelas">
                    <option value="">- pilih -</option>
                  <?php foreach ($kelas as $a): ?>
                    <option value="<?= $a['id_kelas']; ?>"><?= $a['nama_kelas'].' / '.$a['kelas_alias']; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="tapel">Tahun Ajaran</label>
                <select class="form-control chosen-single" id="tapel" name="tapel">
                  <option value="">- pilih -</option>
                  <?php foreach ($tahun as $a): ?>
                    <option value="<?= $a['id_tahun']; ?>"><?= $a['nama_tahun'].' - s'.$a['semester']; ?></option>
                  <?php endforeach ?>
                </select>
              </div>



              <button type="sumbit" class="btn btn-primary float-right" name="simpan">Simpan</button>
            </form>

          </div>

        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha256-c4gVE6fn+JRKMRvqjoDp+tlG4laudNYrXI1GncbfAYY=" crossorigin="anonymous"></script>
<script>
  $(".chosen-single").chosen();
</script>
