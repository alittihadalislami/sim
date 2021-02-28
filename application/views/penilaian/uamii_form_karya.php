<style>
  @media only screen and (max-width: 768px) {
    .card-body{
      padding: 0;
    }
    .br2 > input.form-control{
      text-align: center;
      width: 25%;
      float: left;
      margin-right:7%;
    }
    .ident{
      float: left;
      margin-right: 1%;
    }
    #dorongindent{
    padding-left: 10px;
    }
    .ident:after{
      content: ' - ';
    }
    .nmtebal{
      font-weight: bold;
      color: #084E08
    }
    .judul{
      display: none;
    }
    .nilai{
      padding: 5px;
    }
    .judulNilai > div:not(:last-child) {
      float: left;
    }
    .judulNilai > div {
      width: 25%;
      margin-right: 7%;
      text-align:center;
    }
    .frame-nilai{
    height: 500px; 
    overflow: auto;
  } 
  
  }
    .form-control::-webkit-input-placeholder { color: green; opacity: 0.4;text-align: center; font-size: 14px;}  /* WebKit, Blink, Edge */
    .form-control:-moz-placeholder { color: green; opacity: 0.4; text-align: center; font-size: 14px;}  /* Mozilla Firefox 4 to 18 */
    .form-control::-moz-placeholder { color: green; opacity: 0.4; text-align: center; }  /* Mozilla Firefox 19+ */
    .form-control:-ms-input-placeholder { color: white; }  /* Internet Explorer 10-11 */
    .form-control::-ms-input-placeholder { color: white; }  /* Microsoft Edge */

  .nilai:nth-child(odd){
    background-color: #D8F7D8;
  }
  
  .nilai:nth-child(even){
    background-color: whitesmoke;
  }


    .form-control{
      font-size: 20px;
      font-weight: bold;
      padding: 0;
      text-align: center;
      margin-top: 5px;
    }

