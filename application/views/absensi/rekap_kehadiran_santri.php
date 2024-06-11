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
                        <div class="form-group col-lg-3">
                            <label for="asatid">Kelas</label>
                            <select class="chosen-single form-control" id="kelas" name="asatid" required="">
                                <option value="">- pilih -</option>
                                <?php foreach ($list_kelas as $kelas) : ?>
                                    <option value="<?=$kelas['id_kelas']?>"><?=$kelas['nama_kelas']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="asatid">Mapel</label>
                            <select class="chosen-single form-control" id="mapel" name="asatid" required="">
                                <option value="">- pilih -</option>
                                <?php foreach ($list_mapel as $mapel) : ?>
                                    <option value="<?=$mapel['id_mapel']?>"><?=$mapel['nama_mapel']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                   <button type="submit" id="cari" class="btn btn-primary">Tampilkan</button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-stripped table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th scope="col" rowspan=2 class="text-center align-middle">#</th>
                                    <th scope="col" rowspan=2 class="text-center align-middle">Nama Santri</th>
                                    <th scope="col" rowspan=2 class="text-center align-middle">Kelas</th>
                                    <!-- <th scope="col" colspan="31" class="text-center align-middle">Tanggal</th> -->
                                    <th scope="col" colspan="4" class="text-center align-middle">Jumlah</th>
                                </tr>
                                <tr>
                                    <!-- <?php for ($i=1; $i<32 ; $i++) : ?>
                                        <th scope="col"><?=$i?></th>
                                    <?php endfor ?> -->
                                    <th>alpa</th>
                                    <th>sakit</th>
                                    <th>ijin</th>
                                    <!-- <th>hadir</th> -->
                                </tr>
                            </thead>
                            <tbody id="data">
                                <tr>
                                    <td colspan="40">no data</td>
                                </tr>
                            </tbody>
                        </table>
                    <div class="table-responsive">
                </div>
            </div>
        </section>
  </section>
</div>

<script>
    $('#cari').click(function (e) { 
        e.preventDefault();
        tahun = document.getElementById('tahun').value
        bulan = document.getElementById('bulan').value
        kelas = document.getElementById('kelas').value
        mapel = document.getElementById('mapel').value
        
        if (tahun == '' || bulan =='' || kelas == '' || mapel == '' ) {
            alert('Silahkan pilih data terlebih dahulu')
            return 
        }

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>absensi/santri_ajax",
            data: {tahun, bulan, kelas, mapel},
            dataType : 'json', 
            // beforeSend: function () {  
            // buatLoading();
            // },
            success: function (response) {
                console.log(response.length)
                hasil = '123'
                for (let i = 0; i < response.length; i++) {
                    hasil += '<tr><td>'+ (i+1)+'</td>' +
                    '<td>'+response[i]['detail']['nama_santri']+'</td>' + 
                    '<td>'+response[i]['detail']['nama_santri']+'</td>' + 
                     '<td>'+response[i]['alpa']+'</td>' + 
                     '<td>'+response[i]['sakit']+'</td>' + 
                     '<td>'+response[i]['ijin']+'</td></tr>'
                    console.log(hasil)
                }
            $('#data').html(hasil)
            }
        });

    });
</script>
