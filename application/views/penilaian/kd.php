<style>
  @media only screen and (max-width: 768px) {
    
    .card-body{
      padding: 0px;
    }

    .kd{
      padding: 5px;
    }
    
    .kd > .br2:last-child{
      margin-top: 5px;
    }

    .kd > .br2:first-child{
      margin-left: 5px;
      font-size: 25px;
      padding-top: 10px;
    }

    .judul-kd{
      display: none;
    }
    #alert{
      width: 360px;
    }

    .card-body ol{
      padding-left: 20px;
    }

    .bawahkd{
      display: block;
    }
    
    #jmlKD{
    font-size: 20px;
    padding: 2px 10px 2px 10px;
    position: absolute;
    right: 6px;
    top: 14px;
    }



  } /*end of mobile interface*/


  .form-control::-webkit-input-placeholder { color: green; opacity: 0.4;text-align: center; }  /* WebKit, Blink, Edge */
  .form-control:-moz-placeholder { color: green; opacity: 0.4; text-align: center; }  /* Mozilla Firefox 4 to 18 */
  .form-control::-moz-placeholder { color: green; opacity: 0.4; text-align: center; }  /* Mozilla Firefox 19+ */
  .form-control:-ms-input-placeholder { color: white; }  /* Internet Explorer 10-11 */
  .form-control::-ms-input-placeholder { color: white; }  /* Microsoft Edge */

  .kd:nth-child(odd) {
    background: #D8F7D8;
  }

  .kd:nth-child(even) {
    background: #F4F6F9;
  }

  #tbh{
    font-size: 15px;
  }
 
  .kkm div{
    display: inline-block;
  }
  .kkm{
    border-left: 5px solid #4E6554;
    background-color: whitesmoke;
    padding: 3px;
  }


