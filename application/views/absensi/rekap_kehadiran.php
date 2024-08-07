<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"></link>

<style>
    .input-group-text {
      width: 120px;
    }
    .ling{
        border-radius: 20px 20px;
        width: 30px;
        height: 30px;
        padding: 2px;
        font-weight: bold;
    }
    .absen{
        width: 20px;
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
                   <button type="button" id="tambah" class="btn btn-primary d-none float-right">
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
<div class="modal fade" id="ajuanModal" tabindex="-1" aria-labelledby="ajuanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ajuanModalLabel">Pengajuan Presensi Asatid</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="ket">Keterangan</label>
            </div>
            <select class="custom-select" id="ket">
                <option value="" selected>Pilih...</option>
                <option value="1">Lupa</option>
                <option value="1">Pindah Jadwal</option>
            </select>
        </div> -->
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
                <option value="" selected>Pilih...</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="kelas">Kelas</label>
            </div>
            <select class="custom-select f-tambah" id="kelas">
                <option value="" selected>Pilih...</option>
            </select>
        </div>
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="">Jadwal</label>
            </div>
            <select class="custom-select f-tambah" id="id_kbm">
                <option value="" selected>Pilih...</option>
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
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="simpan-ajuan">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.id.min.js"></script>
<script src="<?=base_url()?>assets/js/rekap_kehadiran.js"></script>
<script>var base_url = '<?php echo base_url(); ?>';</script>