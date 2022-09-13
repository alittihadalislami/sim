<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"></link>

<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto;
    }
  }
  .input-group>.input-group-prepend {
      flex: 0 0 20%;
  }
  .input-group .input-group-text {
      width: 100%;
  }
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="row">

      <?= $this->session->flashdata('pesan'); ?>

      <div class="col-md mx-auto">

        <div class="card mt-5">

          <div class="card-header">
            <h3 class="card-title">Perubahan data santri</h3>
          </div>

          <div class="card-body">
            
            <form action="<?= base_url('santri/ubah_santri') ?>" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <a href="#">
                      <img src="<?= base_url('assets/img/user.png')?>" class="rounded float-left m-2 mb-4" alt="Cinque Terre" height="100px">
                    </a>
                    <a href="<?= base_url("santri/sinkronDataPsb/").$santri['nisn']?>" class="btn btn-warning btn-sm float-right <?=$nisn ? '' : 'disabled' ?>" id="singkronPsb"><i class="fas fa-cloud-download-alt"></i> Sinkron data psb</a>
                  </div>
                </div>
              <div class="form-group">
                <label>Nama Santri</label>
                <input type="text" class="form-control" style="font-weight: bold; font-size: 20px; color: black" value="<?=$santri['nama_santri']?>" required="true" readonly="true" id="nama_daftar">
              </div>
              <div class="form-group">
                <label>Nomor Induk</label>
                <input type="text" class="form-control" name="santri_id" value="<?=$santri['id_santri']?>" required="true" readonly="true" hidden="true">
                
                <div class="row">
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold">MII</div>
                      </div>
                      <input type="text" class="form-control bg-white" readonly="true" value="<?=$santri['idk_mii']?>">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold">SMP</div>
                      </div>
                      <input type="text" class="form-control bg-white" readonly="<?=$readonly?>" value="<?=$santri['idk_umum']?>">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold">M A</div>
                      </div>
                      <input type="text" class="form-control bg-white" value="<?=$santri['idk_umum2']?>" readonly="<?=$readonly?>">
                    </div>
                  </div>
                </div>
              </div>

              <div id="accordion">

                <div class="card">
                  <div class="btn btn-primary" style="background-color:smokewithe" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>DATA KELUARGA, DUKCAPIL</strong>
                  </div>

                  <div id="collapseOne" class="collapse bg-light" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nik">1. No Induk Kependudukan (DUKCAPIL)</label>
                        <input type="number" class="form-control" id="nik" name="nik" value="<?= isset($d_santri['nik']) ? $d_santri['nik'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="nok">2. No Kartu Keluarga (DUKCAPIL)</label>
                        <input type="number" class="form-control" name="nok" value="<?= isset($d_santri['nok']) ? $d_santri['nok'] : null ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="anak_ke">3. Anak Ke</label>
                        <input type="number" class="form-control" name="anak_ke" value="<?= isset($d_santri['anak_ke']) ? $d_santri['anak_ke'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="jml_saudara">4. Jumlah Saudara</label>
                        <input type="number" class="form-control" name="jml_saudara" value="<?= isset($d_santri['jml_saudara']) ? $d_santri['jml_saudara'] : null ?>">
                      </div>

                      <div class="form-group">
                        <label for="bapak">5. Nama Bapak</label>
                        <input type="text" class="form-control" name="bapak" value="<?= isset($d_santri['bapak']) ? $d_santri['bapak'] : null ?>">
                      </div>
                      <div class="form-group pl-1" style="border-left: 5px solid gold">
                        <label for="ibu">5.1. NIK Bapak</label>
                        <input type="number" maxlength="16" class="form-control text-bold" name="nik_bapak" value="<?= isset($d_santri['nik_bapak']) ? $d_santri['nik_bapak'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="kerja_bapak">6. Pekerjaan Bapak</label>
                        <input type="text" class="form-control" name="kerja_bapak" value="<?= isset($d_santri['kerja_bapak']) ? $d_santri['kerja_bapak'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="ibu">7. Nama Ibu</label>
                        <input type="text" class="form-control" name="ibu" value="<?= isset($d_santri['ibu']) ? $d_santri['ibu'] : null ?>">
                      </div>
                      <div class="form-group pl-1" style="border-left: 5px solid gold">
                        <label for="ibu">7.1. NIK Ibu</label>
                        <input type="number" maxlength="16" class="form-control text-bold" name="nik_ibu" value="<?= isset($d_santri['nik_ibu']) ? $d_santri['nik_ibu'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="kerja_ibu">8. Pekerjaan Ibu</label>
                        <input type="text" class="form-control" name="kerja_ibu" value="<?= isset($d_santri['kerja_ibu']) ? $d_santri['kerja_ibu'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="alamat_ortu">9. Alamat orang tua</label>
                        <textarea class="form-control" rows="5" name="alamat_ortu"><?= isset($d_santri['alamat_ortu']) ? $d_santri['alamat_ortu'] : null ?></textarea>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="btn btn-primary collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><strong>DATA IJAZAH, SKHU</strong>
                  </div>
                  <div id="collapseTwo" class="collapse bg-light" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nama_seijazah">1. Nama Santri sesuai IJAZAH</label>
                        <input type="text" class="form-control" name="nama_seijazah" value="<?= isset($d_santri['nama_seijazah']) ? $d_santri['nama_seijazah'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="tmp_lahir">2. Tempat Lahir</label>
                        <input type="text" class="form-control" name="tmp_lahir" value="<?= isset($d_santri['tmp_lahir']) ? $d_santri['tmp_lahir'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="tgl_lahir">3. Tanggal Lahir</label>
                        <input class="form-control" type="text" id="tgl_lahir" data-toggle="datepicker" name="tgl_lahir" value="<?= isset($d_santri['tgl_lahir']) ? $d_santri['tgl_lahir'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="bapak_seijazah">4. Nama Bapak sesuai IJAZAH</label>
                        <input type="text" class="form-control" name="bapak_seijazah" value="<?= isset($d_santri['bapak_seijazah']) ? $d_santri['bapak_seijazah'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="nisn">5. NISN</label>
                        <input type="number" class="form-control" name="nisn" value="<?= isset($d_santri['nisn']) ? $d_santri['nisn'] : null ?>">
                      </div>

                      <div class="form-group">
                        <label for="no_ujian">6. Nomor Peserta Ujian</label>&nbsp<small>Silahkan tulis tanpa strip</small>
                        <input type="number" class="form-control" name="no_ujian" value="<?= isset($d_santri['no_ujian']) ? $d_santri['no_ujian'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="nilai_ijazah">7. Jumlah Nilai Ijazah</label>
                        <input type="number" class="form-control" name="nilai_ijazah" value="<?= isset($d_santri['nilai_ijazah']) ? $d_santri['nilai_ijazah'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="seri_ijazah">8. No Seri Ijazah</label>
                        <input type="text" class="form-control" name="seri_ijazah" value="<?= isset($d_santri['seri_ijazah']) ? $d_santri['seri_ijazah'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="seri_skhun">9. No Seri SKHUN</label>
                        <input type="text" class="form-control" name="seri_skhun" value="<?= isset($d_santri['seri_skhun']) ? $d_santri['seri_skhun'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="tahun_ijazah">10. Tahun Ijazah/SKHUN</label>
                        <input type="number" class="form-control" name="tahun_ijazah" value="<?= isset($d_santri['tahun_ijazah']) ? $d_santri['tahun_ijazah'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="sekolah_asal">11. Nama sekolah asal</label>
                        <input type="text" class="form-control" name="sekolah_asal" value="<?= isset($d_santri['sekolah_asal']) ? $d_santri['sekolah_asal'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="npsn">12. NPSN sekolah asal</label>
                        <input type="number" class="form-control" name="npsn" value="<?= isset($d_santri['npsn']) ? $d_santri['npsn'] : null ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="btn btn-primary collapsed" id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3"><strong>DATA PPDB</strong></div>
                  <div id="collapse3" class="collapse bg-light" aria-labelledby="heading3" data-parent="#accordion">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="tgl_terima">1. Diterima tanggal</label>
                        <input type="text" name="tgl_terima" data-toggle="datepicker" class="form-control" value="<?= isset($d_santri['tgl_terima']) ? $d_santri['tgl_terima'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="kelas_terima">2. Kelas</label>
                        <input type="text" class="form-control" name="kelas_terima" value="<?= isset($d_santri['kelas_terima']) ? $d_santri['kelas_terima'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="semester_terima">3. Semester</label>
                        <input type="number" class="form-control" name="semester_terima" value="<?= isset($d_santri['semester_terima']) ? $d_santri['semester_terima'] : null ?>">
                      </div>

                      <div class="form-group">
                        <label for="hp_bapak">6. Nomor HP Bapak</label>
                        <input type="number" class="form-control" name="hp_bapak" value="<?= isset($d_santri['hp_bapak']) ? $d_santri['hp_bapak'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="hp_ibu">7. Nomor HP Ibu</label>
                        <input type="number" class="form-control" name="hp_ibu" value="<?= isset($d_santri['hp_ibu']) ? $d_santri['hp_ibu'] : null ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="btn btn-info collapsed" id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4"><strong>PEMINATAN</strong></div>
                  <div id="collapse4" class="collapse bg-light" aria-labelledby="heading4" data-parent="#accordion">
                    
                    <div class="card-body">
                      
                      <div class="btn-group float-right mb-3" role="group">
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal" id="DaftarPeminatan">Daftar Peminatan</button>
                        <button type="button" class="btn btn-success"><i class="fas fa-list-ul"></i></button>
                      </div>

                      <br style="clear:both" />

                      <div class="row">
                     
                        <?php $no=1; foreach ($kategori as $kat): ?>
                          

                        <div class="card col-md-6 col-xl-3 px-0 m-3 justify-content-center">
                            <div class="card-header font-weight-bold text-uppercase bg-secondary">
                              <?= $no++. '. '.$kat ?>
                            </div>
                          <div class="card-body">

                        <?php foreach ($list_minat as $value):

                          if ($value->kategori_minat == $kat) {

                          $check = $this->sm->klubTerpilih($santri['id_santri'],$value->id_minat);
                          if ($check > 0) {
                            $checked = 'checked';
                          }else{
                            $checked = null;
                          }

                        ?> 
                          
                          
                          <div>
                            <input 
                            class="cek-peminatan"
                            id="<?= $value->id_minat ?>" 
                            type="checkbox" 
                            minat="minat[]" <?= $checked ?> 
                            data-id_santri="<?=$santri['id_santri']?>" 
                            data-id_minat="<?= $value->id_minat ?>" 
                            >
                            
                            <label 
                              class="pilihan-peminatan" 
                              style="cursor: pointer;"
                              for="<?= $value->id_minat ?>" 
                              data-id_santri="<?=$santri['id_santri']?>" 
                              data-id_minat="<?= $value->id_minat ?>"  
                            > 
                              <?= $value->nama_minat ?>
                            </label>
                          </div>

                          </li>
                          <?php } ?>

                        <?php endforeach ?>

                           </div>
                        </div>
                        <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <button type="sumbit" class="btn btn-primary float-right elevation-4">Simpan</button> -->
              <a id="simpan2" class="btn btn-primary elevation-4 float-right text-white">Simpan</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" style="overflow-y: auto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Peminatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="" class="btn btn-sm btn-outline-success mb-3 float-right" data-toggle="modal" data-target="#addModal">+ Tambah</a>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Minat</th>
              <th scope="col">Ketegori</th>
              <?php if ($this->session->userdata('rule_id')<5): ?>
                <th scope="col">Opsi</th>
              <?php endif ?>
            </tr>
          </thead>
          <tbody id="minat1"> <!-- diisi oleh ajax -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="tutupDaftar" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Peminatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?= base_url()?>santri/tambah_minat" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="minat">Nama Minat</label>
              <input type="text" class="form-control" id="nama_minat" name="nama_minat" placeholder="Nama Minat" required>
            </div>
            <div class="form-group">
              <label for="minat">Kategori Minat</label>
              <select class="form-control" name="kategori_minat" id="kategori_minat" required="true">
              <option value="">--pilih--</option>
                <?php foreach ($kategori as $key => $value): ?>
                  <option value="<?=$value ?>"><?=$value ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="saveMinat">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal EDIT-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Peminatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?= base_url()?>santri/tambah_minat" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="minat">Nama Minat</label>
              <input type="text" class="form-control" id="e_nama_minat" name="nama_minat" placeholder="Nama Minat" required>
              <input type="text" class="form-control" id="e_id_minat" name="nama_minat" placeholder="ID Minat" hidden="true">
            </div>
            <div class="form-group">
              <label for="minat">Kategori Minat</label>
              <select class="form-control" name="kategori_minat" id="e_kategori_minat" required="true">
              <option value="">--pilih--</option>
                <?php foreach ($kategori as $key => $value): ?>
                  <option value="<?=$value ?>"><?=$value ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="save_e_Minat">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.id.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css"></link>
