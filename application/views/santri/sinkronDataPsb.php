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
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="row">

      <?= $this->session->flashdata('pesan'); ?>

      <div class="col-md mx-auto">

        <div class="card mt-5">

          <div class="card-header">
            <h3 class="card-title">Sinkron data PSB</h3>
          </div>

          <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg">
                  <a href="#" class="btn btn-info" id="simpan-semua" ><i class="fas fa-download"></i> Salin semua data psb tersedia</a>
                </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <table id="santri" class="table table-bordered table-hover table-sm display responsive">
                  <thead>                  
                    <tr>
                      <th width="30%">Data</th>
                      <th width="35%">PSB</th>
                      <th width="35%">SIM</th>
                      <!-- <th width="10%">Aksi</th> -->
                    </tr>
                  </thead>
                  <?php 
                    $keys = array_keys($list_detail);
                    // var_dump($d_santri['santri_id']);
                  ?>
                    <?php for ($i=0;$i<3;$i++) : ?>
                      <?php $kelompok = $keys[$i] ; ?>
                      <?php $banyak = count($list_detail[$kelompok]) ?>
                      <?php for ($j=0;$j<$banyak;$j++) : ?>
                        <?php
                          $keys2 = array_keys($atribut[$kelompok])[$j];
                          $psb_key = $keys2 ;
                          $sim_key = $atribut[$kelompok][$keys2] ;
                         ?>
                        <tr>
                          <td><?= $list_detail[$kelompok][$j] ?></td>
                          <td class="data_psb" id="<?=$psb_key?>_psb"><?= isset($psb[$sim_key]) ? $psb[$sim_key] : '' ?></td>
                          <td id="<?=$psb_key?>_sim"><?= $d_santri[$psb_key] ?></td>
                          <?php
                            $btn = 'btn-secondary';
                            if (isset($psb[$sim_key])) {
                              if ($psb[$sim_key] == $d_santri[$psb_key] || $psb[$sim_key] == '' ) {
                                $btn .= " disabled";
                              }
                            }else{
                              $btn .= " disabled";
                            }
                          ?>
                          <!-- <td><a id="<?=$sim_key?>_btn" href="#" class="btn <?=$btn?>"><i class="fas fa-download"></i></a></td> -->
                        </tr> 
                        <?php endfor ?>
                        <?php endfor ?>
                        <span type="text" value="" class="data_psb" id="santri_id_psb" hidden><?=$d_santri['santri_id']?></span>
                        
                  <tbody>
  
                  </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  
  function clean(obj) {
    for (var propName in obj) {
      if (obj[propName] === null || obj[propName] === undefined || obj[propName] === '') {
        delete obj[propName];
      }
    }
    return obj
  }

  $('#simpan-semua').on('click',function(){

    let result = confirm("Yakin? Karena semua data PSB akan menimpa data yang sudah tersimpan di SIM \nBatalkan bila ragu, bisa hilang datanya..");
    if (result) {
      data_id = $('.data_psb')
      data1 = {}
      for (let i = 0; i < data_id.length; i++) {
        let str_id = data_id[i].id
        let str_value = data_id[i].innerText
  
        x = str_id.length - 4
        data1 [str_id.substr(0,x)] = str_value  
      }
      
      data_send = clean(data1)
  
      console.log(data_send);
  
      $.ajax({
        url:'<?=base_url()?>santri/ajaxSinkronPsb',
        type:'post',
        data: {data_send},
        typeData:'json',
        success: function(data){
          setTimeout(function(){// wait for 5 secs(2)
            location.reload(); // then reload the page.(3)
        }, 2000); 
  
        }
      })
    }

  })
</script>

