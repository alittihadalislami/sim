<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title><?=$judul?></title>
	<style>
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed, 
		figure, figcaption, footer, header, hgroup, 
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,
		q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		/*========================= end of reset css ===================== */
			.cf:before,
	.cf:after {
	    content: " "; /* 1 */
	    display: table; /* 2 */
	}

	.cf:after {
	    clear: both;
	}

	/**
	 * For IE 6/7 only
	 * Include this rule to trigger hasLayout and contain floats.
	 */
	.cf {
	    *zoom: 1;
	}
	/*========================= end of clearfix css ===================== */
	
		@page { margin: 500px; }
		.center{
		    text-align:center;
		    vertical-align:middle; 
		}
		body{
	  		margin-top: 20px;
	  		padding: 30px 30px 30px 30px;
		}
		.fon1{
		    font-size:12px;
		}
		.fon2{
		    font-size:15px;
		}
		.lebar{
		    width:100%;
		}
		.kertas{
			width: 727px;
			margin-right: auto;
			margin-left: auto;
		}
		.judul-utama{
			font-size: 25px;
			text-align: center;
			margin-bottom: 20px;
		}
		table, tr, td {
			border: 1px solid black;
			padding: 5px;
		}
		table.atas tr td,table.atas tr,table.atas {
			border: 0px solid red;
			padding: 1px 5px 1px 5px;
		}
		table.atas{
			width: 100%;
		}
		table, tr, th {
			border: 1px solid black;
			padding: 5px;
		}
		p{
			margin-bottom: 10px;
		}
		.sub-judul{
			margin-top: 10px;
			margin-left: 20px;
			margin-bottom: 10px;
			font-size: 16px;
			font-weight: bold;
		}
		.judul{
			margin-top: 30px;
			margin-bottom: 10px;
			font-size: 16px;
			font-weight: bold;
		}
		.desk{
			width: 90%;
			margin: 5px 0px 5px 35px;
			text-align: justify;
			padding: 10px;
		}
		.kiri{
			width: 48%;
		}
		.kanan{
			width: 48%;
			padding: 5px;
			margin-top: 26px;
		}
		.keterangan > div{
		    float:left;
		    margin-right:20px;
		}
		
		.tgl > div{
		    float:left;
		    margin-left:20px;
		}

		.bagi-tiga > .isi, .kepala >.isi{
			margin-top: 100px;
		}
		
		table tr td.kecil{
			font-size: 12px;
			width: 30px;
			text-align: center;
		}
		.garis{
			border-bottom: 1px solid black;
			margin-top: 50px;
		}
		.keputusan{
			margin-top: 20px;
		}
		.kepala{
			position: relative;
			right: 60px;
			left: 350px;
		}
		.teks{
			font-size: 14px;
			font-family: tahoma;
			text-align: left;
		}
		.kkm{
    		border: 0.5px solid #969494;
    		width: 50px;
    		border-radius:2px;
    		padding-left: 4px;
    		margin-top: 10px; 
    		font-size: 12px; 
    		font-style: italic; 
    		font-weight: bold;
    	}
    	.footer{
    		position: fixed;
    		bottom: 40;
    		text-align: right;
    		padding-right: 20px;
    		font-size:10px;
    	}
    	.page-number:after { content: '| hal ' counter(page); }
    	
    	.pindah-hal{
		    page-break-before: always;
	    }
	    
	    .tempat-ttd > div {
	        float:left;
	        margin-right:45px;
	        margin-left:20px;
	    }
	    .ttd{
	        margin-top:25px;
	    }
	    .jarak{
	        margin-top:25px;
	    }
	    .kepala{
	        margin-left:30px;
	    }
	    .isi-deskrip{
	        word-wrap: break-word;
	    }
	</style>