@media only screen and (min-width: 769px) {
  .content-wrapper{
    padding-left: 10px;
  }

  .card-body{
  padding-bottom:0px;
  padding-top:4px;
  padding-left:4px;
  padding-right:4px;
  }

  .kd{
    display: flex;
    justify-content: center;
    padding-bottom: 15px;
  }

  .br2{
    display: inline-block;
    margin-top: 10px;
  }

  .br2:first-child{
    padding-top: 15px;
    width: 2%;
  }

  .br2:not(:first-child){
    width: 47%;
    margin-left: 1%;
  }
  
  .jd{
    display: inline-block;
    vertical-align: middle;
    margin-top: 10px;
    margin-left: 5px;
    font-size: 20px;

  }
  .jd:not(:first-child){
    width: 45%;
    margin-left: 2%;
  }
  .judul-kd{
    background-color: whitesmoke;
    border-bottom: 2px solid darkgreen;
    height: 50px;
    color: darkgreen;
  }

  textarea{
    height: 8em;
  }

  #jmlKD{
    font-size: 25px;
    padding-top: 4px;
    padding-bottom: 3px;
  }

  .bawahkd{
      display: none;
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
          <h1 id="head">Penilaian</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="card border-light mb-3">
        <div class="card-header bg-success">
          <span style="font-size: 20px;">Kompetensi Dasar <br class="bawahkd"> <?= $atribut['mapel_alias'] .' - '. $atribut['nama_kelas'];?> </span>
          <button class="btn btn-warning btn-sm float-right" href="#" id="tbh"><i class="fas fw fa-plus-square"></i> Tambah</button>
          <span class="badge badge-danger float-right mx-3" id="jmlKD">2</span>
        </div>

        <div class="card-body">

        <div class=" mx-auto mt-2 col-12 col-md-7 p-2 alert alert-secondary alert-dismissible" id="alert">
          <button type="button" class="close mx" data-dismiss="alert" aria-hidden="true">×</button>
          <h4 class="mt-2 ml-3"><i class="fas fa-exclamation-triangle text-warning mr-2"></i> Perhatian..!!</h4>
          <ol>
            <li>Deskripsi KD harus diawali dengan kata kerja </li>
            <li>Tidak perlu diberi Nomor / point disetiap KD</li>
            <li>Tiap mapel minimal 2 KD pengetahuan dan 2 KD Keterampilan </li>
            <li>KD menjadi bahan untuk penilaian harian selama semester berlangsung </li>
            <li>Contoh (salah): <strong>1. Siswa Dapat memahami...</strong> </li>
            <li>Contoh (benar): <strong>memahami mubtada' khabar...</strong> </li>
          </ol>
        </div>

          <form action="<?=base_url()?>penilaian/tambah_kd" method="post">

          <div class="frame-nilai" id="fn1">

            <div class="kkm mx-auto" style="width: 285px; margin-bottom: 15px; margin-top: 15px;">
              <label style="display: inline-block;">Kreteria Kelulusan Minimal :</label>
              <input style="display:inline-block; width: 25%; font-weight: bold; font-size: 20px; text-align: center;" type="number" min="50" max="100" class="form-control px-0" required name="kkm" value="<?= ($jml_kd ? $kd[0]['kkm'] : '') ?>">
            </div>

            <div class="judul-kd">
              <div class="jd">NO</div>
              <div class="jd">Kompetensi Dasar Pengetahuan</div>
              <div class="jd">Kompetensi Dasar Keterampilan</div>
            </div>

            <div class="kd">
              <div class="br2">1</div>
              <input type="text" name="urut1" value="1" hidden="true">
              <div class="br2">
                <textarea class="form-control" rows="3" name="kdp1" placeholder="KD-Pengetahuan 1" required><?= ($jml_kd ? $kd[0]['kdp'] : '') ?></textarea>
              </div>
              <div class="br2">
                <textarea class="form-control" rows="3" name="kdk1" placeholder="KD-Keterampilan 1" required><?= ($jml_kd ? $kd[0]['kdk'] : '') ?></textarea>
              </div>
            </div>
          
            <?php $x = 2; do {?>
            <div class="kd">
              <div class="br2"><?=$x;?></div>
              <input type="text" name="urut<?=$x;?>" value="<?=$x;?>" hidden="true">
              <div class="br2">
                <textarea class="form-control" rows="3" name="kdp<?=$x;?>" placeholder="KD-Pengetahuan 2" required><?= ($jml_kd ? $kd[$x-1]['kdp'] : '' ) ?></textarea>
              </div>
              <div class="br2">
                <textarea class="form-control" rows="3" name="kdk<?=$x;?>" placeholder="KD-Keterampilan 2" required><?= ($jml_kd ? $kd[$x-1]['kdk'] : '')?></textarea>
              </div>
            </div>
                
            <?php $x++; } while ($x <= ($jml_kd ? $jml_kd : 2 ) );?>

            <input type="text" name="mapel_id" value="<?=$id_mapel?>" hidden="true">
            <input type="text" name="kelas_id" value="<?=$id_kelas?>" hidden="true">
            <input type="text" name="rombel" value="<?=$rombel?>" hidden="true">
            <input type="text" name="tahun_id" value="<?=$id_tahun?>" hidden="true">

          </div>

          <div style="background-color: darkgreen; height: 5px;"></div>
          <button type="submit" class="btn btn-success float-right m-3">Simpan</button>
          </form>
        </div>
    </div>
  </div>
  </section>
</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script> 

<script>
  $(document).ready(function(){
    $('.nkh, .pts, .pas').change(function(){
      var xNkh = $(".nkh").index(this)+1;        
      var xPts = $(".pts").index(this)+1;        
      var xPas = $(".pas").index(this)+1;
      
      if (xNkh > 0) {
        var index = xNkh;
      }else if (xPts > 0) {
        var index = xPts;
      }else{
        var index = xPas;
      }

      var nkh = $('#nkh'+index).val();
      var pts = $('#pts'+index).val();
      var pas = $('#pas'+index).val();
      var nrp = $('#nrp'+index);

      if (parseFloat(nkh) >= 0 && parseFloat(pts) >= 0 && parseFloat(pas) >= 0){
        var nilai = (parseFloat(nkh) + parseFloat(pts) + parseFloat(pas))/3;
        nrp.val(nilai.toFixed(2));
      }
    });

    var angka = $('.kd').length;//2;
    $('#jmlKD').text(angka);
    $('#tbh').click(function(){
      angka++
      var tambah = `<div class="kd">
                      <div class="br2">`+angka+`</div>
                      <input type="text" name="urut`+angka+`" value="`+angka+`" hidden="true">
                      <div class="br2">
                        <textarea class="form-control" rows="3" name="kdp`+angka+`" placeholder="KD-Pengetahuan `+angka+`"></textarea>
                      </div>
                      <div class="br2">
                        <textarea class="form-control" rows="3" name="kdk`+angka+`" placeholder="KD-Keterampilan `+angka+`"></textarea>
                      </div>
                      <div style="clear: both;"></div>
                    </div>`;
      $('#fn1').append(tambah);
      $('.nilai:last-child > .br2:first-child').text(angka);
      $('#jmlKD').text(angka);
    });


  });
</script>

