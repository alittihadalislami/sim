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
          </div>
          <div class="card-body">
            <table class="table table-sm table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Mapel</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $no=1; foreach ($mapel6  as $value): 

                    $rombel = $this->db->get_where('m_kelas', ['id_kelas' => $value['kelas_id']] )->row_array()['rombel'];

                    $jml_kd = $this->um->kdTersedia2($value['mapel_id'],$rombel,$value['tahun_id'])->num_rows();
                    $sts_kd = $jml_kd > 0 ? '<span class="badge badge-success"><i class="fas fa-check-circle"></i> '.$jml_kd.'</span>' : '<span class="badge badge-secondary">tidak ada KD</span>';

                   ?>
                    <td><?= $no++ ?></td>
                    <!-- $asatid, $mapel, $kelas -->
                    <td><a href="<?= base_url('penilaian/kd/').$this->acak->buatKembali(1,$value['asatid_id']).'/'.$this->acak->buatKembali(1,$value['mapel_id']).'/'.$this->acak->buatKembali(1,$value['kelas_id']) ?>"><?= $value['mapel_alias'] ?></a></td>
                    <td><?=$sts_kd?></td>
                </tr>
                  <?php endforeach ?>
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<script>

  function pilih(param){
    
    $('#modal').modal();
    
    let kd = [
      $(param).data("kdp"),
      $(param).data("kdk")
    ];

    let textArea = $(".kd").find("textarea");
    
    $('#kd-terpilih').text(kd[0]);

    data = '' ;
    no=1;
    for (i=0; i<textArea.length; i+=2) {
      
      if (textArea[i].textContent == '') {
        isi = 'kosong';
      }else{
        isi = textArea[i].textContent.slice(0,60) + ' ...';
      }

      data += '<tr onclick="pilihKolom(this);" data-kol="'+i+'" data-kdp="'+kd[0]+'" data-kdk="'+kd[1]+'" style="cursor: pointer;" ><td>' + no + '</td><td>' + isi + '</td></tr>';
      no=no+1
    }

    $('#kd-list').html(data);
  }

  function pilihKolom(param){
    
    let textArea = $(".kd").find("textarea");

    let kol = $(param).data('kol');
    let kdp = $(param).data('kdp');
    let kdk = $(param).data('kdk');
    textArea[kol].textContent = kdp;
    textArea[kol+1].textContent = kdk;
    textArea[kol].focus();
    $('#modal').modal('toggle');
  }

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

