<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

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
                <h3 class="card-title">Keseluruhan Santri</h3>
                <?php if ($rule_id == 1): ?>
                  <a href="<?= base_url()?>santri/setKelasManual" class="float-right tambah"><i class="fas fa-plus text-success"></i> Set kelas santri manual</a><br>
                  <a href="<?= base_url()?>santri/pengaturanNomorInduk" class="float-right tambah"><i class="fas fa-plus text-success"></i> Menejemen nomor induk</a> 
                <?php endif ?>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="santri" class="table table-bordered table-striped table-sm table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Induk MII</th>
                      <th data-priority="1">Nama Santri</th>
                      <th data-priority="1">Kelas</th>
                      <th>Induk SMP</th>
                      <th>Induk MA</th>
                      <th>Data</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($santri as $str): ?>                    
                      <tr>
                        <td><?= $no++;?></td>
                        <td><?= $str['idk_mii'];?></td>
                        <?php 
                          $detail = $this->db->get_where('t_detail_santri', ['santri_id'=> $str['id_santri'] ])->row_array();

                          if ($detail) {
                            if(strlen($detail['nama_seijazah']) > 3 ){
                              $nama_fix = $detail['nama_seijazah'];
                            }else{
                              $nama_fix = $str['nama_santri'];
                            }  
                          }else{
                            $nama_fix = $str['nama_santri'];
                          }

                        ?>
                        <td><?= $nama_fix;?></td>
                        <td><?= $str['nama_kelas'];?></td>
                        <td><?= $str['idk_umum'];?></td>
                        <td><?= $str['idk_umum2'];?></td>
                        <td class="sts">
                          <?php
                          $ada = $this->km->adaDetail($str['id_santri']);
                          if ($ada > 0 ) {
                            foreach ($detail_terisi as $dt) {
                              if ($dt['santri_id'] == $str['id_santri']) {
                                echo $dt['isian'];
                              }
                            }
                          }else{
                            echo 0;
                          }
                          ?>
                           / 26
                        </td>
                        <td class="d-flex align-items-center justify-content-around">
                          <a class="px-1" href="<?= base_url('santri/edit/').$str['id_santri']?>"><i class="fas fa-edit text-primary"></i></a> 
                          <?php if ($this->session->userdata('rule_id') < 6 || $masukTabelWaliTerbaru > 0 ): ?>
  	                        <a class="px-1 mx-2" href="<?= base_url('raport/identitas/').$str['id_santri']?>"><i class="fas fa-list-ol text-success"></i></a> 
                            <a 
                                class="px-1" 
                                href="<?= base_url('santri/non_aktif/').$str['id_santri']?>"
                                data-nama="<?=$str['nama_santri']?>"
                                data-kelas="<?=$str['nama_kelas'];?>"
                                onClick="keluarkanSantri(event)" >
                                    <i class="fas fa-share-square text-danger"></i>
                            </a>
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function keluarkanSantri(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        var santri = ev.currentTarget.getAttribute("data-nama")
        var kelas = ev.currentTarget.getAttribute("data-kelas")
        Swal.fire({
            title: "Apakah yakin mengeluarkan?",
            text: "Anda tidak akan bisa mengembalikan santri yang sudah dikeluarkan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, keluarkan",
            cancelButtonText: "Batal",
            input: "checkbox",
            inputValue: 0,
            inputPlaceholder: "Saya yakin ingin mengeluarkan <br>santri an. "+santri+" dari kelas: "+kelas,
            inputValidator: (value) => {
                return !value && "Anda harus mencentang checkbox untuk melanjutkan!";
            },
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title : "Berhasil!", 
                    icon: "success",
                    text : santri+" berhasil dikeluarkan!", 
                    type : "success",
                    timer : 3000
                }).then(function() {
                    window.location.replace(urlToRedirect)                    
                })
                // setTimeout(function () {
                //         window.location.replace(urlToRedirect)                    
                // }, 3000);
            }
        });
    }

$(document).ready(function() {
    $('#santri').dataTable( {
      "columnDefs": [{ 'visible': false, 'targets': [2] }],
      "stateSave": true
    });
});
</script>
