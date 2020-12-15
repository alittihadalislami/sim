<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto;
    }
  }
  .input-group>.input-group-prepend {
      flex: 0 0 20%;
  }
  .input-group .input-group-text {
      width: 100%;
  }
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="row">

      <?= $this->session->flashdata('pesan'); ?>

      <div class="col-md mx-auto">

        <div class="card mt-5">

          <div class="card-header">
            <h3 class="card-title">Sinkron data PSB</h3>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-10">
                <table id="santri" class="table table-bordered table-hover table-sm display responsive">
                  <thead>                  
                    <tr>
                      <th width="25%">Data</th>
                      <th>PSB</th>
                      <th>SIM</th>
                      <th>cek</th>
                      <th width="10%">Aksi</th>
                    </tr>
                  </thead>
                  <?php 
                    $keys = array_keys($list_detail);
                    var_dump($atribut['dukcapil']['nik']);
                  ?>
                    <?php for ($i=0;$i<3;$i++) : ?>
                      <?php $banyak = count($list_detail[$keys[$i]]) ?>
                      <?php for ($j=0;$j<$banyak;$j++) : ?>
                        <?php
                          $keys2 = array_keys($atribut[$keys[$i]]);
                          $sim = $atribut[$keys[$i]][$keys2[$j]] != null ? $atribut[$keys[$i]][$keys2[$j]] : $keys2[$j] ;
                         ?>
                        <tr>
                          <td><?= $list_detail[$keys[$i]][$j] ?></td>
                          <td><?= $keys2[$j]  ?></td>
                          <td><?= $keys[$i]?></td>
                          <td><?=var_dump($sim) ?></td>
                          <td>ambil data</td>
                        </tr> 
                      <?php endfor ?>
                    <?php endfor ?>
                  <tbody>
                  </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

