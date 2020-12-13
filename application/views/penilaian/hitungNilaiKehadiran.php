<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<style>
    @media only screen and (min-width: 769px) {
    .content-wrapper{
      padding-left: 5px;
    }
  }
    .lebar{
      padding:0px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Perhitungan kehadiran santri</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <?= $this->session->flashdata('pesan'); ?>
        </div>  
      </div>  
      <div class="row">
          <div class="col-md-6">
            <table class="table table-hover table-sm table-striped">
              <thead>
                <tr>
                  <th scope="col">Kelas</th>
                  <th scope="col">Perhitungan Terakhir</th>
                  <th scope="col">Hitung</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($kelas as $kls): ?>
                  <tr>
                    <td><?= $kls['nama_kelas'] ?></td>
                    <td>
                      <?php
                        date_default_timezone_set('Asia/Jakarta');
                        foreach ($terakhir_hitung as $wh) {
                          if ($kls['id_kelas'] == $wh['kelas_id']) {
                            echo(date("d/m/Y G.i",$wh['waktu']));
                            echo " (";
                            $selisih = floor( (time() - $wh['waktu']) / (60 * 60 * 24));
                            echo $selisih < 1 ? "hari ini) ": $selisih ." hari yang lalu)";
                           } 
                        }
                       ?>
                    </td>
                    <td><a href="<?= base_url("konfig/hitungNkh/").$kls['id_kelas'] ?>"><i class="fas fa-play text-primary"></i></a></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>    
      </div>
      
    </div>
  </section>
</div>


