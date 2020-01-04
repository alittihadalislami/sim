<style>

  .card-body{
    padding: 5px;
  }
   
  
  .form-control::-webkit-input-placeholder { color: green; opacity: 0.4;text-align: center; font-size: 15px; }  /* WebKit, Blink, Edge */
  .form-control:-moz-placeholder { color: green; opacity: 0.4; text-align: center; font-size: 15px; }  /* Mozilla Firefox 4 to 18 */
  .form-control::-moz-placeholder { color: green; opacity: 0.4; text-align: center; font-size: 15px;}  /* Mozilla Firefox 19+ */
  .form-control:-ms-input-placeholder { color: white; }  /* Internet Explorer 10-11 */
  .form-control::-ms-input-placeholder { color: white; }  /* Microsoft Edge */

  .nilai:nth-child(odd) {
    background: #D8F7D8;
  }
  
  .nilai:nth-child(even) {
    background: #F7F6AB;
  }

  .kd{
    width: 45%;
    display: inline-block;
  }

  .kd-s{
    width: 8.5%;
    display: inline-block;
  }


  .kd-body{
    text-align: center;
    padding: 2px;
  }
  
  .kd-body:after{
    display: block;
    content: '';
  }

  .form-control{
    padding: 4px;
    font-size: 20px;
    font-family: 'arial';
    width: 80px;
    display: inline-block;
    margin-bottom: 2px;
    text-align: center;
  }
  
  /*Setingan untuk smartphone*/
  @media only screen and (max-width: 768px) {
    .card-body{
      height: 600px;
      overflow: scroll;
    }

    .kd, .kd-s{
      width: 32%;
      display: inline-block;
    }
  }
  
  .judul-utama{
    padding:  3px 3px 3px 20px;
    margin: 0px;
    background-color: #78B385;
    font-weight: bold;
  }
  .santri{
    text-align:center;
    padding-bottom: 5px;
  }

  .santri:first-child{
    border-radius: 5px 5px 0px 0px;
  }

  .santri > .indentitas{
    color: darkgreen;
    padding-top: 20px;
    padding-left: 15px;
    padding-bottom: 5px;
    text-align: left;
    line-height: 20px;
    font-weight: bold;
  }

  .santri:nth-child(odd){
    background-color: #D8F7D8;
  }
  
  .santri:nth-child(even){
    background-color: #F4F6F9;
  }

  .bungkus{
    display: flex;
    justify-content: space-around;
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
    <div class="col-lg">

      <div class="card bg-ligth mb-3">
        <div class="card-header bg-success"><span style="font-size: 20px;"><?php echo $judul.' - '.$mapel['nama_mapel'].' '.$kelas['nama_kelas'] ; ?></span></div>
          <h6 class="judul-utama">Kompetensi Dasar (KD)</h6>
        <div class="card-body bg-secondary">
          <form action="<?=base_url('penilaian/tambah_nh') ?>" method="post">
            <?php $no=1; foreach ($santri as $s ) { ?>
            <div class="santri">
              <div class="indentitas"><?= $no++.' - '.$s['idk_mii'].' - '.$s['nama_santri']?></div>
              <div class="bungkus">
                <div class="kd">
                  <div class="kd-judul text-center" style="background-color: #A8E38E;color: #1F430D">Pengetahuan</div>
                  <div class="kd-body" style="background-color: #CCEBBE;">
                      <?php for ($i=1;$i<=$jml_kd;$i++) { 
                          $inputan_kd = [''];
                          foreach ($nilai_kd as $kd) {
                          if ($kd['santri_id'] == $s['id_santri'] and $kd['urut_kd'] = $i ) {
                             $inputan_kd [] = $kd['nilai_kdp'];
                            } 
                          } ?>
                          <input type="number" min="0" max="100" class="form-control" placeholder="kdp-<?= $i;?>" name="kdp-<?=$s['id_santri'].'-'.$i;?>" value="<?= isset($inputan_kd[$i]) ? $inputan_kd[$i] : $inputan_kd[0]  ?>">

                      <?php } ?>
                  </div>
                </div>
                <div class="kd">
                  <div class="kd-judul text-center" style="background-color: #51A53E ; color: white;">Keterampilan</div>
                  <div class="kd-body" style="background-color: #7FB872;">
                      <?php for ($i=1;$i<=$jml_kd;$i++) {
                          $inputan_kd = [''];
                          foreach ($nilai_kd as $kd) {
                          if ($kd['santri_id'] == $s['id_santri'] and $kd['urut_kd'] = $i ) {
                             $inputan_kd [] = $kd['nilai_kdk'];
                             $nilai_suluk = $kd['nilai_suluk'];
                            } 
                          } ?>
                      <input type="number" min="0" max="100" class="form-control"  placeholder="kdk-<?= $i;?>" name="kdk-<?=$s['id_santri'].'-'.$i;?>" value="<?= isset($inputan_kd[$i]) ? $inputan_kd[$i] : $inputan_kd[0]  ?>">
                      <?php } ?>
                  </div>
                </div>
                <div class="kd-s">
                  <div class="kd-judul text-center text-secondary" style="background-color: #EAD566 ;">Suluk</div>
                  <div class="kd-body" style="background-color: #F5E488;">
                      <input type="number" min="0" max="100" class="form-control"  placeholder="Suluk" name="slk-<?=$s['id_santri']?>" value="<?= isset($nilai_suluk) ? $nilai_suluk : ''  ?>" >
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
            <div style="width: 100%" class="clearfix">
            <input type="text" value="<?= $id_mapel;?>" hidden="true" name="id-mapel">
            <input type="text" value="<?= $id_tahun;?>" hidden="true" name="id-tahun">
            <input type="text" value="<?= $id_kelas;?>" hidden="true" name="id-kelas">
            <button type="submit" class="btn btn-success float-right m-3">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  </section>
</div>

<!-- <script src="?=base_url() ?>/assets/js/jquery.min.js"></script> -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> 
<script>
  $(document).ready(function(){
    $(".form-control").keyup(function () {
        if (this.value != 10)  {
          if (this.value.length == 2) {
            $(this).next('.form-control').focus();
          }else if(this.value > 100){
            alert('Range nilai 1-100.');
          }
        }
    });
  });
</script>
