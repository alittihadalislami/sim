<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php
    $this->load->view('templates/header_hc');
 ?> 
        <h2 style="margin-top:0px" class="text-right"><?php echo $judul ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NIK <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NISN <?php echo form_error('nisn') ?></label>
            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Nisn" value="<?php echo $nisn; ?>" />
        </div>
	     <div class="form-group">
                    <label for="varchar">Alamat Pengenal <?php echo form_error('alamat_pengenal') ?></label>
                    <input type="text" class="form-control" name="alamat_pengenal" id="alamat_pengenal" placeholder="Alamat Pengenal" value="<?php echo $alamat_pengenal; ?>" />
                </div>
        <div class="form-group">
                    <label for="int">NPSN Asal <?php echo form_error('npsn_asal') ?></label>
                    <input type="text" class="form-control" name="npsn_asal" id="npsn_asal" placeholder="Npsn Asal" value="<?php echo $npsn_asal; ?>" />
                </div>
        <div class="form-group">
                    <label for="varchar">Alamat Desa <?php echo form_error('desa_id') ?></label>
                    <?php  
                        $alamat_lengkap = 'Desa '.$tampil_desa['ds'].', Kec. '.$tampil_desa['kec'].', '.$tampil_desa['kab'].', '.$tampil_desa['prop'];
                        $alamat_deskripsi = ucwords(strtolower($alamat_lengkap));
                    ?>
                    <input type="text" class="form-control bg-light" readonly id="alamat_deskripsi" placeholder="Desa Id" value="<?= $alamat_deskripsi; ?>" />
                    <input type="text" class="form-control bg-light" readonly name="desa_id" id="desa-id" placeholder="Desa Id" value="<?php echo $desa_id; ?>" />
                </div>
        <div class="form-group">
                    <label for="varchar">No HP <?php echo form_error('nohp') ?></label>
                    <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nohp" value="<?php echo $nohp; ?>" />
                </div>
        <!--<div class="form-group">
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
                </div> -->
	    <input type="hidden" name="id_data_awal" value="<?php echo $id_data_awal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('psb') ?>" class="btn btn-default">Cancel</a>
	</form>

    <div class="modal fade" id="alamatModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
              <div class="form-group col-md-6">
                <label for="inputPropinsi">Propinsi</label>
                <select id="inputPropinsi" class="form-control input-alamat">
                  <option selected>Pilih...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputKabupaten">Kabupaten</label>
                <select id="inputKabupaten" class="form-control input-alamat">
                  <option selected>Pilih...</option>
                  <option>Pilih propinsi dulu...</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputKecamatan">Kecamatan</label>
                <select id="inputKecamatan" class="form-control input-alamat">
                  <option selected>Pilih...</option>
                  <option>Pilih kabupaten dulu...</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputDesa">Desa</label>
                <select id="inputDesa" class="form-control input-alamat">
                  <option selected>Pilih...</option>
                  <option>Pilih kecamatan dulu...</option>
                </select>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="close-alamat" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="simpan-alamat" type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>

<?php  
    $this->load->view('templates/footer_hc');
?>

<script>

    function listPropinsi() {
        let propinsi = '<option selected>Pilih...</option>';
        $.ajax({
            'url':'<?= base_url("psb/listPropinsi")?>',
            'type':'post',
            'dataType': 'json',
            success:function(response){
                    for (var i = 0; i < response.length; i++) {
                        propinsi += '<option value="'+response[i].kode+'">'+response[i].nama+'</option>';
                    }
                $('#inputPropinsi').html(propinsi);
            }
        })
    }



    $(document).ready(function(){
        
        listPropinsi();

        $('.input-alamat').select2({
        });

        $('#alamat_deskripsi').on('click', function(){
            $('#alamatModal').modal('show');
        })

        $('#inputPropinsi').change(function(){
            listKabupaten();
            resetKecamatan();
            resetDesa();
        })

        $('#inputKabupaten').change(function(){
            listKecamatan();
            resetDesa();
        })

        $('#inputKecamatan').change(function(){
            listDesa();
        })

        $('#simpan-alamat').on('click', function(){
            simpanAlamat();
        });

        $('#close-alamat').on('click', function(){
            $('#alamat').val('');
        });

    });

    function listKabupaten(){
        
        let propinsi = $('#inputPropinsi').find(':selected')[0].value;
        let kabupaten = '<option selected>Pilih...</option>';

         $.ajax({
            'url':'<?= base_url("psb/listKabupaten")?>',
            'type':'post',
            'dataType': 'json',
            'data':{id:propinsi},
            success:function(response){
                    for (var i = 0; i < response.length; i++) {
                        kabupaten += '<option value="'+response[i].kode+'">'+response[i].nama+'</option>';
                    }
                $('#inputKabupaten').html(kabupaten);
            }
        })
    }

    function listKecamatan(){
        
        let kabupaten = $('#inputKabupaten').find(':selected')[0].value;
        let kecamatan = '<option selected>Pilih...</option>';

         $.ajax({
            'url':'<?= base_url("psb/listKecamatan")?>',
            'type':'post',
            'dataType': 'json',
            'data':{id:kabupaten},
            success:function(response){
                    for (var i = 0; i < response.length; i++) {
                        kecamatan += '<option value="'+response[i].kode+'">'+response[i].nama+'</option>';
                    }
                $('#inputKecamatan').html(kecamatan);
            }
        })
    }

    function listDesa(){
        
        let kecamatan = $('#inputKecamatan').find(':selected')[0].value;
        let desa = '<option selected>Pilih...</option>';

         $.ajax({
            'url':'<?= base_url("psb/listDesa")?>',
            'type':'post',
            'dataType': 'json',
            'data':{id:kecamatan},
            success:function(response){
                    for (var i = 0; i < response.length; i++) {
                        desa += '<option value="'+response[i].kode+'">'+response[i].nama+'</option>';
                    }
                $('#inputDesa').html(desa);
            }
        })
    }

    function resetKecamatan(){
        let option = '<option selected>Pilih...</option><option>Pilih kabupaten dulu...</option>';
        $('#inputKecamatan').html(option);
    }

    function resetDesa(){
        let option = '<option selected>Pilih...</option><option>Pilih kecamatan dulu...</option>';
        $('#inputDesa').html(option);
    }

    function simpanAlamat(){
        let desa = $('#inputDesa').find(':selected')[0].value;
        let alamat_tampil = $('#inputDesa').find(':selected')[0].text+', '+$('#inputKecamatan').find(':selected')[0].text+', '+$('#inputKabupaten').find(':selected')[0].text+', '+$('#inputPropinsi').find(':selected')[0].text;
        id = desa.substring(0,5);

        if (id != 'Pilih') {
            $('#desa-id').val(desa);
            $('#alamat_deskripsi').val(toTitleCase(alamat_tampil));
            $('#alamatModal').modal('hide');
            alert(desa);
            
        }else{
            alert ('Silahkan pilih alamat dengan lengkap dan benar ');
        }
    }

    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    }
</script>