<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="text-align: center;">IDENTITAS SANTRI</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col elevation-1" id="isi">
           <table >
          
            <?php $id=0; $no=1; foreach ($kol as $k): ?>
             <tr style="height: 23px">
               <td style="width: 300px ; font-size: 17px; ">
                <?php 
                  $sub = substr($k,1,1);
                  if ($sub == '.') {
                    echo '&nbsp&nbsp&nbsp&nbsp'.$k;
                  }else{
                     echo $no++.'. '.$k;
                  }
                ?>
                </td>
               <td>:</td>
               <td style="width: 500px; padding-left: 10px; font-size: 17px;">
                <?php
                $id++;
                  if ($id == '4') {
                    echo $jenis;
                  }else{
                    echo $detail[$id];
                  }
                ?>
               </td>
             </tr>
            <?php endforeach ?>
           </table>
           <br>
           <div class="kepala" style="font-size: 17px; margin-left: 450px"> 
                <div>Sampang, 15 Juli 2020</div>
                <div>Mengetahui,</div>
                <div>Mudir Ma'had</div>
                <div style="margin-top: 90px; font-weight: bold;">Dr. Achmad Junaidi, Lc., MA.</div>
           </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div style="page-break-after: always;"> </div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="text-align: center;">IDENTITAS SISWA</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col elevation-1" id="isi">
           <table >
          
            <?php $id=0; $no=1; foreach ($kol as $k): ?>
             <tr style="height: 23px">
               <td style="width: 300px ; font-size: 17px; ">
                <?php 
                  $sub = substr($k,1,1);
                  if ($sub == '.') {
                    echo '&nbsp&nbsp&nbsp&nbsp'.$k;
                  }else{
                     echo $no++.'. '.$k;
                  }
                ?>
                </td>
               <td>:</td>
               <td style="width: 500px; padding-left: 10px; font-size: 17px;">
                <?php
                $id++;
                  if ($id == '4') {
                    echo $jenis;
                  }else{
                    echo $detail[$id];
                  }
                ?>  
                </td>
             </tr>
            <?php endforeach ?>
           
           </table>
           <br>
           <div class="kepala" style="font-size: 17px; margin-left: 450px"> 
                <div>Sampang, 15 Juli 2020</div>
                <div>Mengetahui,</div>
                <div>Kepala <?= $jenjang ?></div>
                <div style="margin-top: 90px; font-weight: bold;"><?= $kepala ?>
                </div>
                <div>NIY. <?= $niy ?></div>
           </div>
        </div>
      </div>
    </div>
  </section>
</div>

