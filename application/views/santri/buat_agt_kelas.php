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
                      <label for="exampleFormControlSelect1">Tahun</label>
                      <select class="form-control" id="tahun-id">
                        <option value="">-pilih-</option>
                        <?php foreach ($tahun as $key => $value): ?>
                          <option value="<?= $value['id_tahun'] ?>"><?= $value['nama_tahun'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Rombel</label>
                      <select class="form-control" id="rombel-id">
                        <option value="">-pilih-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Tra tri</label>
                      <select class="form-control" id="tra-tri">
                        <option value="">-pilih-</option>                        
                        <option value="tra">Putra</option>                        
                        <option value="tri">Putri</option>                        
                      </select>
                    </div>
                    <button type="button" id="simpan" class="btn btn-success float-right mb-5">List Santri</button>
                    <div style="height: 100px"></div>
                  </form>

                  <h5>kelas asal</h5>
  
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama Santri</th>
                        <th scope="col">Nilai</th>
                      </tr>
                    </thead>
                    <tbody id="asal-kls">
                    </tbody>
                  </table>
                  
                </div>
                <div class="col-md-1 text-center">
                  <input type="checkbox" value="ok">
                  <br>
                  <div class="btn btn-info" id="tombol_ubah">>></div>
                </div>
                <div class="col-md-5">
                  <form action="">
                      <div class="form-group">
                      <label for="kelas_tujuan">Kelas Tujuan</label>
                      <select multiple  class="form-control" class="multiselect" id="kelas_tujuan">
                        <?php foreach ($kelas as $key => $value): ?>
                          <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </form>
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

    $('#simpan').on('click', function(){
      tahun = $('#tahun-id').val();
      rombel = $('#rombel-id').val();
      tratri = $('#tra-tri').val();

      if (tahun == '' || rombel == '' || tratri == '') {
        alert('Silahkan pilih dengan lengkap..')
      }else{
        console.log(tahun+rombel+tratri);
        $.ajax({
            url: "<?=base_url()?>santri/ajax_santriRombelTratri",
            type:'post',
            dataType: "json",
            data: {
              tahun : tahun,
              rombel : rombel,
              tratri : tratri,
            },

            success: function(respon){
              hasil = '<tr>';
              for(let i =0;i < respon.length-1;i++)
              {
                var item = respon[i];

                hasil += '<td>'+(i+1)+'</td>'+
                '<td class="id" id="'+item['santri_id']+'">'+item['santri_id']+'</td>'+
                '<td>'+item['nisn']+'</td>'+
                '<td>'+item['nama_santri']+'</td>'+
                '<td>'+item['nilai']+'</td>';
                hasil += '</tr>';
              }
              console.log(hasil);

              $('#asal-kls').html(hasil);
            }

        })
      }

    })

    $('#kelas_tujuan').on('change', function(){
      kelas_t = $('#kelas_tujuan').val();    
    })

    $("#pilih-semua").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#tombol_ubah').on('click', function(){
      
      idsantris = [];
      $('#asal-kls .id').each(function() {
        idsantris.push($(this).html());
      });
      
      idkelass = $('#kelas_tujuan').val();

      if (idsantris.length < 1 || idkelass.length < 1) {
        alert('Ada pilihan yang masih kosong..')
      }
      else{
        console.log(idsantris)
        console.log(idkelass)
        $.ajax({
            url: "<?=base_url()?>santri/ajax_tambahAgtKelas",
            type:'post',
            dataType: "json",
            data: {
              idsantri : idsantris,
              idkelas : idkelass,
            },

            success: function(respon){
            }

        })
      }

      
    })




  });
</script>
