<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<style>
    @media only screen and (min-width: 769px) {
    .content-wrapper{
      padding-left: 5px;
    }
  }
    .lebar{
      padding:0px;
    }
    tbody tr td.tandai{
      border-left: 5px solid #7E4040
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rekapitulasi</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lebar">
          
          <div class="card">
              <div class="card-header">
                <h5 class="card-title">Kompetensi Dasar (KD)</h5>
                <?php if (isset($semua_kelas)) : ?>
                  <?php $id=1; foreach ($semua_kelas as $sk): ?>
                    <a href="#" class="kelas badge badge-success" style="font-size: 15px; font-weight: lighter;" id="<?= $id++?>" data-id="<?= $sk['id_kelas'] ?>" ><?=$sk['nama_kelas']?></a>
                  <?php endforeach ?>
                <?php endif ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h1 id="kls_terpilih" class="badge badge-success" style="font-size: 30px; font-weight: lighter;">#<?=$nama_kelas['nama_kelas']?></h1>
                <table id="sts_nilai" class="table table-bordered table-hover table-responsive table-small">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Mapel</th>
                      <th>Pengetahuan</th>
                      <th>Keterampilan</th>
                      <th>pengajar</th>
                    </tr>
                  </thead>
                  <tbody id="isi">
                    <?php $no=1; foreach ($kd_perkelas as $kd): ?>
                    <?php
                      $cekp = strcasecmp( substr($kd['kdp'],0,2) , 'me');
                      $cekk = strcasecmp( substr($kd['kdk'],0,2) , 'me');
                    ?>
                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=$this->um->showNamaMapel($kd['mapel_id'])['nama_mapel'] ;?></td>
                      <td class="<?= $cekp ? 'tandai' : null ?>"><?=$kd['kdp'];?></td>
                      <td class="<?= $cekk ? 'tandai' : null ?>"><?=$kd['kdk'];?></td>
                      <?php $pengajar = $this->um->showPengajar($id_kelas,$kd['mapel_id'],$tahun_aktif) ;?>
                      <td><?=$this->um->showNamaAsatid($pengajar)['nama_asatid'] ;?></td>
                    </tr>
                    <?php endforeach ?>
                    
                  </tbody>
                </table>
              </div>
            </div>

        </div>
      </div>
      
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('.kelas').click(function(){
      var id = this.id;
      var text = this.text;
      $('#kls_terpilih').text('#'+text);
          
      $.ajax({
        url:'<?= base_url('penilaian/kdAjax/id') ?>',
        method: 'post',
        data:{id:id},
        dataType:'json',
        success: function(data){
          var cek = "<?= "tandai" ?>";
          var html = ' ';
          var i;
          for(i=0; i<data.length; i++){
              html += '<tr><td>'+(i+1)+'</td><td>'+data[i].nama_mapel+'</td><td>'+data[i].kdp+'</td><td>'+data[i].kdk+'</td><td>'+data[i].pengajar+'</td></tr>';
          }
          $('#isi').html(html);
        }

      });
    });
  });
</script>
