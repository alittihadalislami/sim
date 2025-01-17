<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
</link>

<style>
    .text-menu {
        font-size: 20px;
    }

    #nav-tab>.active {
        background-color: #f1c93c !important;
        color: black;
        box-shadow: none;
    }

    #nav-tab>button:focus {
        outline: none;
        cursor: pointer;
    }

    #nav-tab>button:hover {
        cursor: pointer;
    }

    #nav-tabContent>.active {
        background-color: transparent !important;
        box-shadow: none;
        font-weight: normal;
    }

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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Presensi Guru dan Pegawai</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg mb-2">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><a
                                href="<?= base_url('absensi/rekapPerCivitas')?>/1"><i
                                    class="far fa-calendar-alt"></i></a></span>
                        <div class="info-box-content">
                            <span class="info-box-number"
                                style="font-size: 18px"><?= $jam; ?></span>
                            <span class="progress-description" style="font-size: 18px">
                                <?= $tanggal; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col tabb">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Presensi</button>
                            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Rekap
                                Jurnal</button>
                            <button class="nav-link" id="rekap-santri" data-toggle="tab" type="button" role="tab"
                                aria-selected="false">Rekap Santri</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="row mt-4">
                                <?php if ($kategori == 1): ?>
                                <?php foreach ($jadwal as $j): ?>
                                <div class="col-lg-4 col-12">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="p-3 inner">
                                            <span
                                                class="text-menu badge badge-secondary"><?= $j['jamke'] ?></span>
                                            &nbsp&nbsp | &nbsp&nbsp
                                            <span
                                                class="text-menu"><?= $j['nama_kelas'] ?></span><br>
                                            <span class="text-menu"
                                                style="font-weight: bold;"><?= $j['mapel_alias'] ?></span><br>
                                            <!-- <span>User Registrations</span><br> -->
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </div>
                                        <a href="<?= base_url('absensi/dhsantri/').$j['id_kbm']?>"
                                            class="klik-lama small-box-footer py-3">Absen <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <?php endforeach ?>
                                <?php else: ?>
                                <div class="col-lg-6 col-12">
                                    <?php
                                        $hari = $atribut['nama_hari'];
                                        $tanggal = $atribut['tgl'];
                                        $bulan = $atribut['bulan'];
                                        $tahun = $atribut['tahun'];
                                        $id = $id_pegawai.$tanggal.$bulan.$tahun;
                                        $datang = $atribut['jam'].':'.$atribut['menit'];
                                        $pulang = $atribut['jam'].':'.$atribut['menit'];

                                        $ada = $this->db->get_where('t_jurnal_pegawai', ['id'=> $id])->row_array();
                                    ?>
                                    <?php if (!$ada['pulang']): ?>

                                    <?php if ($ada < 1): ?>
                                    <div class="small-box bg-light p-3">
                                        <form method="post" action="absensi/simpanPegawai">
                                            <div class="inner form-group">
                                                <h4><?= $level['nama_rule'] ?>
                                                </h4>
                                                <p id="latitude"></p>
                                                <p id="longitude"></p>
                                                <p id="tampilkan"></p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-edit fa-sm"></i>
                                            </div>
                                            <input hidden type="text"
                                                value="<?= $id ?>"
                                                name="id">
                                            <input hidden type="text"
                                                value="<?= $id_pegawai ?>"
                                                name="asatid_id">
                                            <input hidden type="text"
                                                value="<?= $semester_id ?>"
                                                name="semester_id">
                                            <input hidden type="text"
                                                value="<?= $hari ?>"
                                                name="hari">
                                            <input hidden type="text"
                                                value="<?= $tanggal ?>"
                                                name="tanggal">
                                            <input hidden type="text"
                                                value="<?= $bulan ?>"
                                                name="bulan">
                                            <input hidden type="text"
                                                value="<?= $tahun ?>"
                                                name="tahun">
                                            <input hidden type="text"
                                                value="<?= $datang ?>"
                                                name="datang">
                                            <button type="submit" class="btn btn-success my-2 float-right mr-4">Hadir <i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </form>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <?php else : ?>
                                    <div class="small-box p-3 ">
                                        <form method="post" action="absensi/simpanPegawai">
                                            <div class="inner form-group">
                                                <h4><?= $level['nama_rule'] ?>
                                                </h4>
                                                <p id="latitude"></p>
                                                <p id="longitude"></p>
                                                <p id="tampilkan"></p>
                                                <label class="mt-3" for="">Kegiatan</label>
                                                <input class="form-control" type="text" value="" list="fruits"
                                                    name="kegiatan" required />
                                                <datalist id="fruits">
                                                    <option
                                                        value="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione voluptatem similique iure praesentium cumque cupiditate numquam alias. Earum adipisci aspernatur assumenda cumque omnis unde delectus fugiat sit ex aliquam aut itaque, nulla voluptas nam totam illo excepturi numquam vitae error beatae. Dicta voluptate fugiat voluptatem, molestiae similique nulla dignissimos recusandae natus quia, hic doloremque fugit consequatur sunt cumque, mollitia error eaque necessitatibus reiciendis perferendis asperiores minima distinctio tenetur quo porro. Maiores voluptates sed doloribus beatae, explicabo nisi, minima quae, iusto facere modi sunt, commodi cumque ea sapiente deleniti quaerat dolor qui voluptatibus a ipsa libero. Voluptatibus odit, explicabo unde reiciendis.">
                                                    </option>
                                                </datalist>
                                            </div>
                                            <p class="text-right">Jam Kedatangan:
                                                <?= $ada['datang'] ?>
                                            </p>
                                            <div class="icon">
                                                <i class="fas fa-edit fa-sm"></i>
                                            </div>
                                            <input hidden type="text"
                                                value="<?= $id ?>"
                                                name="id">
                                            <input hidden type="text"
                                                value="<?= $pulang ?>"
                                                name="pulang">
                                            <button type="submit" class="btn btn-warning my-2 float-right ">Pulang <i
                                                    class="fas fa-arrow-circle-right text-light"></i></button>
                                        </form>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <?php endif ?>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <section>
                                <div class="row mt-2">
                                    <div class="col-lg-8">
                                        <div class="form-row">
                                            <div class="form-group col-lg-2">
                                                <label for="asatid">Tahun</label>
                                                <select class="chosen-single form-control" id="tahun" name="tahun"
                                                    required="">
                                                    <option value="">- pilih -</option>
                                                    <option value="2024">2024</option>
                                                    <option selected value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="asatid">Bulan</label>
                                                <select class="chosen-single form-control" id="bulan" name="bulan"
                                                    required="">
                                                    <option value="">- pilih -</option>
                                                    <?php $index=1; foreach ($bulan as $bln) : ?>
                                                    <?php $selected = $index++ == 7 ? 'selected' : ''; ?>
                                                    <option
                                                        value="<?=$bln?>"
                                                        <?=$selected?>><?=$bln?>
                                                    </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="asatid">Guru</label>
                                                <select class="chosen-single form-control" id="asatid" name="asatid"
                                                    required="">
                                                    <option value="">- pilih -</option>
                                                    <?php foreach ($list_guru as $guru) : ?>
                                                    <option selected
                                                        value="<?=$guru['id_asatid']?>">
                                                        <?=$guru['nama_asatid']?>
                                                    </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" id="cari" class="btn btn-primary">
                                            <i class="fas fa-list-ol mr-2"></i>Tampilkan
                                        </button>
                                        <button id="pdf" class="btn btn-danger">
                                            <i class="far fa-file-pdf mr-2"></i>PDF
                                        </button>
                                        <button id="tambah_data" class="btn btn-success float-right d-none">
                                            <i class="fas fa-plus-square mr-2"></i>Tambah data
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
                                                        <td colspan="8">silahkan klik tampilkan</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-responsive">
                                            </div>
                                        </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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


<script>
    //getLocation();

    var lang = document.getElementById("latitude");
    var long = document.getElementById("longitude");
    var view = document.getElementById("tampilkan");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            view.innerHTML = "Browser anda tidak support Geolocation, silahkan gunakan Google Chrome terbaru..";
        }
    }

    function showPosition(position) {
        lang.innerHTML = "Latitude: " + position.coords.latitude;
        long.innerHTML = "Longitude: " + position.coords.longitude;

    }

    function showError(error) {
        console.log('hilangkan tombol absen');
        switch (error.code) {
            case error.PERMISSION_DENIED:
                view.innerHTML = "<span class='text-danger'>Mohon izinkan pengaturan deteksi lokasi<span>"
                break;
            case error.POSITION_UNAVAILABLE:
                view.innerHTML = "Info lokasi anda tidak jelas"
                break;
            case error.TIMEOUT:
                view.innerHTML = "Request timeout"
                break;
            case error.UNKNOWN_ERROR:
                view.innerHTML = "An unknown error occurred."
                break;
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.id.min.js"></script>
<script src="<?=base_url()?>assets/js/rekap_kehadiran.js"></script>
<script>
    base_url = "<?php echo base_url();?>"
</script>