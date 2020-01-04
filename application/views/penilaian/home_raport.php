<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?=$judul;?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10">
          <a style="margin-right: 20px" class="btn btn-outline-secondary mb-4"  href="<?= base_url('penilaian/entry')?>">Entry Tambahan Wali Kelas</a>
          <?php if ($raport_umum != null): ?>
          <a style="margin-right: 20px" class="btn btn-outline-warning mb-4"  href="<?= base_url('raport/nisn')?>">Entry NISN</a>
          <a class="btn btn-outline-primary mb-4"  href="<?= base_url('raport/dkn/').$kls.'/'.$jenjang?>">Daftar Nilai Kolektif</a>
          <?php endif ?>
          <table class="table table-responsive table-sm table-striped">
            <thead>
              <tr class="text-center">
                <th style="width: 10%">#</th>
                <th style="width: 40%">Ma'had</th>
                <?php if ($raport_umum != null): ?>
                  <th style="width: 40%"><?= $raport_umum == 'SMP' ? 'Sekolah' : 'Madrasah'; ?></th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($santri as $sa): ?>
                <tr>
                  <td style="padding-top: 15px;"><?= $no++;?> </td>
                  <td style="width: 40%">
                    <a class="btn btn-success" href="<?=base_url('penilaian/cetakmii/').$sa['id_santri'].'/'.$id_kelas?>"><?=$sa['nama_santri'];?></a>
                  </td>
                  <?php if ($raport_umum != null): ?>
                  <?php $siap = $this->um->siapPrint($sa['id_santri'],$this->tahunAktif['id_tahun']); ?>
                    <td>
                        <?php if ($raport_umum == 'SMP' ): ?>
                          <!-- <a style="margin-left: 10px;" class="btn btn-primary" href="<?=base_url('raport/cetaksmp/').$sa['id_santri'].'/'.$id_kelas?>"><?= $sa['nama_santri']?></a> -->
                          <a style="margin-left: 10px;" target="_blank" class="btn btn-outline-primary <?= $siap < 3 ? 'disabled' : '' ?>" href="<?=base_url('raport/pdfsmp/').$sa['id_santri'].'/'.$id_kelas?>"> <i class="fa fa-file-pdf text-danger"></i> <?= $sa['nama_santri'] ?></a>
                        <?php endif ?>
                        <?php if ($raport_umum == 'MA' ): ?>
                          <a style="margin-left: 10px;" target="_blank" class="btn btn-outline-primary <?= $siap < 3 ? 'disabled' : '' ?>" href="<?=base_url('raport/pdfma/').$sa['id_santri'].'/'.$id_kelas?>"> <i class="fa fa-file-pdf text-danger"></i> <?= $sa['nama_santri'] ?></a>
                        <?php endif ?>
                    </td>
                  <?php endif ?> 
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
