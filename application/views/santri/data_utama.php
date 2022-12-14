<!-- load datatable boostrap css -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<style>
  layout: {
    padding: {
        left: 0,
        right: 0,
        top: 30,
        bottom: 0
    }
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
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?= 'Data Utama' ?></h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-2 float-right mb-5">
                    <!-- <select id="pilih-kelas" class="custom-select">
                      <?php foreach ($kelas as $kls): ?>
                        <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                      <?php endforeach ?>
                    </select> -->
                  </div>
                </div>

                <?php 
                  $kelas_aktiv = [];
                  foreach ($kelas as $kel) {
                    $kelas_aktiv [] = $kel['nama_kelas'] ;
                    $status_kelengkapan [] = 0;
                    $counter [] = 0;
                  }
                ?>

                <div class="row mb-5">
                  <div class="col-sm-12 col-xl-8 mb-5 mx-auto">
                    <canvas id="myChart" height="150"></canvas>
                  </div>
                  <div class="col-xl-4 mb-5 mx-auto my-auto hidden-sm-down">
                    <canvas id="pie" height="250"></canvas>
                  </div>
                </div>


                <table id="santri" class="table table-bordered table-hover display table-sm ">
                  <thead>                  
                    <tr>
                      <th></th>
                      <th>ID Santri</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>NISN</th>
                      <th>NISL</th>
                      <th>Kelas</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Absen</th>
                      <th>Anake ke/dari </th>
                      <th>No Ijasah</th>
                      <th>No SKHU</th>
                      <th>No Peserta UN</th>
                      <th>Nama Ibu</th>
                      <th>NIK Ibu</th>
                      <th>Nama Bapak</th>
                      <th>NIK Bapak</th>
                      <th>Tanggal Masuk</th>
                    </tr>
                  </thead>
                  <tbody id="isi-table" class="text-nowrap">
                    <?php $hasil = 0;  foreach ($data_detail as $data): ?>

                    <tr>
                      <?php 
                      $status = 0;
                      $tata = '';
                      $putaran= 0;

                      foreach ($data as $d => $konten ) {
                        if ($putaran == 3 || $putaran == 6 ) {
                        }else{
                          if (strlen($konten) > 0) {
                            $status += 1;
                          }
                        }
                         $putaran += 1;
                      }

                      $hasil = round($status/18*100,0); // jumlah kolom ke samping, kalo ada update perlu ditambah
                      if ($hasil < 50) {
                        $badge = "badge badge-danger";
                      }elseif ($hasil < 75) {
                        $badge = "badge badge-secondary";
                      }elseif ($hasil < 100) {
                        $badge = "badge badge-warning";
                      }else{
                        $badge = "badge badge-success";
                      }

                      foreach ($kelas_aktiv as $kl) {
                        if ($data['nama_kelas'] == $kl) {
                          $indek =  array_keys($kelas_aktiv, $kl)[0];

                          $nilai_conter = $counter[$indek]; //array tidak bisa scalar value
                          $nilai_conter += 1;
                          $counter[$indek] = $nilai_conter;
                          
                          $temp = $status_kelengkapan[$indek];
                          $temp += $hasil;
                          $status_kelengkapan[$indek] = $temp;
                        }
                      }

                      ?>
                      <td><span class="<?= $badge?>"><?=$hasil?></span></td>
                      <td><?= $data['santri_id'] ?></td>
                      <td style="word-wrap: break-word;min-width: 260px;"><a href="<?= base_url('santri/edit/').$data['santri_id']?>"><?= $data['nama_santri'] ?></a></td>
                      <td><?= $data['nik'] ?></td>
                      <td><?= $data['nisn_fix'] ?></td>
                      <td>NISL</td>
                      <td><?= $data['nama_kelas'] ?></td>
                      <td><?= $data['tmp_lahir'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['tgl_lahir'] ?></td>
                      <td>Absen </td>
                      <td><?= $data['anak_ke'].'/'.$data['jml_saudara'] ?></td>
                      <td><?= $data['seri_ijazah'] ?></td>
                      <td><?= $data['seri_skhun'] ?></td>
                      <td><?= $data['no_ujian'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['ibu'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['nik_ibu'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['bapak'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['nik_bapak'] ?></td>
                      <td style="word-wrap: break-word;min-width: 160px;max-width: 260px;"><?= $data['tgl_terima_mii'] ?></td>

                    </tr>
                    <?php endforeach ?>

                    <?php
                      $data_kelengkapan = [] ;
                      $data_kelengkapan_all = 0;
                      for ($k=0; $k<count($counter) ; $k++) { 
                        $data_kelengkapan [$k] = round($status_kelengkapan[$k] / $counter[$k],0);
                        $data_kelengkapan_all += round($status_kelengkapan[$k] / $counter[$k],0);
                      }
                      $data_kelengkapan_all = $data_kelengkapan_all / count($counter);

                   
                     ?>
                  </tbody>
                </table>
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
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
  $(document).ready(function() {

    // $('#pilih-kelas').change(function() {
    //   id_kelas = $(this).val()  
    //   $.ajax({
    //     type:"post",
    //     url: "<?php echo base_url(); ?>/santri/ajaxSantriDataUtama",
    //     data:{id_kelas:id_kelas},
    //     success:function(response){
    //       console.log(response);
    //     }
    //   });

    //   data = '<tr>'+
    //             '<td>'+id_kelas+'</td>'+
    //             '<td style="background:darkred">1212</td>'+
    //             '<td>Nurul Fuadi</td>'+
    //           '</tr>';
    //   data = data + data;
    //   // $('#isi-table').html(data);
    // });

    // kelas = $('#pilih-kelas').find(":selected").text();

    
    $('#santri').dataTable( {
      // "columnDefs": [{ 'visible': false, 'targets': [2] }]
      // "scrollY": 500,
      "scrollX": true
    });

    var ctx = document.getElementById('myChart');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: <?= json_encode($kelas_aktiv)?>,
            datasets: [{
                barPercentage: 0.5,
                label: 'Kelengkapan Data',
                backgroundColor: 'rgb(0, 153, 0)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?= json_encode($data_kelengkapan) ?>
            }]
        },

        // Configuration options go here
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: false,
                text: ''
            },
        }
    });

    var cty = document.getElementById("pie").getContext('2d');
    var myChart = new Chart(cty, {
      type: 'pie',
      data: {
        labels: ["Sudah", "Belum"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db"
          ],
          data: [<?= $data_kelengkapan_all ?>, <?= 100 - $data_kelengkapan_all;  ?>]
        }]
      },
      options:{
        legend: {
          position: 'bottom',
          display: true
        }
      }
    });

  });
</script>
