<div class="content-wrapper">
  <section class="content" style="baca">
    <div class="row">
      <div class="col-md-6 mx-auto">

        <?php 
          $x = $this->db->get_where('m_asatid', ['id_asatid' => $id_asatid])->row_array();
        ?>

        <div class="card card-info mt-5">
          <div class="card-header">
            <i class="fa fa-edit"></i> &nbsp
            <span class="card-title" >Update Data Civitas Ma'had</span>
          </div>
          <form action="<?= base_url('asatid/updateCivitas') ?>" method="post">
            <div class="card-body">
              <div class="judul">
                <label for=""><?= $x['nama_asatid']; ?></label>
                <input type="text" class="form-control" value="<?= $x['id_asatid']; ?>" name="id_asatid" hidden>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-fw fa-mobile"></i></span>
                </div>
                <input type="text" class="form-control" value="<?= $x['nama_asatid']; ?>" name="nama_asatid">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-fw fa-mobile"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="No. hp" name="nohp" value="<?= $x['nohp'] ?  $x['nohp'] : ''; ?>">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="No. IY" name="niy" value="<?= $x['niy'] ?  $x['niy'] : ''; ?>">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                </div>
                <select class="form-control" name="kategori" id="kategori"  required="true">
                  <option value="">--Kategori--</option>
                  <?php foreach ($kategori as $k => $v): ?> 
                  <option class="text-capitalize" <?= $x['kategori'] == $k ? 'selected' : null ?> value="<?=$k?>"><?=$v?></option>
                  <?php endforeach ?> 
                </select>
              </div>
              <div class="form-check" style="font-weight: bolder">
                <input class="form-check-input" type="radio" name="sts" id="sts1" value="1" <?= $x['sts'] == '1' ? 'checked' : null ?> >
                <label class="form-check-label text-success" for="sts1">
                  Aktif
                </label>

                <input class="form-check-input ml-4" type="radio" name="sts" id="sts2" value="0" <?= $x['sts'] == '0' ? 'checked' : null ?> >
                <label class="form-check-label text-secondary" style="margin-left: 45px;" for="sts2">
                  Tidak Aktif
                </label>
              </div>
  
              <button type="sumbit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>

