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
              <div class="row">
                <div class="col-md-6">
                  <form action="">
                      <div class="form-group">
                      <label for="exampleFormControlSelect1">Kelas Asal</label>
                      <select class="form-control" id="kelas_asal">
                        <option value="">-pilih-</option>
                        <?php foreach ($kelas as $key => $value): ?>
                          <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </form>
                  <h5>kelas asal</h5>

                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                            <input type="checkbox" id="pilih-semua">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama Santri</th>
                      </tr>
                    </thead>
                    <tbody id="asal-kls">
                    </tbody>
                  </table>
                  
                </div>
                <div class="col-md-1">
                  <div class="btn btn-info" id="tombol_ubah">>></div>
                </div>
                <div class="col-md-5">
                  <form action="">
                      <div class="form-group">
                      <label for="kelas_tujuan">Kelas Tujuan</label>
                      <select class="form-control" id="kelas_tujuan">
                        <option value="">-pilih-</option>
                        <?php foreach ($kelas as $key => $value): ?>
                          <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </form>
                   <h5>kelas baru</h5>
                   <table class="table">
                    <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama Santri</th>
                      </tr>
                    </thead>
                    <tbody id="tuju-kls">
                    </tbody>
                  </table>
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

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
    
    $('#kelas_asal').on('change', function(){
      kelas = $('#kelas_asal').val();

      $.ajax({
          url: "<?=base_url()?>santri/ajax_santri",
          type:'post',
          dataType: "json",
          data: {
            tahun : 3,
            kelas : kelas,
          },

          success: function(respon){
            hasil = '<tr>';
            for(let i =0;i < respon.length-1;i++)
            {
              var item = respon[i];

              hasil += '<td><input type="checkbox" value="'+item['id_santri']+'"></td>'+
              '<td>'+(i+1)+'</td>'+
              '<td>'+item['id_santri']+'</td>'+
              '<td>'+item['nisn']+'</td>'+
              '<td>'+item['nama_santri']+'</td>';
              hasil += '</tr>';
            }

            $('#asal-kls').html(hasil);
          }

      })
    })

    $('#kelas_tujuan').on('change', function(){
      kelas_t = $('#kelas_tujuan').val();
      alert(kelas_t);

      $.ajax({
          url: "<?=base_url()?>santri/ajax_santri",
          type:'post',
          dataType: "json",
          data: {
            tahun : 3,
            kelas : kelas_t,
          },

          success: function(respon){
            hasil = '<tr>';
            for(let i =0;i < respon.length-1;i++)
            {
              var item = respon[i];

              hasil += '<td>'+(i+1)+'</td>'+
              '<td>'+item['id_santri']+'</td>'+
              '<td>'+item['nisn']+'</td>'+
              '<td>'+item['nama_santri']+'</td>';
              hasil += '</tr>';
            }

             $('#tuju-kls').html(hasil);
          }

      })
    })

    $("#pilih-semua").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#tombol_ubah').on('click', function(){
      
      idArr = [];
      $("#asal-kls input:checkbox[name=type]:checked ").each(function(){
        idArr.push($(this).val());
      });
      console.log(idArr);
    })




  });
</script>