<Style>
  #rotate {
    width: 20px;
    height: 20px;
    animation-name: spin;
    animation-duration: 2000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear; 
  }
  @keyframes spin {
    from {
      transform:rotate(0deg);
    }
    to {
      transform:rotate(360deg);
    }
  }
</Style>

<script>
  $(document).ready(function(){
    
    url_gif = '<?=base_url()?>assets/img/rotate2.svg'
    const buatLoading = () => {
      spinner = '<img class="mx-4" id="rotate" src='+url_gif+'>';
      $('#simpan2').html(spinner)
    }

    // simpan ajax
    $("#simpan2").on('click', function(e){
      const collectData = () => {
        let data = $('form').serializeArray()
        let daput = {}
        data.forEach(function(el,index){
          if (index <= 28 ) {
            daput [el.name] = el.value
          }
        });
        return daput
      }

      $.ajax({
        type: "POST",
        url: "<?=base_url()?>santri/ubah_santri",
        data: {ajax:collectData()},
        beforeSend: function () {  
          buatLoading();
        },
        success: function (response) {
          if (response == 'berhasil diubah') {
            icon = 'success';
          }else{
            icon = 'info';
          }
          Swal.fire({
            title: response,
            icon: icon,
            position :'top-end',
            // timer: 2500,
            toast: true,
            showConfirmButton: false,
          })
          $('#simpan2').html('Simpan')
        }
      });
    });

    $('input[data-toggle="datepicker"]').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        language: 'id'
    });

    $('input[data-toggle="datepicker"]').change(function (e) { 
      e.preventDefault();
      tgl = $(this).val().split("-")
      bulan_angka= tgl[1]-1
      bulan_huruf = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
      $( ".kotak_terbilang" ).remove();
      $(this).after('<div class="ml-2 text-bold text-success small kotak_terbilang"><i class=<i class="fa-calendar-alt"></i>'+(tgl[0]+' '+bulan_huruf[bulan_angka].toUpperCase()+' '+tgl[2])+'</div>')
    });

    $('.pilihan-peminatan').click(function(evt){
      minat = $(this).data("id_minat");
      santri = $(this).data("id_santri");
      $.ajax({
        type:'post',
        url:'<?=base_url()?>Kesantrian/simpanKlub',
        data:{minat_id:minat,santri_id:santri},
        success:function(data){
          if (data.substring(0,4) == 'Hapu') {
            pesan = 'data peminatan berhasil dihapus'
            tanda = 'error'
          }else {
            pesan = 'data peminatan berhasil disimpan'
            tanda = 'success'
          }
          Swal.fire({
            icon: tanda,
            position :'top-end',
            timer: 2500,
            toast: true,
            showConfirmButton: false,
            title : pesan,
          })
        }
      })
      kotak = $(this).siblings()
      if ($(kotak).is(':checked')) {
        $(kotak).prop('checked', false)
      }else{
        $(kotak).prop('checked', true)
      }
      return false;
    })

    $('.cek-peminatan').click(function(e){
      minat = $(this).data("id_minat");
      santri = $(this).data("id_santri");
      $.ajax({
        type:'post',
        url:'<?=base_url()?>Kesantrian/simpanKlub',
        data:{minat_id:minat,santri_id:santri},
        success:function(data){
          if (data.substring(0,4) == 'Hapu') {
            pesan = 'data peminatan berhasil dihapus'
            tanda = 'error'
          }else {
            pesan = 'data peminatan berhasil disimpan'
            tanda = 'success'
          }
          Swal.fire({
            icon: tanda,
            position :'top-end',
            timer: 2500,
            toast: true,
            showConfirmButton: false,
            title : pesan,
          })
        }
      })
    })

    function tampilMinat(){
      tabel = '';
      $.ajax({
        url:'<?=base_url()?>santri/tampilMinat',
        type:'post',
        typeData:'json',
        success:function(hasil){
          $('#minat1').html(hasil);
        }
      })
    }

    $('#DaftarPeminatan').on('click',function(){
      tampilMinat()
    })

    $(document).on('click', ".hapus", function () {
      
      id = $(this).data('id');
      minat = $(this).data('minat');
      
      if (confirm("Yakin mau menghapus: "+minat+"?")) {
        $.ajax({
          url:'<?=base_url()?>santri/hapus_minat',
          type:'post',
          typeData:'html',
          data:{id_minat:id},
          success:function(){
            tampilMinat()
          }
        })
      } 
      return false

    })

    $('#saveMinat').on('click', function(){
      
      id = $('#id_santri').val()
      nama = $('#nama_minat').val();
      kategori = $('#kategori_minat').val();
      if ( $.trim(nama) === '' || $.trim(kategori) === '' ) {
        alert('tidak boleh nambah data kosong')
      }else{
        $.ajax({
          url:'<?=base_url()?>santri/tambah_minat',
          type:'post',
          typeData:'html',
          data:{id_santri:id,nama_minat:nama,kategori_minat:kategori},
          success:function(){
            tampilMinat()
          }
        })
      }
    })

    $(document).on('click', ".editMinat", function () {
      
      id = $(this).data('id')
      minat = $(this).data('minat')
      kategori = $(this).data('kategori')

      $('#e_id_minat').val(id)
      $('#e_nama_minat').val(minat)
      $('#e_kategori_minat').val(kategori)
      
      
    })

    $('#save_e_Minat').on('click', function(){

      id = $('#e_id_minat').val()
      minat = $('#e_nama_minat').val()
      kategori = $('#e_kategori_minat').val()

      $.ajax({
        url:'<?=base_url()?>kesantrian/ubahMinat',
        type:'post',
        data:{id_minat:id,nama_minat:minat,kategori_minat:kategori},
        typeData:'json',
        success:function(){
          tampilMinat()
        }
      })
    })


    $('#tutupDaftar').on('click',function(){
      $('#collapse4').addClass('show')
      window.location.href = "";
    })

    nama_seijazah = $('input[name="nama_seijazah"]').filter(function() { return $(this).val() == ""; });
    if (nama_seijazah.length > 0) {
      $(nama_seijazah).val($('input[id="nama_daftar"]').val())
      console.log('dijalankan')
    }

    kosong = $('input').filter(function() { return $(this).val() == ""; });
    kosong.css("background-color", "gold");
    kosong.on('keyup', function(){
      if ($(':focus').val() == '') {
        $(':focus').css("background-color", "gold")
      }else{
        $(':focus').css("background-color", "")
      }
    })

    alamat_ortu = $('textarea[name="alamat_ortu"]');
    if (alamat_ortu.val() == '') {
      alamat_ortu.css("background-color", "gold")
    }
    alamat_ortu.on('keyup',function(){
      if (alamat_ortu.val() == '') {
        alamat_ortu.css("background-color", "gold")
      }else{
        alamat_ortu.css("background-color", "")
      }
    })

    //menampilakan box yang masih terdapat data kosong
    for (let i = 1; i < kosong.length; i++) {
      const e_sebelumnya = kosong[i-1].parentElement.parentElement.parentElement
      const e = kosong[i].parentElement.parentElement.parentElement
      if ($(e).attr('data-parent') == '#accordion') {
        if (e != e_sebelumnya) {
          $(e).addClass('show')
        }
      }
    }

  })
</script>