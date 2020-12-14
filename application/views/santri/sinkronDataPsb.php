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
                    <?php foreach ($list_detail as $ld): ?>
                      <?php foreach ($ld as $list): ?>                
                        <tr>
                          <td><?= $list ?></td>
                          <td></td>
                          <td></td>
                          <td>xx</td>
                          <td>ambil data</td>
                        </tr>
                      <?php endforeach ?>
                    <?php endforeach ?>
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

