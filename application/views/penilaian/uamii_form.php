<style>
  @media only screen and (max-width: 768px) {
    .card-body{
      padding: 0;
    }
    .br2 > input.form-control{
      text-align: center;
      width: 19%;
      float: left;
      margin-right:1%;
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
      width: 19%;
      margin-right: 1%;
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
    margin-right: 2px;
  }
  .br2 input.form-control{
    position: relative;
    top: 3px;
    text-align:center;
  }
  .br2:last-child:after{
    clear: left;
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
          <!-- <a class="btn btn-warning" href="<?= '#'/*base_url('penilaian/uamii')*/ ?>">Tarik dari penilaian reguler</a> -->
          <h1  class="display-1" id="head">Nilai UAMII <?= $str_tahun ?> - <span class="display-4"><?= $mapel[0]['mapel_alias'] ?></span></h1>
          <ul class="mt-3">
            <li>Input nilai mata pelajaran <?= $mapel[0]['mapel_alias'] ?> dilakukan di form penilaian reguler dengan KD, NKH, PTS, PAS, SLK di <a href="<?= base_url()?>penilaian" class="badge badge-warning font-weight-bold">link ini</a></li>
            <li>Melakukan <a class="badge badge-warning" href="<?= base_url('penilaian/tarikNilaiRegulerkeUamii').'/'.$this->uri->segment(3)?>">tarik data nilai reguler</a> dan simpan untuk nilai UAMII</li>
          </ul>
        </div>
      </div>

      <?php 
        $id_mapel_aktiv = $mapel[0]['id_mapel'];
        $ujian2x = [13,10,8,29,2,9,12,24];
        $kunci_input = 'readonly';
        foreach ($ujian2x as $val ) {
          if ($val == $id_mapel_aktiv) {
            $kunci_input = null;
          }
        }
       ?>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-10">

      <div class="card border-light mb-3">
        <!-- <div class="card-header bg-success" style="font-size: 20px;"><?php echo $judul.' - '.$atribut['nama_mapel'].' '.$atribut['nama_kelas']; ?></div> -->
        <div class="card-body">
          <form action="<?=base_url('penilaian/uamii_simpan') ?>" method="post">
          <div class="judul">
            <div class="br1 lb-1">NO</div>
            <div class="br1 lb-1a">Induk</div>
            <div class="br1 lb-3">Nama Santri</div>
            <div class="br1 lb-2">Rata-rata Raport</div>
            <div class="br1 lb-2">Nilai UAMII</div>
            <div class="br1 lb-2">Nilai Ijazah</div>
            <div class="br1 lb-2">Nilai Suluk</div>
            <div style="clear: both;"></div>
          </div>
          <div class="judulNilai" style="background-color: darkgreen; color: white; font-weight: bold; border-bottom: 2px solid #F1DB84">
            <div>NRP</div>
            <div>UAM</div>
            <div>IJZ</div>
            <div>SLK</div>
          <div style="clear: both;"></div>
          </div>
          <div class="frame-nilai">
          <?php $i=1;?> 
          <?php foreach ($santri as $s) : ?>
          <div class="nilai">
            <div class="br2 ident lb-1" id="dorongindent"><?=$i++;?></div>
            <div class="br2 ident lb-1a"><?= $s['idk_mii']; ?></div>
            <div class="br2 nmtebal lb-3"><?= $s['nama_santri']; ?></div>

            <?php 
              foreach ($nilai_raport as $nr) {
                if ($s['id_santri'] == $nr['santri_id']) {
                  $r_nrp = $nr['nrp'];
                }
              }

              $uamii = $this->km->adaNilaiIjz($mapel[0]['id_mapel'],$s['id_santri'])['uamii'];
              $ijz = $this->km->adaNilaiIjz($mapel[0]['id_mapel'],$s['id_santri'])['ijz'];
              $slk = $this->km->adaNilaiIjz($mapel[0]['id_mapel'],$s['id_santri'])['slk'];
            ?>

            <div class="br2 awnilai lb-2"><input class="form-control lb-i nrp" type="text" min="0" max="100" name="raport-<?= $s['id_santri'];?>" id="nrp-<?=$i?>"  value="<?= $r_nrp ?>" readonly>
            </div>


            <div class="br2 awnilai lb-2"><input class="form-control lb-i uamii" type="number" max="100" min="0" name="uamii-<?= $s['id_santri'];?>" value="<?= isset($uamii) ? $uamii : ''; ?>" id="uamii-<?=$i?>" placeholder="UAMII" <?= $kunci_input ?>></div>


            <div class="br2 lb-2"><input class="form-control lb-i ijazah" type="number" min="0" max="100" readonly name="ijazah-<?= $s['id_santri'];?>" id="ijazah-<?=$i?>" placeholder="IJAZAH" value="<?= isset($ijz) ? $ijz : ''; ?>"></div>

            <div class="br2 lb-2"><input class="form-control lb-i suluk" type="number" min="0" max="100" <?= $kunci_input ?> name="suluk-<?= $s['id_santri'];?>" id="suluk-<?=$i?>" placeholder="SULUK" value="<?= isset($slk) ? $slk : ''; ?>"></div>

          <div style="clear: both;"></div>
          </div>
          <?php endforeach ?>
          <div style="background-color: darkgreen; height: 5px;"></div>
          </div>
          <input type="text" name="id-tahun-0" value="<?= $id_tahun;?>" hidden="true">
          <input type="text" name="id-mapel-0" value="<?=$mapel[0]['id_mapel'] ?>" hidden="true">
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
<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> --> 
<script>
  $(document).ready(function(){

    $(".form-control").keyup(function () {
        var idKotak = this.id
        var nilaiKotak   = this.value 
        var kotakAsal = idKotak.split("-")

        if (kotakAsal[0] == 'uamii') {
            kotakNext = $("#uamii-"+(parseInt(kotakAsal[1])+1))
        }

        if (kotakAsal[0] == 'suluk') {
            kotakNext = $("#suluk-"+(parseInt(kotakAsal[1])+1))
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

      var nrp = $("#nrp-"+idform+"").val();
      var uamii = $("#uamii-"+idform+"").val();
      var ijazah = $("#ijazah-"+idform+"");

      var nilai = (parseFloat(nrp) + parseFloat(uamii) )/2;
      var nilai = nilai.toFixed(0);

      ijazah.val(nilai);

      // if (parseFloat(nkh) >= 0 && parseFloat(nhr) >= 0 && parseFloat(pts) >= 0 && parseFloat(pas) >= 0){
      //   nrp.val(nilai.toFixed(2));
      // }else{
      //   nrp.val('');
      // }

      // if (nrp.val() < "<= $kkm['kkm']; ?>" && (parseFloat(nkh) >= 0 && parseFloat(nhr) >= 0 && parseFloat(pts) >= 0 && parseFloat(pas) >= 0) ) {
      //     nrp.css({
      //         "background-color": "#EE6666",
      //         "color": "white",
      //       })
      //     }else{
      //       nrp.css({
      //         "background-color": "#E9ECEF",
      //         "color": "black",
      //       })
      //     }
    });

  });
</script>
