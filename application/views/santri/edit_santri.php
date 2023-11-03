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
  #data-psb .active {
    box-shadow : none;
    background: none !important;
    font-weight : normal ;
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
					<?php 
					$curl_handle = curl_init();
					$url = "https://opensheet.elk.sh/1Frs-WGBhnBXNOXOkFEaDmMvhobynO7idhP-5xFeTBo0/1";
					curl_setopt($curl_handle, CURLOPT_URL, $url);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
					$curl_data = curl_exec($curl_handle);
					curl_close($curl_handle);
					$response_data = json_decode($curl_data);
					// var_dump($response_data);
					$profil = base_url('assets/img/user.png');
					foreach ($response_data as $value) {
						$data_foto = explode(".",$value->nama_file)[0];
						if ( $data_foto == $santri['idk_mii'] )
							$profil = "https://drive.google.com/uc?export=view&id=".$value->id_file;
					}
				?>
                    <a href="#">
                      <img src="<?= $profil ?>" class="rounded float-left m-2 mb-4" height="150px">
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
                      <input id="j_idk_mii" type="text" class="form-control bg-white j_idk" readonly="true" value="<?=$santri['idk_mii']?>">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold">SMP</div>
                      </div>
                      <input id="j_idk_smp" type="text" class="form-control bg-white j_idk" readonly="<?=$readonly?>" value="<?=$santri['idk_umum']?>">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold">M A</div>
                      </div>
                      <input id="j_idk_ma" type="text" class="form-control bg-white j_idk" value="<?=$santri['idk_umum2']?>" readonly="<?=$readonly?>">
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

                      <div class="form-group d-none">
                        <input class="form-control"  name="alamat_pengenal" value="<?= isset($d_santri['alamat_pengenal']) ? $d_santri['alamat_pengenal'] : null ?>"></input>
                        <input class="form-control"  name="alamat_id" value="<?= isset($d_santri['alamat_id']) ? $d_santri['alamat_id'] : null ?>"></input>
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
                      <div class="row">
                        <div class="col-md-4 p-4">
                            <div class="form-group">
                                <label for="tgl_terima">1. Diterima di Ma'had tanggal</label>
                                <input type="text" name="tgl_terima_mii" data-toggle="datepicker" class="form-control" value="<?= isset($d_santri['tgl_terima_mii']) ? $d_santri['tgl_terima_mii'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas_terima_mii">2. Kelas</label>
                                <input type="text" class="form-control" name="kelas_terima_mii" value="<?= isset($d_santri['kelas_terima_mii']) ? $d_santri['kelas_terima_mii'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="semester_terima_mii">3. Semester</label>
                                <input type="number" class="form-control" name="semester_terima_mii" value="<?= isset($d_santri['semester_terima_mii']) ? $d_santri['semester_terima_mii'] : null ?>">
                            </div>
                        </div>
                        <div class="col-md-4 p-4 bg-secondary">
                            <div class="form-group">
                                <label for="tgl_terima_smp">1. Diterima di SMP tanggal</label>
                                <input type="text" name="tgl_terima_smp" data-toggle="datepicker" class="form-control" value="<?= isset($d_santri['tgl_terima_smp']) ? $d_santri['tgl_terima_smp'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas_terima_smp">2. Kelas</label>
                                <input type="text" class="form-control" name="kelas_terima_smp" value="<?= isset($d_santri['kelas_terima_smp']) ? $d_santri['kelas_terima_smp'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="semester_terima_smp">3. Semester</label>
                                <input type="number" class="form-control" name="semester_terima_smp" value="<?= isset($d_santri['semester_terima_smp']) ? $d_santri['semester_terima_smp'] : null ?>">
                            </div>
                        </div>
                        <!-- MA -->
                        <div class="col-md-4 p-4">
                            <div class="form-group">
                                <label for="tgl_terima_ma">1. Diterima di MA pada tanggal</label>
                                <input type="text" name="tgl_terima_ma" data-toggle="datepicker" class="form-control" value="<?= isset($d_santri['tgl_terima_ma']) ? $d_santri['tgl_terima_ma'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas_terima_ma">2. Kelas MA</label>
                                <input type="text" class="form-control" name="kelas_terima_ma" value="<?= isset($d_santri['kelas_terima_ma']) ? $d_santri['kelas_terima_ma'] : null ?>">
                            </div>
                            <div class="form-group">
                                <label for="semester_terima_ma">3. Semester MA</label>
                                <input type="number" class="form-control" name="semester_terima_ma" value="<?= isset($d_santri['semester_terima_ma']) ? $d_santri['semester_terima_ma'] : null ?>">
                            </div>
                        </div>
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
                
                <style>
                    /* The heart of the matter */
                    .testimonial-group > .row {
                        overflow-x: auto;
                        white-space: nowrap;
                    }
                    .testimonial-group > .row > .col-sm-6 {
                        display: inline-block;
                        float: none;
                    }

                </style>

                <div class="card">
                  <div class="btn btn-success collapsed" id="heading5" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5"><strong>NILAI</strong></div>
                  <div id="collapse5" class="collapse bg-light" aria-labelledby="heading5" data-parent="#accordion">
                    
                    <div class="card-body">
                      
                        <div class="row p-1">
                        
                        <div class="container testimonial-group">
                            <div class="row text-center flex-nowrap">
                                <?php foreach ($tahun_ada_nilai as $value) : ?>
                                <div class="col-sm-6">
                                    <div class="row text-center d-box flex">
                                        <div class="col mb-2">
                                            Tahun Pelajaran <?=$value['nama_tahun'].', Semester '.$value['semester'] ?>.
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col">
                                            <table class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Mata Pelajaran</th>
                                                        <th scope="col">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
													<?php
														$santri_id = $this->uri->segment(3);
														$CI =& get_instance();
														$CI->load->model('Santri_model');
														$nilai= $CI->Santri_model->nilai_per_tahun($value['tahun_id'],$santri_id);        
													?>
													<?php $no=1; foreach ($nilai as $key => $value) : ?>
                                                    <tr>
                                                        <th scope="row"><?=$no++?></th>
                                                        <td><?=$value['mapel_alias']?></td>
                                                        <td><?=$value['nrp']?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

                <!-- ========================================= -->
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
    function angka (jenis, maksimal) {
        $("input[name='"+jenis+"']").on("keypress ", function (event) {
            var inputValue = event.which;
            var currentValue = $(this).val();
            // hanya mengijinkan input angka (0-9)
            if (inputValue >= 48 && inputValue <= 57) {
                // membatasi panjang input tidak lebih dari 10 angka
                if (currentValue.length >= maksimal) {
                    event.preventDefault();
                }
                } else {
                // menghentikan input jika bukan angka
                event.preventDefault();
                }
            });

            $("input[name='"+jenis+"']").on("keyup ", function (event) {
                var currentValue = $(this).val();
                if (currentValue.length == maksimal) {
                $(this).removeClass("is-invalid");
                }else{
                $(this).addClass("is-invalid");
                }
            });
        }

        data = [
            ['nisn',10],
            ['nok',16],
            ['nik_bapak',16],
            ['nik_ibu',16],
            ['nik',16]
        ]
        data.forEach(element => {
            angka(element[0],element[1])
        });


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
          if (el.name != 'nama_minat') {
            if (el.name != 'kategori_minat') {
                daput [el.name] = el.value
            }
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
            response = 'Data perubahan berhasil disimpan';
          }else{
            icon = 'info';
            response = 'Tidak ada perubahan yang disimpan';
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
        induk = $(this).parent();
        loading_spinner = '<img class="mx-2" style="position:absolute; z-index:10; left:10px;" id="loading_spinner"  src="<?=base_url()?>assets/img/ajax-loader.gif">';
        $(induk).prepend(loading_spinner);
      minat = $(this).data("id_minat");
      santri = $(this).data("id_santri");
      kotak = $(this).siblings()
      $.ajax({
        type:'post',
        url:'<?=base_url()?>Santri/simpanKlub',
        data:{minat_id:minat,santri_id:santri},
        dataType: "json",
        beforSend: function () {
        },
        success:function(data){
            if (data.status == false) {
                Swal.fire({
                    icon: 'error',
                    position :'top-end',
                    timer: 2500,
                    toast: true,
                    showConfirmButton: false,
                    title : 'akses tidak diperbolehkan',
                })
            } else {
                if (data.substring(0,4) == 'Hapu') {
                    pesan = 'data peminatan berhasil <span class="text-danger">dihapus</span>'
                    tanda = 'success'
                }else {
                    pesan = 'data peminatan berhasil <span class="text-success">disimpan</span>'
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

                if ($(kotak).is(':checked')) {
                    $(kotak).prop('checked', false)
                }else{
                    $(kotak).prop('checked', true)
                }
                $('#loading_spinner').remove();
            }
        }
      })
      
      return false;
    })

    $('.cek-peminatan').click(function(e){
        minat = $(this).data("id_minat");
        santri = $(this).data("id_santri");
        $.ajax({
            type:'post',
            url:'<?=base_url()?>Santri/simpanKlub',
            data:{minat_id:minat,santri_id:santri},
            dataType: "json",
            success:function(data){
                if (data.status == false) {
                    Swal.fire({
                        icon: 'error',
                        position :'top-end',
                        timer: 2500,
                        toast: true,
                        showConfirmButton: false,
                        title : 'akses tidak diperbolehkan',
                    })
                } else {
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

    //nomor induk
    id = <?=$santri['id_santri']?>;
    target = $('.j_idk')
    $.each(target, function (i, t) { 
         if (t.value == ''){
           $(this).attr("readonly", false)
           $(this).keypress(function( e ) {
            if(e.which > 31 && (e.which < 48 || e.which > 57))
                return false;
            });
           $(this).change(function (e) { 
            e.preventDefault();
            clean_input = $(this).val().replace(/\D/g, '')
            $(this).val(clean_input)
            $.ajax({
                url:'<?=base_url()?>santri/j_induk',
                type:'post',
                data:{id_santri:id,induk:$(this).val(), index:i},
                typeData:'json',
                success:function(){

                }
            })
           });
         }
    });

    idk_smp_t_detail = <?= $d_santri['idk_smp'] == NULL ? "0" : $d_santri['idk_smp'] ?> 
    idk_ma_t_detail = <?= $d_santri['idk_ma'] == NULL ? "0" : $d_santri['idk_ma'] ?> 

    if ( $('#j_idk_smp').val() == "" ) {
        if (idk_smp_t_detail != 0 ) {
            $('#j_idk_smp').val(idk_smp_t_detail)
        }
    }
    if ( $('#j_idk_ma').val() == "" ) {
        if (idk_ma_t_detail != 0 ) {
            $('#j_idk_ma').val(idk_ma_t_detail)
        }
    }

    $.ajax({
        type: "post",
        url: "<?=base_url()?>santri/generateNikOrtu/<?=$santri['nisn']?>",
        dataType: "json",
        success: function (response) {
            for (const [key, value] of Object.entries(response)) {
                if (key === 'id_santri' || key === 'nisn') {
                }else{
                    inputan = $('input[name="'+key+'"]')
                    if (inputan.val() == '') {
                        inputan.val(value)
                    }
                }
            }
        }
    });

  })
</script>