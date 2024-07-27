<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"></link>

<style>
    .input-group-text {
      width: 100px;
    }
    .ling{
        border-radius: 20px 20px;
        width: 30px;
        height: 30px;
        padding: 2px;
        font-weight: bold;
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
                                    <?php $selected = $index++ == 7 ? 'selected' : ''; ?>
                                    <option value="<?=$bln?>" <?=$selected?>><?=$bln?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="asatid">Guru</label>
                            <select class="chosen-single form-control" id="asatid" name="asatid" required="">
                                <option value="">- pilih -</option>
                                <?php foreach ($list_guru as $guru) : ?>
                                    <option selected value="<?=$guru['id_asatid']?>"><?=$guru['nama_asatid']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                   <button type="submit" id="cari" class="btn btn-primary">
                        Tampilkan
                    </button>
                   <button type="button" id="tambah" class="btn btn-primary d-none float-right" data-toggle="modal" data-target="#exampleModal">
                        Tambah data
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
        <h4 class="modal-title" id="exampleModalLabel">Pengajuan Presensi Asatid</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="ket">Keterangan</label>
            </div>
            <select class="custom-select f-tambah" id="ket">
                <option selected>Pilih...</option>
                <option value="1">Lupa</option>
                <option value="1">Pindah Jadwal</option>
            </select>
        </div>
        <div class="input-group mb-1 date" data-provide="datepicker">
          <div class="input-group-prepend">
            <label class="input-group-text">Tanggal</label>
          </div>
          <input type="text" class="form-control f-tambah" id="tanggal" placeholder="Klik disini dahulu">
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="mapel">Mapel</label>
            </div>
            <select class="custom-select f-tambah" id="mapel">
                <option selected>Pilih...</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="kelas">Kelas</label>
            </div>
            <select class="custom-select f-tambah" id="kelas">
                <option selected>Pilih...</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="">Jadwal</label>
            </div>
            <select class="custom-select f-tambah" id="jadwal">
                <option selected>Pilih...</option>
            </select>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="materi">Materi</label>
                <!-- <span class="input-group-text">Materi</span> -->
            </div>
            <textarea class="form-control f-tambah" id="materi" aria-label="With textarea"></textarea>
        </div>
        <div class="row">
            <div class="col py-5">
                <div class="list-group" id="anggota-kelas">
                    <button type="button" class="list-group-item list-group-item-action">
                        <span>A</span>
                        <span class="ml-2">1. Aid Ayyashal Hunav</span>
                        <input type="text" name="" value="" class="absen">
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.id.min.js"></script>
<script>
    $(document).ready(function() {
        // JavaScript
        var today = new Date();
        var prevMonth = new Date(today.getFullYear(), today.getMonth() - 1, 26);
        var maxDate = new Date(today.getFullYear(), today.getMonth(), 25);

        // Jika sekarang bulan Januari, maka ambil Desember tahun sebelumnya
        if (today.getMonth() === 0) {
        prevMonth = new Date(today.getFullYear() - 1, 11, 25);
        }

        $('.input-group.date').datepicker({
            format: "DD, d MM yyyy",
            autoclose: true,
            language: 'id',
            weekStart: 1,
            startDate: prevMonth,
            endDate: maxDate
        });

        

        tahun = document.getElementById('tahun').value
        bulan = document.getElementById('bulan').value
        asatid = document.getElementById('asatid').value

      $('#tanggal').change(function() {
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/ajax_getMapel",
            data: {tahun, asatid},
            dataType : 'json', 
            success: function(data) {
                $('#mapel option').remove();
                $('#mapel').append('<option value="" selected>Pilih..</option>');
                $.each(data, function(index, option) {
                    $('#mapel').append('<option value="' + option.id_mapel + '">' + option.mapel_alias + '</option>');
                });
            },
        });
      });//akhir #ket 
      $('#mapel').change(function() {
          mapel = document.getElementById('mapel').value
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/ajax_getKelas",
            data: {tahun, asatid, mapel},
            dataType : 'json', 
            success: function(data) {
                $('#kelas option').remove();
                $('#kelas').append('<option value="" selected>Pilih..</option>');
                $.each(data, function(index, option) {
                    $('#kelas').append('<option data-jamke="'+option.jamke+'" value="' + option.id_kelas + '">' + option.nama_kelas + '</option>');
                });
            },
        });
      });//akhir #ket 

      $('#kelas').on('change', function() {
        const kelas = document.getElementById('kelas').value
        const mapel = document.getElementById('mapel').value
        const selectedOption = $(this).find(':selected');
        const data = selectedOption.data('jamke');
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/ajax_anggotaKelas",
            data: {kelas},
            dataType: "json",
            success: function (data) {
                $('#anggota-kelas button').remove()
                $.each(data, function (index, dt) { 
                     $('#anggota-kelas').append('<div class="list-group-item list-group-item-action">' +
                        '<span class="btn badge-success ling">A</span>' +
                        '<span class="ml-2">'+index+'. '+dt.nama_seijazah+'</span>' +
                        '<input type="text" name="" value="" class="absen">' +
                    '</div>')
                });
            }
        });

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/ajax_jadwal",
            data: {asatid, kelas, mapel},
            dataType: "json",
            success: function (data) {
                $('#jadwal option').remove();
                $('#jadwal').append('<option value="" selected>Pilih..</option>');
                $.each(data, function(index, option) {
                    $('#jadwal').append('<option value="'+option.id_kbm+'">Hari: '+option.hari+', Jam ke: '+option.jamke+'</option>');
                });
            }
        });
      });
      
    });
    

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
            $('#tambah').removeClass( "d-none" );
            }
        });

    });
</script>
