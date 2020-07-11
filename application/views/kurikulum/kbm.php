<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
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
    .tambah{
      position: absolute;
      right: 22px;
      top:15px;
      padding-bottom:0; 
      padding-top:0;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
        <div class="col-md-12 lebar">

          <?php 
          $filter_flash = $this->session->flashdata('filter');
          echo $this->session->flashdata('pesan');
           ?>
          
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Asatid Mengajar</h3>
                <a href="<?= base_url()?>kurikulum/tambahKbm" class="float-right tambah"><i class="fas fa-plus text-success"></i> Tambah data mengajar</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="ngajar" class="table table-bordered table-striped table-hover table-responsive table-small">
                  <thead>                  
                    <tr>
                      <th style="width: 10%">#</th>
                      <th style="width: 10%">Asatid</th>
                      <th style="width: 20%">Kelas</th>
                      <th style="width: 30%">Mapel</th>
                      <th style="width: 20%">Hari</th>
                      <th style="width: 20%">Jam ke</th>
                    </tr>
                  </thead>
                  <tbody id="data-kbm">
                    
                  </tbody>
                </table>
              </div>
            </div>

        </div>
      </div>
      
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>

  $(document).ready(function() {
    $.ajax({
      url: "<?=base_url()?>kurikulum/ajax_tampil_kbm",
      type:'post',
      dataType: "json",
      success: function(respon){
        hasil = '';
        for (var i = 0; i < respon.length; i++) {
          item= respon[i];
          hasil += '<tr>'+
                     '<td>'+(i+1)+'</td>'+
                     '<td>'+item.nama_asatid+'</td>'+
                     '<td>'+item.nama_kelas+'</td>'+
                     '<td>'+item.nama_mapel+'</td>'+
                     '<td>'+item.hari+'</td>'+
                     '<td>'+item.jamke+'</td>'+
                   '</tr>'
        }
        $('#data-kbm').html(hasil);
        
        $('#ngajar').DataTable({
        });
      }
    });




} );
</script>
