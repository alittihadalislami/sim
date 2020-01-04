<style>
  @media only screen and (min-width: 769px) {
    .alert{
      /*margin-left: 15%;*/
      margin-right: auto;
      margin-left: auto;
    }
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

              <div class="form-group">
                <label for="asatid">Nama Santri</label>
                <input type="text" class="form-control" style="font-weight: bold; font-size: 20px; color: black" value="<?=$santri['nama_santri']?>" required="true" readonly="true">
              </div>
              <div class="form-group">
                <label for="asatid">No Induk Ma'had</label>
                <input type="text" class="form-control" name="santri_id" value="<?=$santri['id_santri']?>" required="true" readonly="true" hidden="true">
                <input type="text" class="form-control" value="<?=$santri['idk_mii']?>" required="true" readonly="true">
              </div>

              <div id="accordion">

                <div class="card">
                  <div class="btn btn-primary" style="background-color:smokewithe" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>DATA KELUARGA, DUKCAPIL</strong>
                  </div>

                  <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nik">1. No Induk Kependudukan (DUKCAPIL)</label>
                        <input type="number" class="form-control" name="nik" value="<?= isset($d_santri['nik']) ? $d_santri['nik'] : null ?>">
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
                      <div class="form-group">
                        <label for="kerja_bapak">6. Pekerjaan Bapak</label>
                        <input type="text" class="form-control" name="kerja_bapak" value="<?= isset($d_santri['kerja_bapak']) ? $d_santri['kerja_bapak'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="ibu">7. Nama Ibu</label>
                        <input type="text" class="form-control" name="ibu" value="<?= isset($d_santri['ibu']) ? $d_santri['ibu'] : null ?>">
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
                        <input type="date" name="tgl_lahir" max="2019-12-31" min="1990-01-01" class="form-control" value="<?= isset($d_santri['tgl_lahir']) ? $d_santri['tgl_lahir'] : null ?>">
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
                        <input type="date" name="tgl_terima" max="2019-12-31" min="1990-01-01" class="form-control" value="<?= isset($d_santri['tgl_terima']) ? $d_santri['tgl_terima'] : null ?>">
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
                        <label for="hp_bapak">4. Nomor HP Bapak</label>
                        <input type="number" class="form-control" name="hp_bapak" value="<?= isset($d_santri['hp_bapak']) ? $d_santri['hp_bapak'] : null ?>">
                      </div>
                      <div class="form-group">
                        <label for="hp_ibu">5. Np HP Ibu</label>
                        <input type="number" class="form-control" name="hp_ibu" value="<?= isset($d_santri['hp_ibu']) ? $d_santri['hp_ibu'] : null ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="sumbit" class="btn btn-primary float-right elevation-4">Simpan</button>
            </form>
          </div>

            

          </div>
        </div>
      </div>
    </div>
  </section>
</div>