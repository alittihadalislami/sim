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
        <h2 style="margin-top:0px">P_data_awal <?php echo $button ?></h2>
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
            <label for="varchar">Alamat Pengenal <?php echo form_error('alamat_pengenal') ?></label>
            <input type="text" class="form-control" name="alamat_pengenal" id="alamat_pengenal" placeholder="Alamat Pengenal" value="<?php echo $alamat_pengenal; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Npsn Asal <?php echo form_error('npsn_asal') ?></label>
            <input type="text" class="form-control" name="npsn_asal" id="npsn_asal" placeholder="Npsn Asal" value="<?php echo $npsn_asal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Desa Id <?php echo form_error('desa_id') ?></label>
            <input type="text" class="form-control" name="desa_id" id="desa_id" placeholder="Desa Id" value="<?php echo $desa_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nohp <?php echo form_error('nohp') ?></label>
            <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nohp" value="<?php echo $nohp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Proses <?php echo form_error('proses') ?></label>
            <input type="text" class="form-control" name="proses" id="proses" placeholder="Proses" value="<?php echo $proses; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ijasah <?php echo form_error('ijasah') ?></label>
            <input type="text" class="form-control" name="ijasah" id="ijasah" placeholder="Ijasah" value="<?php echo $ijasah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Skhu <?php echo form_error('skhu') ?></label>
            <input type="text" class="form-control" name="skhu" id="skhu" placeholder="Skhu" value="<?php echo $skhu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kk <?php echo form_error('kk') ?></label>
            <input type="text" class="form-control" name="kk" id="kk" placeholder="Kk" value="<?php echo $kk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Akte <?php echo form_error('akte') ?></label>
            <input type="text" class="form-control" name="akte" id="akte" placeholder="Akte" value="<?php echo $akte; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kartu <?php echo form_error('kartu') ?></label>
            <input type="text" class="form-control" name="kartu" id="kartu" placeholder="Kartu" value="<?php echo $kartu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keuangan <?php echo form_error('keuangan') ?></label>
            <input type="text" class="form-control" name="keuangan" id="keuangan" placeholder="Keuangan" value="<?php echo $keuangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Asesment <?php echo form_error('asesment') ?></label>
            <input type="text" class="form-control" name="asesment" id="asesment" placeholder="Asesment" value="<?php echo $asesment; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Verf Keuangan <?php echo form_error('verf_keuangan') ?></label>
            <input type="text" class="form-control" name="verf_keuangan" id="verf_keuangan" placeholder="Verf Keuangan" value="<?php echo $verf_keuangan; ?>" />
        </div>
	    <input type="hidden" name="id_data_awal" value="<?php echo $id_data_awal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('psb') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>