</head>
<body>
    
	<div class="footer">MA Al-Ittihad Al-Islami | <?= $kelas['kelas_alias'].' | Semester '.$semester.' | '.$santri ?> <span class="page-number"></span></div>
	<?php 
		$id_santri = $this->uri->segment(3); 
		$id_kelas=$this->uri->segment(4);
		$rombel =$this->um->showRombel($id_kelas)['rombel'];
		$CI =& get_instance(); 
	?>

	<div class="kertas">
	    <h2 class="judul-utama">PENCAPAIAN HASIL BELAJAR</h2>
		<table class="atas">
			<tr>
				<td>Nama Sekolah</td>
				<td>:</td>
				<td>MA AL ITTIHAD AL ISLAMI</td>
				
			</tr>
			<tr>
				<td>Alamat</td>
				<td style='width:20px;'>:</td>
				<td style='width:220px;'>Jl. Raya Camplong No. 15</td>
				<td>Kelas</td>
				<td style='width:20px;'>:</td>
				<td><?= $kelas['kelas_alias'] ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $santri ?></td>
				
				<td>Semester</td>
				<td>:</td>
				<?php if ($semester > 1) {
						$des = 'Genap';
					} else { 
						$des = 'Ganjil';
					} 
				?>
				<td><?= $semester .' ('.$des.')'?></td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>:</td>
				<td><?= /*$nis.' / '.*/$nisn ?></td>
				
				<td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $tahun ?></td>
			</tr>
		</table>
		<h3 class="judul">A. Sikap</h3>
		<h4 class="sub-judul">1. Sikap Spiritual</h4>
	
		<div class="desk">
			<table>
				<tr>
					<th style='width:15%' class='center'>Predikat</th>
					<th class='center'>Deskripsi</th>
				</tr>
				<tr>
					<td style='height:60px' class='center'><?= $CI->DeskSikap($id_santri)[0]['predikat'][0]?></td>
					<td style='font-size:14px' class='center'><?= $CI->DeskSikap($id_santri)[0]['des']?></td>
				</tr>
			</table>
		</div>
		<h4 class="sub-judul">2. Sikap Sosial</h4>
		<div class="desk">
			<table>
				<tr>
					<th style='width:15%' class='center'>Predikat</th>
					<th class='center'>Deskripsi</th>
				</tr>
				<tr>
					<td style='height:60px' class='center'><?= $CI->DeskSikap($id_santri)[1]['predikat'][0]?></td>
					<td style='font-size:14px' class='center' ><?= $CI->DeskSikap($id_santri)[1]['des']?></td>
				</tr>
			</table>
		</div>
		<h3 class="judul">B. Pengetahuan dan Keterampilan</h3>
		<table table-layout= "fixed">
		    
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    <col width="10px">
		    
		    <thead>
    			<tr>
    				<td colspan="2" rowspan="2">Mata Pelajaran</td>
    				<td colspan="3">Pengetahuan</td>
    				<td colspan="3">Keterampilan</td>
    			</tr>
    			<tr>
    				<td class="kecil">Ang-<br>ka</td>
    				<td class="kecil">Pre-<br>dikat</td>
    				<td>Deskripsi</td>
    				<td class="kecil">Ang-<br>ka</td>
    				<td class="kecil">Pedi-<br>kat</td>
    				<td>Deskripsi</td>
    			</tr>
			</thead>
			<tbody>
    			<tr>
    				<td colspan="8">Kelompok A (Umum)</td>
    			</tr>
    			<tr>
    				<td>1</td>
    				<td colspan="7">Pendidikan Agama Islam dan Budi Pekerti</td>
    			</tr>
    			<tr>
    				<td style="width:15px"></td>
    
    				<?php $kkm = $this->rm->kkm($rombel, 31, $this->tahunAktif['id_tahun']) ?>
    
    				<td>a. Qur'an Hadist <br><p class="kkm">KKM:<?=$kkm ?></p></td>
    				<td><?= $dkn[$id_santri]['nilai'][31]['p'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][31]['p'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][31]['p'], $kkm,$id_santri, $id_kelas, 31, 'p') ?></td>
    
    				<td><?= $dkn[$id_santri]['nilai'][31]['k'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][31]['k'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][31]['k'], $kkm,$id_santri, $id_kelas, 31, 'k') ?></td>
    			</tr>
    			<tr>
    			    <?php $kkm = $this->rm->kkm($rombel, 40, $this->tahunAktif['id_tahun']) ?>
    				<td></td>
    				<td>b. Aqidah Akhlaq <br><p class="kkm">KKM:<?=$kkm ?></p></td>
    				<td><?= $dkn[$id_santri]['nilai'][40]['p'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][40]['p'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][40]['p'], $kkm, $id_santri, $id_kelas, 40, 'p') ?></td>
    
    				<td><?= $dkn[$id_santri]['nilai'][40]['k'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][40]['k'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][40]['k'], $kkm, $id_santri, $id_kelas, 40, 'k') ?></td>
    			</tr>
    			<tr>
    			    <?php $kkm = $this->rm->kkm($rombel, 8, $this->tahunAktif['id_tahun']) ?>
    				<td></td>
    				<td>c. Fiqh<br><p class="kkm">KKM:<?=$kkm ?></p></td>
    				<td><?= $dkn[$id_santri]['nilai'][8]['p'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][8]['p'],$kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][8]['p'], $kkm, $id_santri, $id_kelas, 8, 'p') ?></td>
    
    				<td><?= $dkn[$id_santri]['nilai'][8]['k'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][8]['k'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][8]['k'], $kkm, $id_santri, $id_kelas, 8, 'k') ?></td>
    			</tr>
    			<tr>
    			    <?php $kkm = $this->rm->kkm($rombel, 33, $this->tahunAktif['id_tahun']) ?>
    				<td></td>
    				<td>d. Sejarah Kebudayaan Islam<br><p class="kkm">KKM:<?=$kkm ?></p></td>
    				<td><?= $dkn[$id_santri]['nilai'][33]['p'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][33]['p'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][33]['p'], $kkm, $id_santri, $id_kelas, 33, 'p') ?></td>
    
    				<td><?= $dkn[$id_santri]['nilai'][33]['k'] ?></td>
    				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][33]['k'], $kkm)[0] ?></td>
    				<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][33]['k'], $kkm, $id_santri, $id_kelas, 33, 'k') ?></td>
    			</tr>
			    <?php $no=2; foreach ($kel1 as $k1): ?>
				<?php $kkm = $this->rm->kkm($rombel, $k1, $this->tahunAktif['id_tahun']) ?>
				<tr>
					<td><?=$no++?></td>
					<td><?= $dkn[$id_santri]['nilai'][$k1]['nama_mapel'] ?><br><p class="kkm">KKM:<?=$kkm ?></p></td>
					<td><?= $dkn[$id_santri]['nilai'][$k1]['p'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k1]['p'], $kkm)[0] ?></td>
					<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k1]['p'], $kkm, $id_santri, $id_kelas, $k1, 'p') ?></td>

					<td><?= $dkn[$id_santri]['nilai'][$k1]['k'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k1]['k'], $kkm)[0] ?></td>
					<td class="teks"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k1]['k'], $kkm, $id_santri, $id_kelas, $k1, 'k') ?></td>
				</tr>
			    <?php endforeach ?>
    			<tr>
    				<td colspan="8">Kelompok B (Umum)</td>
    			</tr>
			    <?php $no=1; foreach ($kel2 as $k2): ?>
			    <?php $kkm = $this->rm->kkm($rombel, $k2, $this->tahunAktif['id_tahun']) ?>
			    <?php $mapel = $dkn[$id_santri]['nilai'][$k2]['nama_mapel'] ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $mapel == "Al-Qur'an" ? "Mulok <br>(Tahfidz Al-Qur'an)" : $mapel  ?><br><p class="kkm">KKM:<?=$kkm ?></p></td>
					<td><?= $dkn[$id_santri]['nilai'][$k2]['p'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k2]['p'], $kkm)[0] ?></td>
					<td class="teks isi-deskrip"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k2]['p'], $kkm, $id_santri, $id_kelas, $k2, 'p') ?></td>

					<td><?= $dkn[$id_santri]['nilai'][$k2]['k'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k2]['k'], $kkm)[0] ?></td>
					<td class="teks isi-deskrip"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k2]['k'], $kkm, $id_santri, $id_kelas, $k2, 'k') ?></td>
				</tr>
			    <?php endforeach ?>
    			<tr>
    				<td colspan="8">Kelompok C (Peminatan)</td>
    			</tr>
			    <?php $no=1; foreach ($kel3 as $k3): ?>
			    <?php $kkm = $this->rm->kkm($rombel, $k3, $this->tahunAktif['id_tahun']) ?>
				<tr>
					<td><?=$no++?></td>
					<?php $mapel = $dkn[$id_santri]['nilai'][$k3]['nama_mapel']; ?>
					<td><?= $mapel?><br><p class="kkm">KKM:<?=$kkm ?></p></td>
					<td><?= $dkn[$id_santri]['nilai'][$k3]['p'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k3]['p'], $kkm)[0] ?></td>
					<td class="teks isi-deskrip"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k3]['p'], $kkm, $id_santri, $id_kelas, $k3, 'p') ?></td>

					<td><?= $dkn[$id_santri]['nilai'][$k3]['k'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k3]['k'], $kkm)[0] ?></td>
					<td class="teks isi-deskrip"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k3]['k'], $kkm, $id_santri, $id_kelas, $k3, 'k') ?></td>
				</tr>
			    <?php endforeach ?>
			</tbody>
		</table>
		<h3 class="judul pindah-hal">C. Ektrakurikulier</h3>
		<table class="lebar">
			<tr>
				<th>No</th>
				<th>Nama Kegiatan</th>
				<th>Predikat</th>
				<th>Keterangan</th>
			</tr>
			<tr>
				<td style='font-size:14px'>1</td>
				<td style='font-size:14px'>Pramuka</td>
				<td style='font-size:14px;' class='center'><?= $entry_wali['des_pramuka'] ?></td>
				<td style='font-size:14px'><?= $entry_wali['predikat_pramuka'] ?></td>
			</tr>
			<tr>
				<td style='font-size:14px'>2</td>
				<td style='font-size:14px'>OSIS/ISMII</td>
				<td style='font-size:14px' class='center'><?= $entry_wali['des_ismi'] ?></td>
				<td style='font-size:14px'><?= $entry_wali['predikat_ismi'] ?></td>
			</tr>
			<tr>
				<td style='font-size:14px'>3</td>
				<td style='font-size:14px'>Baca Kitab</td>
				<td style='font-size:14px' class='center'><?= $entry_wali['des_sorasi'] ?></td>
				<td style='font-size:14px'><?= $entry_wali['predikat_sorasi'] ?></td>
			</tr>
			<tr>
				<td style='font-size:14px'>4</td>
				<td style='font-size:14px'>Tahfidzul Qur'an</td>
				<td style='font-size:14px' class='center' > <?= $entry_wali['des_tahfid'] ?></td>
				<td style='font-size:14px'><?= $entry_wali['predikat_tahfid'] ?></td>
			</tr>
		</table>
		<h3 class="judul">D. Prestasi</h3>
		<table class="lebar">
			<tr>
				<th>No</th>
				<th>Jenis</th>
				<th>Keterangan</th>
			</tr>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</table>

		<div class="keterangan hal-akhir">
			<div class="kiri">
				<h3 class="judul">E. Ketidakhadiran</h3>
				<table class="lebar">
					<tr>
						<th>Keterangan</th>
						<th>Jumlah</th>
					</tr>
					<tr>
						<td style='font-size:14px'>Sakit</td>
						<td style='font-size:14px' class='center'><?= $entry_wali['sakit'] ?> Pertemuan</td>
					</tr>
					<tr>
						<td style='font-size:14px'>Idzin</td>
						<td style='font-size:14px' class='center'><?= $entry_wali['ijin'] ?> Pertemuan</td>
					</tr>
					<tr>
						<td style='font-size:14px'>Tanpa Keterangan</td>
						<td style='font-size:14px' class='center'><?= $entry_wali['alpa'] ?> Pertemuan</td>
					</tr>
				</table>
			</div>
			<div class="kanan">
				<h3 class="judul" style="margin-top: 0px;">F. Catatan Wali Kelas</h3>
				<hr>
				<p style='font-size:15px'><?= $entry_wali['nasehat'] ?></p>
			</div>
		</div>
		
		<div style="clear:left; margin-top:20px; height:5px"></div>

		<h3 class="judul">G. Tanggapan Orang Tua / Wali</h3>
		<div class="garis" style="margin-buttom:30px;"></div>
		<div style="clear:both; margin-top:20px; height:5px"></div>
		
		<?php if ($semester == 2 ): ?>
			<div class="keputusan">
				<h4><strong>Keputusan:</strong></h4>
				<p style="margin-left: 20px; line-height: 20px; position: relative; bottom: 6px; font-size:15px">Berdasarkan pencapaian kompetensi pada semester 1 dan 2, <br> maka peserta didik ditetapkan: Naik <?= $kelas_baru[0].' ('.$kelas_baru[1].')' ?></p>
			</div>
		<?php endif ?>

		<div class="ttd">
			<div class="cf" style='text-align:right; margin-right: 20px'>
				Sampang, <?= $tgl_raport['ma'] ?>
			</div>
			<br><br>
			<?php if ($semester == 1 ): ?>
				<div class="tempat-ttd">
					<div>
						<div class="sebagai" style='font-size:14px'>Orang Tua/Wali</div>
						<br><br><br><br>
						<div class="isi">____________________</div>
					</div>
					<div style="margin-left: 250px;">
						<div class="sebagai" style='font-size:14px'>Wali Kelas</div>
						<br><br><br><br>
						<div class="isi" style='font-size:14px'><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>
				</div>
			<?php else: ?>
				<div class="tempat-ttd">
					<div class="bagi-tiga">
						<div class="sebagai" style='font-size:14px'>Orang Tua/Wali</div>
						<div class="isi">____________________</div>
					</div>
					<div class="bagi-tiga">
						<div class="sebagai" style='font-size:14px'>Wali Kelas</div>
						<div class="isi" style='font-size:14px'><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>
					<div class="kepala">
						<div class="sebagai" style='font-size:14px'>Mengetahui<br>Kepala Sekolah</div>
						<div class="isi" style='font-size:14px; margin-top:80px;'><u>Mughni Musa, Lc., M.Ag.</u><br>NIY. 940613009</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
</body>
</html>