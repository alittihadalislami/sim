<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha256-EH/CzgoJbNED+gZgymswsIOrM9XhIbdSJ6Hwro09WE4=" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-selection__rendered {
    line-height: 35px !important;
  }
  .select2-container .select2-selection--single {
      height: 40px !important;
  }
  .select2-selection__arrow {
      height: 34px !important;
  }
  .select2 {
    width:100%!important;
  }
</style>

<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto; 
    }
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

        <div class="card card-success mt-5">
          <div class="card-header">
            <h3 class="card-title">Wali Kelas Ma'had</h3>
          </div>

          <div class="card-body">
            
            <form action="<?= base_url('kurikulum/ex_tbh_ngajar') ?>" method="post">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali Kelas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($kelas as $k => $a): ?>
                    <tr>
                      <th scope="row"><?= $no++ ?></th>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="text" name="kelas" id="kelas" value="<?= $a['id_kelas'] ?>" disabled hidden>
                          <input style="height: 41px" class="form-control bg-white" type="text" name="kelas" id="kelas" value="<?= $a['nama_kelas'] ?>" disabled>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select class="form-control pilihan" id="asatid" name="asatid" >
                            <option value="">- pilih -</option>
                            <?php foreach ($asatid as $a): ?>
                              <option value="<?= $a['id_asatid']; ?>"><?= $a['nama_asatid']; ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <button type="sumbit" class="btn btn-success float-right" name="simpan">Simpan</button>
              <a href="<?= base_url('kurikulum') ?>" class="btn btn-secondary float-right mr-4">Kembali <<  </a>
            </form>

          </div>

        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.pilihan').select2();
  });
</script>
