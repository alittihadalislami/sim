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
        <div class="col">
          
          <?= $this->session->flashdata('pesan'); ?>

          <div class="list-group">
            <?php $no=1; foreach ($daftar as $d => $v): ?>
              <a href="<?= $v ?>" class="klik-lama list-group-item list-group-item-action"  onclick="return confirm('YAKIN, <?= $d ?>?')" >
                <?=$no++.'. '. $d ?>
              </a>
            <?php endforeach ?>
          </div>       
        </div>
      </div>
    </div>
  </section>
</div>
