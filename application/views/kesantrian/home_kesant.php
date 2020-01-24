<div class="content-wrapper">
  <section class="content">
        <h3 class="p-3"><?= $judul ?></h3>
    <div class="row p-2">

        <?php $no=1; foreach ($minat as $value): ?>
          <a href="<?=base_url()?>kesantrian/klub/<?=$value->id_minat ?>" >
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-success">
              <a href="<?=base_url()?>kesantrian/klub/<?=$value->id_minat ?>" class="info-box-icon font-weight-bolder" style="font-size: 50px"><i></i><?= $this->sm->santriPerKlub($value->id_minat) ?></a >

              <div class="info-box-content">
                <span class="info-box-number h5"><?= $value->nama_minat ?></span>
                <span class="info-box-text">Santri</span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?=60?>%"></div>
                </div>
                    <span class="progress-description">
                      Sekian% dari jumlah santri
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </a>
        <?php endforeach ?>

    </div> <!-- row -->
  </section>
</div>