
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Santri</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg lebar">

          <div class="card px-2">
              <div class="card-header">
                <h3 class="card-title">Santri</h3>
              </div>
                
              <div class="card-body">
                <?php 
                  echo $this->session->flashdata('pesan');
                 ?>
                 <br>
                <form method="post" action="<?= base_url('santri/aksiSetKelasManual') ?>">
                  <div class="form-group">
                    <label for="nama_santri">Nama santri</label>
                    <select id="nama_santri" class="form-control select2" name="santri_id" required>
                      <option selected>Pilih...</option>
                      <?php foreach ($santri as $s): ?>
                        <option value="<?= $s['id_santri'] ?>"> <?= $s['nama_santri'] ?> </option>>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" class="form-control select2" name="kelas_id">
                      <option selected>Pilih...</option>
                      <?php foreach ($kelas as $k): ?>
                        <option value="<?= $k['id_kelas'] ?>"> <?= $k['nama_kelas'] ?> </option>>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" name="tahun_id" value="<?= $tahun ?>">
                  </div>
                  <button class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

        </div>
      </div>
    </div>
  </section>
</div>


<!-- load js datatable -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    
    $('.select2').select2({

    });
  });
</script>
