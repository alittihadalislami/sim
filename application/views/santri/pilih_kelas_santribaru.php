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

          <div class="card px-2">
              
              <div class="card-header">
                <h3 class="card-title">Keseluruhan Santri</h3>
              </div>

              
              <!-- /.card-header -->
              <div class="card-body">

                  <div class="col-md-5">
                    <form action="">
                        <div class="form-group">
                        <label for="kelas_tujuan">Pilih Kelas Tujuan</label>
                        <select class="form-control" id="kelas_tujuan">
                          <option value="">-pilih-</option>
                          <?php foreach ($kelas as $value): ?>
                            <option value="<?= $value['rombel'] ?>"><?= $value['rombel'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </form>
                     <label>Pilih Rombel</label>
                     <table class="table">
                      <thead>
                       <tr>
                          <th scope="col">#</th>
                          <th scope="col">Rombel</th>
                          <th scope="col">Jumlah Santri</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="tuju-kls">
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

    $('#kelas_tujuan').on('change', function(){
      kelas_t = $('#kelas_tujuan').val();

      $.ajax({
          url: "<?=base_url()?>santri/ajax_rombel",
          type:'post',
          dataType: "json",
          data: {
            kelas : kelas_t,
          },

          success: function(respon){
            console.log(respon);
            hasil = '<tr>';
            for(let i =0;i < respon.length;i++)
            {
              var item = respon[i];

              hasil += '<td>'+(i+1)+'</td>'+
              '<td>'+ item['nama_kelas'] + '</td>'+
              '<td>'+ item['jumlah'] + '</td>'+
              '<td> <a href="#" class="btn btn-success pilih-kelas" data-santri="<?= $this->uri->segment(3) ?>" data-kelas="'+item['id_kelas']+'" >Pilih</a> </td>';
              hasil += '</tr>';
            }

             $('#tuju-kls').html(hasil);
          }
      })
    })

    $('#tuju-kls').on('click',".pilih-kelas", function(){
      data = $(this).data("santri");
      alert(data);
    })

  });
</script>
