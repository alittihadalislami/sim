<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
</link>

<style>
    .input-group-text {
        width: 120px;
    }

    .ling {
        border-radius: 20px 20px;
        width: 30px;
        height: 30px;
        padding: 2px;
        font-weight: bold;
    }

    .absen {
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
                            <div class="form-group col-lg-4 float-right">
                                <label for="asatid">Tahun</label>
                                <select class="chosen-single form-control" id="tahun_ajaran" name="tahun" required="">
                                    <option selected value="">- pilih -</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2024-2025">2024-2024</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 mb-3">
                        <button type="submit" id="cari" class="btn btn-primary">
                            Tampilkan
                        </button>
                        <button type="button" id="tambah" class="btn btn-primary float-right">
                            Tambah data
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="table-responsive">
                            <table class="table table-sm table-stripped table-bordered">
                                <thead class="bg-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Guru</th>
                                        <th scope="col">Lembaga</th>
                                        <th scope="col">Tugas</th>
                                        <th scope="col">No SK</th>
                                        <th scope="col">Unduh</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                    <tr>
                                        <td colspan="4">no data</td>
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
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formLabel">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-1 date" data-provide="datepicker">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Tahun Ajaran</label>
                    </div>
                    <input type="text" class="form-control" id="tahun">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="lembaga">Lembaga</label>
                    </div>
                    <select class="custom-select f-tambah" id="lembaga">
                        <option value="" selected>Pilih...</option>
                        <option value="1" selected>Ma'had</option>
                        <option value="2" selected>MA</option>
                        <option value="3" selected>SMP</option>
                    </select>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="asatid">Nama Asatid</label>
                    </div>
                    <select class="custom-select f-tambah" id="asatid">
                        <option value="" selected>Pilih...</option>
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
                        <option value="" selected>Pilih...</option>
                    </select>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="">Tugas</label>
                    </div>
                    <select class="custom-select f-tambah" id="tugas">
                        <option selected>Pilih...</option>
                        <option value="2">Guru</option>
                        <option value="3">Pegawai</option>
                    </select>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="">Status</label>
                    </div>
                    <select class="custom-select f-tambah" id="status">
                        <option selected>Pilih...</option>
                        <option value="tetap">Tetap</option>
                        <option value="tidak tetap">Tidak Tetap</option>
                    </select>
                </div>
                <div class="input-group mb-1 date" data-provide="datepicker">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Nomor Surat</label>
                    </div>
                    <input type="text" class="form-control" id="no_surat">
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
<script src="<?=base_url()?>assets/js/yayasan.js"></script>
<script>
    base_url = "<?php echo base_url();?>"
</script>