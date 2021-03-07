<!-- load datatable boostrap css -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Santri</h1> -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-12 float-right mb-5">
                    <a href="<?= base_url("santri/tambahPencatatanKesantrian") ?>" class="btn btn-primary float-right">tambah</a>
                  </div>
                </div>

                <table id="santri" class="table table-bordered table-hover display table-sm" style="width: 100%">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>Kelas</th>
                      <th>Tatib Terkait</th>
                      <th>Penilaian</th>
                      <th>Tanggal Catatan</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody id="isi-table">
                    <?php foreach ($catatan as $c): ?>
                      
                    <tr>
                      <td></td>
                      <td><?= $c['nama_santri'] ?></td>
                      <td><?= $c['idk_mii'] ?></td>
                      <td><?= $c['nama_kelas'] ?></td>
                      <td><?= $c['jenis_catatan'] ?></td>
                      <td><?= $c['penilaian'] ?></td>
                      <td><?= $c['tanggal_pencatatan'] ?></td>
                      <td><?= $c['keterangan'] ?></td>
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
  });
</script>