@media only screen and (min-width: 769px) {
  .content-wrapper{
    padding-left: 10px;
  }
  
  
  .judulNilai {
    display: none; 
  }
  .card-body{
    padding: 0;
  }
  .card-body .judul {
    text-align: center;
    font-weight: bold;
    color: white; 
    width: 100%;
    background-color: darkgreen;
  }
  #dorongindent{
    text-align: center;
  }
  .nilai{
    height: 45px;
    line-height: 45px;
  }
  .br1{
    width: 13%;
    float: left;
    margin-right: 33px;
    /*background-color: darkgreen;*/
  }
  .br1:not(:last-child){
    /*border-right: 1px solid black;*/

  }
  .br1:last-child:after{
    clear: left;
  }
  .lb-1{
    width: 5%;
  }
  .lb-1a{
    width: 10%;
  }
  .lb-2{
    width: 10.5%;
  }
  .lb-3{
    width: 30%;
  }
  .br2{
    float: left; 
    margin-right: 33px;
  }
  .br2 input.form-control{
    position: relative;
    top: 2px;
    text-align:center;
  }
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm">
          <a class="btn btn-success float-right" href="<?= base_url('penilaian/uamii') ?>">Rekap Nilai</a>
          <h1  class="display-1" id="head">Nilai UAMII <?= $str_tahun ?> - <span class="display-4">Karya Tulis Ilmiyah</span></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-10">

      <div class="card border-light mb-3">
        <!-- <div class="card-header bg-success" style="font-size: 20px;"><?php echo $judul.' - '.$atribut['nama_mapel'].' '.$atribut['nama_kelas']; ?></div> -->
        <div class="card-body">
          <form action="<?=base_url('penilaian/uamii_simpan_karya') ?>" method="post">
          <div class="judul">
            <div class="br1 lb-1">NO</div>
            <div class="br1 lb-1a">Induk</div>
            <div class="br1 lb-3">Nama Santri</div>
            <div class="br1 lb-2">Tematik</div>
            <div class="br1 lb-2">Penelitian</div>
            <div class="br1 lb-2">Ijazah</div>
            <div style="clear: both;"></div>
          </div>
          <div class="judulNilai" style="background-color: darkgreen; color: white; font-weight: bold; border-bottom: 2px solid #F1DB84">
            <div>TEMATIK</div>
            <div>PENELITIAN</div>
            <div>IJAZAH</div>
          <div style="clear: both;"></div>
          </div>
          <div class="frame-nilai">
          <?php $i=1;?> 
          <?php foreach ($santri as $s) : ?>
          <div class="nilai">
            <div class="br2 ident lb-1" id="dorongindent"><?=$i++;?></div>
            <div class="br2 ident lb-1a text-center"><?= $s['idk_mii']; ?></div>
            <div class="br2 nmtebal lb-3"><?= $s['nama_santri']; ?></div>
            
            <?php
              $tematik = null;
              $penelitian = null;
              $ijz = null;
              
              $karya = $this->db->get_where('t_karya', ['santri_id'=>$s['id_santri']])->row();
              
              if ($karya != null) {
                $tematik = $karya->nilai_tematik;
                $penelitian = $karya->nilai_penelitian;
                $ijz = $karya->nilai_karya;                
              }
              
            ?>

            <div class="br2 awnilai lb-2"><input class="form-control lb-i" type="number" max="100" min="0" name="tematik-<?= $s['id_santri'];?>" value="<?= isset($tematik) ? $tematik : ''; ?>" id="tematik-<?=$i?>" placeholder="Tematik"></div>


            <div class="br2 awnilai lb-2"><input class="form-control lb-i" type="number" max="100" min="0" name="penelitian-<?= $s['id_santri'];?>" value="<?= isset($penelitian) ? $penelitian : ''; ?>" id="penelitian-<?=$i?>" placeholder="Penelitian"></div>


            <div class="br2 lb-2"><input class="form-control lb-i ijazah" type="number" min="0" max="100" readonly name="ijazah-<?= $s['id_santri'];?>" id="ijazah-<?=$i?>" placeholder="IJAZAH" value="<?= isset($ijz) ? $ijz : ''; ?>"></div>

          <div style="clear: both;"></div>
          </div>
          <?php endforeach ?>
          <div style="background-color: darkgreen; height: 5px;"></div>
          </div>
          <input type="text" name="id-tahun-0" value="<?= $id_tahun;?>" hidden="true">
          <button type="submit" class="btn btn-success float-right m-3">Simpan</button>
          <button type="reset" class="btn m-3" onclick="return confirm('Yakin, menghapus data yang telah dientry ?');" >Reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  </section>
</div>

<script src="<?=base_url() ?>/assets/js/jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $(".form-control").keyup(function () {
        var idKotak = this.id
        var nilaiKotak   = this.value 
        var kotakAsal = idKotak.split("-")

        if (kotakAsal[0] == 'tematik') {
            kotakNext = $("#tematik-"+(parseInt(kotakAsal[1])+1))
        }

        if (kotakAsal[0] == 'penelitian') {
            kotakNext = $("#penelitian-"+(parseInt(kotakAsal[1])+1))
        }

        if (nilaiKotak.length == 2 || nilaiKotak == 100 ) {
          if (nilaiKotak != 10) {
            kotakNext.focus();
          }
        }


          
        

    });

    $(".form-control").change(function () {
      var idKotak = this.id
      var nilaiKotak   = this.value 
      var kotakAsal = idKotak.split("-")
      var idform = kotakAsal[1];

      var tematik = $("#tematik-"+idform+"").val();
      var penelitian = $("#penelitian-"+idform+"").val();
      var ijazah = $("#ijazah-"+idform+"");

      var nilai = (parseFloat(tematik) + parseFloat(penelitian) )/2;
      var nilai = nilai.toFixed(0);

      ijazah.val(nilai);

    });

  });
</script>
