<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">          
          <?= $this->session->flashdata('pesan'); ?>
        </div>
      </div>
      
      <div class="row">
        <div class="col xl-10">
          <div class="form-group col-md-6">
            <label for="inputPropinsi">Propinsi</label>
            <select id="inputPropinsi" class="form-control input-alamat" style="width: 100px">
              <option selected>Pilih...</option>
              <option>...</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputKabupaten">Kabupaten</label>
            <select id="inputKabupaten" class="form-control input-alamat">
              <option selected>Pilih...</option>
              <option>Pilih propinsi dulu...</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputKecamatan">Kecamatan</label>
            <select id="inputKecamatan" class="form-control input-alamat">
              <option selected>Pilih...</option>
              <option>Pilih kabupaten dulu...</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputDesa">Desa</label>
            <select id="inputDesa" class="form-control input-alamat">
              <option selected>Pilih...</option>
              <option>Pilih kecamatan dulu...</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <div class="input-group has-default bmd-form-group autofocus">
              <input required id="alamat-pengenal" type="text" class="form-control" placeholder="RT-RW/Jl./Gg.No/Kampung/Alamat pengenal selain attribut diatas" name="alamatPengenal">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-8">
          <button id="close-alamat" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="simpan-alamat" type="button" class="btn btn-success">Save changes</button>
          
        </div>
      </div>
      
    </div>
  </section>
</div>
