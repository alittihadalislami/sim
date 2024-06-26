<link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">

<style>
 @media print {
    div.pisah { 
      page-break-before: always;
    }
    .main-footer{
      display: none;
    }
  }
  
  tr > td.jml{
    font-size: 19px;
  }

  .ar{
    font-weight: normal;
    font-size: 20px;
    padding-bottom: 0px;
    padding-top: 0px;
  }
  .id{
    padding-bottom: 0px;
    padding-top: 0px;
    position: relative;
    top: -5px;
  }
  .pembatas{
    margin-top: 50px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 30px;
  }
  .content{
    text-align: right;
    color: black;
  }

  table tr th {
    border: 1px solid black;
    background-color: #6BBC88
  }

  table tr td {
    border: 1px solid black;
  }

  section.content .row div.col-lg-10 table tr th {
    border: 1px solid black;
  }

  section.content .row div.col-lg-10 table tr td {
    border: 1px solid black;
    vertical-align: middle;
  }
  
  .arab1{
    padding-top: 5px;
    padding-bottom: 6px;
    line-height: 1px;
    font-weight: bold;
    font-size: 17px;
  }
  .ar-head{
    font-size: 15px;
    padding-top: 5px;
    padding-bottom: 5px;
    margin-bottom: 5px;
    margin-top: 5px;
    line-height: 1px;
  }
  .ttd > div{
    width: 32%;
    margin-left: 5px;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-lg-12 text-center">
          <button id="cetek-mii" class="btn btn-secondary" onclick="cetak()"><i class="fas fa-print text-primary"></i> Cetak Raport MII - <?= $at_santri['nama_santri'] ?></button>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content" dir="rtl">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10 mx-auto mb-5 p-5 elevation-2" style="background-color: white">
          <table class="table">
            <tr>
              <td style="border-top: 1px solid black">
                <div class="arab1">رقم التسجيل </div><div>No Induk </div>
                </td>
                <td>:</td>
                <td style="font-size: 19px"><?= $at_santri['idk_mii'] ?></td>
              <td>
                <div class="arab1">العام الدراسي </div><div>Tahun ajaran</div>
              </td>
                <td>:</td>
                <td style="font-size: 19px"><?= $at_tahun['nama_tahun'] ?></td>
            </tr>
            <tr>
              <td>
                <div class="arab1"><?=$domir['santri'];?></div><div>Nama Santri</div>
                </td>
                <td>:</td>
                <td dir="ltr" style="font-size: 19px">
                  <?php 
                    echo strlen($nama_di_detail) > 3 ? $nama_di_detail : $at_santri['nama_santri'];
                  ?>
                </td>
              <td>
                <div class="arab1">الصف / الفصل الدراسي</div><div>Semester/Kelas</div>
                <td>:</td>
                <td style="font-size: 19px"><?= substr($at_kelas,0,1) == 7 ? 'Takhassus' : $at_kelas ; ?> / <?= $at_tahun['semester'] == 1 ? 'Ganjil':'Genap' ?></td>
            </tr>
          </table>
            <?php 
                $baris_tabel = count($nilai_mii)+2;
            ?>
          <div class="pembatas">نتائج الإختبارات</div>
          <table class="table table-sm" style="text-align: center;">
            <tr>
              <th style="width: 2%">
                <div class="ar-head">الرقم</div><div>No</div>
              </th>
              <th style="width: 26%">
                <div class="ar-head">المواد</div><div>Pelajaran</div>
              </th>
              <th style="width: 12%">
                <div class="ar-head">الحضور</div><div>Kehadiran</div>
              </th>
              <th style="width: 12%">
                <div class="ar-head">اليومي</div><div>Harian</div>
              </th>
              <th style="width: 12%">
                <div class="ar-head">نصف الفصل</div><div>UTS</div>
              </th>
              <th style="width: 12%">
                <div class="ar-head">نهاية الفصل</div><div>UAS</div>
              </th>
              <th style="width: 12%">
                <div class="ar-head">المجموع</div><div>Nilai Akhir</div>
              </th>
              <th rowspan="<?=$baris_tabel?>" style="background-color:white"></th>
              <th style="width: 12%">
                <div class="ar-head">معدل الفصل</div><div>Rata-rata Kelas</div>
              </th>
            </tr>
            <!-- konten raport -->
            <?php $no=1; foreach ($nilai_mii as $mii): ?>
              <tr>
                <td><?=$no++?></td>
                <td style="text-align: right;">
                  <div style="font-weight: bold;"><?=$mii['mapel_ar'] ?></div>
                  <div><?=$mii['mapel'] ?></div>
                </td>
                <td class="nilai" style="font-size: 19px"><?=$mii['nkh'] ?></td>
                <td class="nilai" style="font-size: 19px"><?=$mii['nhr'] ?></td>
                <td class="nilai" style="font-size: 19px"><?=$mii['pts'] ?></td>
                <td class="nilai" style="font-size: 19px"><?=$mii['pas'] ?></td>
                <td class="nilai" style="font-size: 19px"><?=$mii['nrp'] ?></td>
                <td class="nilai" style="font-size: 19px"><?=$mii['rata2'] ?></td>
              </tr>
            <?php endforeach ?>
              <tr style="font-weight: bold;">
                <td colspan="2">
                  <div><?=$domir['rata']?></div>
                  <div>Rata-rata Santri</div>
                </td>
                <td class="jml">
                  <?=round($jumlah_mii['rata_nkh'],1) ?>
                </td>
                <td class="jml">
                  <?=round($jumlah_mii['rata_nhr'],1) ?>
                </td>
                <td class="jml">
                  <?=round($jumlah_mii['rata_pts'],1) ?>
                </td>
                <td class="jml">
                  <?=round($jumlah_mii['rata_pas'],1) ?>
                </td>
                <td class="jml">
                  <?=round($jumlah_mii['rata_nrp'],1) ?>
                </td>
                <td class="jml">
                  <!-- <?=round($jumlah_mii['rata_total'],1) ?> -->
                </td>
              </tr>
          </table>

          <div class="pembatas pisah"> السلوك </div>

          <table class="table table-sm" style="text-align: center;">
            <tr>
              <th>
                <div>الرقم</div>
                <div>No</div>
              </th>
              <th colspan="2">
                <div>االنوع</div>
                <div>Jenis</div>
              </th>
              <th>
                <div>الدرجة</div>
                <div>Nilai</div>
              </th>
              <th>
                <div>التوجيهات و الإرشادات</div>
                <div>Nasehat dan Bimbingan</div>
              </th>
            </tr>
            <tr>
              <td>1</td>
              <td colspan="2">
                <div>السلوك</div>
                <div>Prilaku</div>
              </td>
              <td style="font-size: 40px;"><?=$suluk_k ?></td>
              <td rowspan="4" style="direction: ltr;" >
                <?=$tambahan['nasehat'] ?>
              </td>
            </tr>
            <tr>
              <td rowspan="3">2</td>
              <td rowspan="3">
                <div>الغياب</div>
                <div>Ketidakhadiran</div>
              </td>
              <td>
                <div>المريض</div>
                <div>Sakit</div>
              </td>
              <td>
                <?php 
                    $sakit = floor($tambahan['sakit']/4);
                    echo $sakit == 0 ? '-' : $sakit
                ?>
              </td>             
            </tr>
            <tr>
              <td>
                <div>الإذن</div>
                <div>Idzin</div>
              </td>
              <td>
                <?php 
                    $ijin = floor($tambahan['ijin']/4);
                    echo $ijin == 0 ? '-' : $ijin
                ?>
              </td>
            </tr>
            <tr>
              <td>
                <div>الغياب</div>
                <div>Alpa</div>
              </td>
              <td>
                <?php 
                    $alpa = floor($tambahan['alpa']/4);
                    echo $alpa == 0 ? '-' : $alpa
                ?>
              </td>
            </tr>
          </table>

          <div class="teks" style="text-align: center">
            <?php if ($at_tahun['semester'] == 2): ?>
              <div class="ket" style="margin-top: 30px;">
                <div class="ar">
                  <?=$domir['ket'];?>
                </div>
                <div class="id">
                  Setelah memperhatikan penilaian hasil belajar yang diperoleh santri tersebut maka ditetapkan
                </div>
              </div>

              <div class="lulus" style="margin-top: 20px">
                <div class="ar">
                  <?= $domir['naik'].$ket['ket_ar'] ?>
                </div>
                <div class="id">
                  <?= $ket['ket_id'] ?>
                </div>
              </div>
            <?php endif ?>

            <div class="tanggal" style="margin-top: 20px">
            <?php
                $bulan_mii = explode(' ', $tgl_raport['mii']);
                $yyyy_mm_dd = $bulan_mii[2].'/'.$this->rm->angkaBulan($bulan_mii[1]).'/'.$bulan_mii[0];
                $hijiryah = $this->rm->masehiKeHijriyah($yyyy_mm_dd);
            ?>
              <div class="ar"> شمبلونج، <?=$hijiryah[0].' '.$hijiryah[1].' '.$hijiryah[2]?></div>
              <div class="id">Camplong, <?= $tgl_raport['mii'] ?></div>
            </div>

            <div class="ttd" style="text-align: center; margin-top: 20px">
              <div class="ortu" style="float: right;">
                <div class="ar"><?=$domir['wali'];?></div>
                <div class="id">Orang Tua</div>
                <div class="nama" style="margin-top: 85px">.................................................</div>
              </div>
              <div class="wali" style="float: right;">
                <div class="ar">ولي الصف</div>
                <div class="id">Wali Kelas</div>
                <div class="nama" style="direction: ltr; margin-top: 85px; font-weight: bold;font-size: 20px"><u><?= $at_wali['nama_asatid'] ?></u></div>
                <div style="direction: ltr; margin-top:-5px; font-size: 20px">NIY. <?=$at_wali['niy']?></div>
              </div>
              <div style="position: absolute; left: 50px; bottom: 240px">
                <div class="ar">بمعرفة</div>
                <div class="id">Mengetahui</div>
              </div>
              <div class="mudir" style="float: right;">
                <div class="ar">مدير المعـــهد</div>
                <div class="id">Mudir Ma'had</div>
                <div class="nama" style="direction: ltr; margin-top: 85px; font-weight: bold; font-size: 20px"><u>Dr. Achmad Junaidi, Lc., MA.</u></div>
                <div style="direction: ltr; margin-top:-5px; font-size: 20px">NIY. 940613045</div>
              </div>
            </div>
              <div style="clear:both;"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function cetak() {
    nilai_mii = document.getElementsByClassName('nilai');
    adaKosong = 0;
    for (let index = 0; index < nilai_mii.length; index++) {
        const element = nilai_mii[index];
        if (element.innerText < 1){
            adaKosong = adaKosong + 1
        }
    }
    if (adaKosong > 1) {
        alert('Ada nilai kosong, silahkan periksa kembali')
    }else{
        window.print();
    }
}
</script>
