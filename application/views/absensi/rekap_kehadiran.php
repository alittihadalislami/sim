<style>
    .input-group-text {
      width: 100px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5><?= $judul ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <section>
            <div class="row mt-2">
                <div class="col-lg-8">
                    <div class="form-row">
                        <?php 
                            var_dump($list_guru);
                        ?>
                        <div class="form-group col-lg-2">
                            <label for="asatid">Tahun</label>
                            <select class="chosen-single form-control" id="tahun" name="tahun" required="">
                                <option value="">- pilih -</option>
                                    <option selected value="2024">2024</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="asatid">Bulan</label>
                            <select class="chosen-single form-control" id="bulan" name="bulan" required="">
                                <option value="">- pilih -</option>
                                <?php $index=1; foreach ($bulan as $bln) : ?>
                                    <option value="<?=$bln?>"><?=$bln?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="asatid">Guru</label>
                            <select class="chosen-single form-control" id="asatid" name="asatid" required="">
                                <option value="">- pilih -</option>
                                <?php foreach ($list_guru as $guru) : ?>
                                    <option value="<?=$guru['id_asatid']?>"><?=$guru['nama_asatid']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                   <button type="submit" id="cari" class="btn btn-primary">Tampilkan</button>
                   <button type="button" id="tambah" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal">
                   Launch demo modal
                   </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-stripped table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hari, Tanggal</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Materi</th>
                                    <th scope="col">Jamke</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                                <tr>
                                    <td colspan="8">no data</td>
                                </tr>
                            </tbody>
                        </table>
                    <div class="table-responsive">
                </div>
            </div>
        </section>
  </section>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="ket">Keterangan</label>
            </div>
            <select class="custom-select" id="ket">
                <option selected>Choose...</option>
                <option value="1">Lupa</option>
                <option value="1">Pindah Jadwal</option>
            </select>
        </div>
        <div class="input-group mb-1 date" data-provide="datepicker">
          <div class="input-group-prepend">
            <label class="input-group-text">Tanggal</label>
          </div>
          <input type="text" class="form-control">
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="mapel">Mapel</label>
            </div>
            <select class="custom-select" id="mapel">
                <option selected>Choose...</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="kelas">Kelas</label>
            </div>
            <select class="custom-select" id="kelas">
                <option selected>Choose...</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="jamke">Jam ke</label>
            </div>
            <select class="custom-select" id="jamke">
                <option selected>Choose...</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="kelas">Materi</label>
                <!-- <span class="input-group-text">Materi</span> -->
            </div>
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>
        <div class="row">
            <div class="col py-5">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action">
                        <span>A</span>
                        <span class="ml-2">1. Aid Ayyashal Hunav</span>
                    </button>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {

      $('#ket').change(function() {
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/ajax_getMapel",
            data: {tahun, asatid},
            dataType : 'json', 
            // beforeSend: function () {  
            // buatLoading();
            // },
            success: function (response) {
                hasil = ''
                for (let i = 0; i < response.length; i++) {
                    hasil += '<tr><td>'+ (i+1)+'</td>' +
                    '<td>'+response[i]['tgl']+'</td>' + 
                     '<td>'+response[i]['nama_asatid']+'</td>' + 
                     '<td>'+response[i]['kelas_alias']+'</td>' + 
                     '<td>'+response[i]['mapel_alias']+'</td>' + 
                     '<td>'+response[i]['materi']+'</td>' + 
                     '<td>'+response[i]['jamke']+'</td>' + 
                     '<td> hadir </td>' 
                }
            $('#data').html(hasil)
            $('#tambah').css('display', 'block')
            }
        });
      });//akhir #ket 
      
    });
    // $('.input-group.date').datepicker({
    //   format: 'yyyy-mm-dd',
    //   autoclose: true
    // });


    $('#cari').click(function (e) { 
        e.preventDefault();
        tahun = document.getElementById('tahun').value
        bulan = document.getElementById('bulan').value
        asatid = document.getElementById('asatid').value
        
        if (tahun == '' || bulan =='' || asatid == '' ) {
            alert('Silahkan pilih data terlebih dahulu')
            return 
        }

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/asatid_ajax",
            data: {tahun, bulan, asatid},
            dataType : 'json', 
            // beforeSend: function () {  
            // buatLoading();
            // },
            success: function (response) {
                hasil = ''
                for (let i = 0; i < response.length; i++) {
                    hasil += '<tr><td>'+ (i+1)+'</td>' +
                    '<td>'+response[i]['tgl']+'</td>' + 
                     '<td>'+response[i]['nama_asatid']+'</td>' + 
                     '<td>'+response[i]['kelas_alias']+'</td>' + 
                     '<td>'+response[i]['mapel_alias']+'</td>' + 
                     '<td>'+response[i]['materi']+'</td>' + 
                     '<td>'+response[i]['jamke']+'</td>' + 
                     '<td> hadir </td>' 
                }
            $('#data').html(hasil)
            }
        });

    });
</script>
