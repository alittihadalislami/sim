<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6 mx-auto">

        <?php 
          $x = $this->db->get_where('m_asatid', ['id_asatid' => $id_asatid])->row_array();
        ?>

        <div class="card card-info mt-5">
          <div class="card-header">
            <h3 class="card-title">Input No HP</h3>
          </div>
          <form action="<?= base_url('asatid/tambahhp') ?>" method="post">
            <div class="card-body">
              <div class="judul">
                <label for=""><?= $x['nama_asatid']; ?></label>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                </div>
                <input type="text" class="form-control" value="<?= $x['id_asatid']; ?>" name="id_asatid" hidden="true">
                <input type="number" class="form-control" placeholder="No. hp" name="nohp" value="<?= $x['nohp'] ?  $x['nohp'] : ''; ?>">
              </div>
              <button type="sumbit" class="btn btn-primary float-right" name="simpan">Simpan</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</div>
