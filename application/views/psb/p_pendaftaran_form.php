<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">P_pendaftaran <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nik <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nisn <?php echo form_error('nisn') ?></label>
            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Nisn" value="<?php echo $nisn; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Npsn Asal <?php echo form_error('npsn_asal') ?></label>
            <input type="text" class="form-control" name="npsn_asal" id="npsn_asal" placeholder="Npsn Asal" value="<?php echo $npsn_asal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat Pengenal <?php echo form_error('alamat_pengenal') ?></label>
            <input type="text" class="form-control" name="alamat_pengenal" id="alamat_pengenal" placeholder="Alamat Pengenal" value="<?php echo $alamat_pengenal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nohp <?php echo form_error('nohp') ?></label>
            <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nohp" value="<?php echo $nohp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Lp <?php echo form_error('lp') ?></label>
            <input type="text" class="form-control" name="lp" id="lp" placeholder="Lp" value="<?php echo $lp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tmp Lahir <?php echo form_error('tmp_lahir') ?></label>
            <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" placeholder="Tmp Lahir" value="<?php echo $tmp_lahir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tgl Lahir <?php echo form_error('tgl_lahir') ?></label>
            <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" value="<?php echo $tgl_lahir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Anak Ke <?php echo form_error('anak_ke') ?></label>
            <input type="text" class="form-control" name="anak_ke" id="anak_ke" placeholder="Anak Ke" value="<?php echo $anak_ke; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jml Saudara <?php echo form_error('jml_saudara') ?></label>
            <input type="text" class="form-control" name="jml_saudara" id="jml_saudara" placeholder="Jml Saudara" value="<?php echo $jml_saudara; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bhs Hari <?php echo form_error('bhs_hari') ?></label>
            <input type="text" class="form-control" name="bhs_hari" id="bhs_hari" placeholder="Bhs Hari" value="<?php echo $bhs_hari; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tinggal Dengan <?php echo form_error('tinggal_dengan') ?></label>
            <input type="text" class="form-control" name="tinggal_dengan" id="tinggal_dengan" placeholder="Tinggal Dengan" value="<?php echo $tinggal_dengan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Goda <?php echo form_error('goda') ?></label>
            <input type="text" class="form-control" name="goda" id="goda" placeholder="Goda" value="<?php echo $goda; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">R Penyakit <?php echo form_error('r_penyakit') ?></label>
            <input type="text" class="form-control" name="r_penyakit" id="r_penyakit" placeholder="R Penyakit" value="<?php echo $r_penyakit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">T Badan <?php echo form_error('t_badan') ?></label>
            <input type="text" class="form-control" name="t_badan" id="t_badan" placeholder="T Badan" value="<?php echo $t_badan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">B Badan <?php echo form_error('b_badan') ?></label>
            <input type="text" class="form-control" name="b_badan" id="b_badan" placeholder="B Badan" value="<?php echo $b_badan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ukr Baju <?php echo form_error('ukr_baju') ?></label>
            <input type="text" class="form-control" name="ukr_baju" id="ukr_baju" placeholder="Ukr Baju" value="<?php echo $ukr_baju; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Seijasah <?php echo form_error('nama_seijasah') ?></label>
            <input type="text" class="form-control" name="nama_seijasah" id="nama_seijasah" placeholder="Nama Seijasah" value="<?php echo $nama_seijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tmp Lahir Seijasah <?php echo form_error('tmp_lahir_seijasah') ?></label>
            <input type="text" class="form-control" name="tmp_lahir_seijasah" id="tmp_lahir_seijasah" placeholder="Tmp Lahir Seijasah" value="<?php echo $tmp_lahir_seijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tgl Lahir Seijasah <?php echo form_error('tgl_lahir_seijasah') ?></label>
            <input type="text" class="form-control" name="tgl_lahir_seijasah" id="tgl_lahir_seijasah" placeholder="Tgl Lahir Seijasah" value="<?php echo $tgl_lahir_seijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nopes <?php echo form_error('nopes') ?></label>
            <input type="text" class="form-control" name="nopes" id="nopes" placeholder="Nopes" value="<?php echo $nopes; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nilai Ijasah <?php echo form_error('nilai_ijasah') ?></label>
            <input type="text" class="form-control" name="nilai_ijasah" id="nilai_ijasah" placeholder="Nilai Ijasah" value="<?php echo $nilai_ijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Ijasah <?php echo form_error('no_ijasah') ?></label>
            <input type="text" class="form-control" name="no_ijasah" id="no_ijasah" placeholder="No Ijasah" value="<?php echo $no_ijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Skhu <?php echo form_error('no_skhu') ?></label>
            <input type="text" class="form-control" name="no_skhu" id="no_skhu" placeholder="No Skhu" value="<?php echo $no_skhu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Thn Ijs <?php echo form_error('thn_ijs') ?></label>
            <input type="text" class="form-control" name="thn_ijs" id="thn_ijs" placeholder="Thn Ijs" value="<?php echo $thn_ijs; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Sekolah Asal <?php echo form_error('nama_sekolah_asal') ?></label>
            <input type="text" class="form-control" name="nama_sekolah_asal" id="nama_sekolah_asal" placeholder="Nama Sekolah Asal" value="<?php echo $nama_sekolah_asal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kls Akhir <?php echo form_error('kls_akhir') ?></label>
            <input type="text" class="form-control" name="kls_akhir" id="kls_akhir" placeholder="Kls Akhir" value="<?php echo $kls_akhir; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Tgl Daftar <?php echo form_error('tgl_daftar') ?></label>
            <input type="text" class="form-control" name="tgl_daftar" id="tgl_daftar" placeholder="Tgl Daftar" value="<?php echo $tgl_daftar; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Data Awal Id <?php echo form_error('data_awal_id') ?></label>
            <input type="text" class="form-control" name="data_awal_id" id="data_awal_id" placeholder="Data Awal Id" value="<?php echo $data_awal_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nok <?php echo form_error('nok') ?></label>
            <input type="text" class="form-control" name="nok" id="nok" placeholder="Nok" value="<?php echo $nok; ?>" />
        </div>
	    <input type="hidden" name="id_pendaftaran" value="<?php echo $id_pendaftaran; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('psb') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>