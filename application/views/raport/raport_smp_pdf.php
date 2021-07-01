<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title><?=$judul?></title>
	<link rel="stylesheet" href="<?= base_url('assets/css/').'smppdf.css' ?>">
</head>
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


	.fon1{
	    font-size: 15px;
	}
	
	.fon2{
	    font-size: 14px;
	}
	
	body{
  		margin-top: 50px;
	}
	

	.kertas{
		width: 727px;
		margin-right: auto;
		margin-left: auto;
		padding: 10px 10px 50px 10px;
	}

	.judul-utama{
		font-size: 20px;
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

	.lebar{
		width: 100%;
		margin: 0 auto 0 auto 
	}
	.sub-judul{
		margin-top: 10px;
		margin-left: 20px;
		margin-bottom: 10px;
		font-size: 14px;
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
		border: 1px solid black;
		text-align: justify;
		padding: 10px;
	}
	.kiri{
		width: 45%;
	}
	.kanan{
		width: 48%;
		height: 146px;
		padding: 5px;
		margin-top: 30px;
		margin-left: 38px;
		border: 1px solid black;
		padding: 0px 10px 0px 10px;
	}

	.hal-akhir{
		page-break-before: always;
	}

	.keputusan > div{
		float: left;
	}

	.tgl > div {
		display: inline-block;
		margin-top: 20px;
		margin-right: 445px;
	}

	.tempat-ttd > div{
		float: left;
		margin-right: 90px;
	}
	
	.ttd{
	    margin-right:50px;
	}

	.bagi-tiga > .isi{
		margin-top: 100px;
	}

	.footer{
		position: fixed;
		bottom: 40;
		text-align: right;
		padding-right: 20px;
		font-size:10px;
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
	

	.page-number:after { content: '| hal ' counter(page); }
</style>

<body>
	<div class="footer">SMP Al-Ittihad Camplong | <?= $kelas['kelas_alias'].' | Semester '.$semester.' | '.$nama ?> <span class="page-number"></span></div>
	<?php $id_santri = $this->uri->segment(3); $id_kelas=$this->uri->segment(4) ?>
	<?php  $CI =& get_instance(); ?>
	<div class="kertas">
	<h2 class="judul-utama">PENCAPAIAN KOMPETENSI SISWA</h2>
		<table class="atas fon1">
			<tr>
				<td>Nama Sekolah</td>
				<td>:</td>
				<td>SMP AL ITTIHAD CAMPLONG</td>
				<td>Kelas</td>
				<td>:</td>
				<td><?=$kelas['kelas_alias'] ?></td>
			</tr>
			<tr>
				<?php 
					if ($semester == 1) {
						$semester_huruf = 'Ganjil';
					}else{
						$semester_huruf = 'Genap';
					}
				?>
				<td>Alamat</td>
				<td>:</td>
				<td>Jl. Raya Camplong No. 15</td>
				<td>Semester</td>
				<td>:</td>
				<td><?= $semester.' / '.$semester_huruf ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $nama ?></td>
				<td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $tahun ?></td>
			</tr>
			<tr>
				<td>NIS / NISN</td>
				<td>:</td>
				<td><?= isset($nis) ? $nis : '-' ?> / <?= isset($nisn) ? $nisn : '-' ?></td>
			</tr>
		</table>
		<h3 class="judul">A. Sikap</h3>
		<h4 class="sub-judul">1. Sikap Spiritual</h4>
		<div class="desk fon1">
			<?= $CI->DeskSikap($id_santri)[0]['des']?>
		</div>
		<h4 class="sub-judul">2. Sikap Sosial</h4>
		<div class="desk fon1">
			<?= $CI->DeskSikap($id_santri)[1]['des']?>
		</div>
		<h3 class="judul">B. Pengetahuan dan Keterampilan</h3>
		<!-- <h4 class="sub-judul">Ketuntasan Belajar Minimal: 75</h4> -->
		<table>
			<thead>
				<tr>
					<td colspan="2" rowspan="2">Mata Pelajaran</td>
					<td colspan="3">Pengetahuan</td>
					<td colspan="3">Keterampilan</td>
				</tr>
				<tr>
					<td style="text-align: center; font-size: 11px">Ang-<br>ka</td>
					<td style="text-align: center; center; font-size: 11px">Pre-<br>dikat</td>
					<td>Deskripsi</td>
					<td style="text-align: center; center; font-size: 11px">Ang-<br>ka</td>
					<td style="text-align: center; center; font-size: 11px">Pre-<br>dikat</td>
					<td>Deskripsi</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">Kelompok A</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php $no=0; foreach ($dkn[$id_santri]['nilai'] as $k => $mp): ?>
				<?php if ($no==7): ?>
					<tr class="hal-akhir">
						<td colspan="2">Kelompok B</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>					
				<?php endif ?>
				<tr>
					<td><?= $no++ > 6 ? $no-7 : $no ?></td>
					<td class="fon1"><?= $mp['nama_mapel'] ?><br><p class="kkm">KKM:75</p></td>

					<td><?= $dkn[$id_santri]['nilai'][$k]['p'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k]['p'], 75)[0] ?></td>
					<td style="font-size: 14px; width: 28%"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k]['p'], 75, $id_santri, $id_kelas, $k, 'p') ?></td>

					<td><?= $dkn[$id_santri]['nilai'][$k]['k'] ?></td>
					<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k]['k'], 75)[0] ?></td>
					<td style="font-size: 14px;  width: 28%"><?= $CI->desBaru($dkn[$id_santri]['nilai'][$k]['k'], 75,$id_santri, $id_kelas, $k, 'k') ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<h3 class="judul">C. Ektrakurikulier</h3>
		<table class="lebar">
			<tr>
				<th>No</th>
				<th>Nama Kegiatan</th>
				<th style="text-align:center">Nilai</th>
				<th>Keterangan</th>
			</tr>
			<tr>
				<td class="fon2">1</td>
				<td class="fon2">Pramuka</td>
				<td class="fon2" style="text-align:center"><?= $entry_wali['des_pramuka'] ?></td>
				<td class="fon2"><?= $entry_wali['predikat_pramuka'] ?></td>
			</tr>
			<tr>
				<td class="fon2">2</td>
				<td class="fon2">OSIS/ISMII</td>
				<td style="text-align:center"><?= $entry_wali['des_ismi'] ?></td>
				<td class="fon2"><?= $entry_wali['predikat_ismi'] ?></td>
			</tr>
			<tr>
				<td class="fon2">3</td>
				<td class="fon2">Jurnalistik</td>
				<td style="text-align:center"><?= $entry_wali['des_sorasi'] ?></td>
				<td class="fon2"><?= $entry_wali['predikat_sorasi'] ?></td>
			</tr>
			<tr>
				<td class="fon2">4</td>
				<td class="fon2">Tahfidzul Qur'an</td>
				<td class="fon2" style="text-align:center"><?= $entry_wali['des_tahfid'] ?></td>
				<td class="fon2"><?= $entry_wali['predikat_tahfid'] ?></td>
			</tr>
		</table>
		<div class="keputusan fon2 hal-akhir">
			<div class="kiri">
				<h3 class="judul">D. Ketidakhadiran</h3>
				<table class="lebar">
					<tr>
						<th class="fon2">Keterangan</th>
						<th class="fon2" style="text-align:center">Jumlah</th>
					</tr>
					<tr>
						<td class="fon2">Sakit</td>
						<td class="fon2" style="text-align:center"><?= round($entry_wali['sakit']/4,0) ?> Hari</td>
					</tr>
					<tr>
						<td class="fon2">Idzin</td>
						<td class="fon2" style="text-align:center"><?= round($entry_wali['ijin']/4,0) ?> Hari</td>
					</tr>
					<tr>
						<td class="fon2">Tanpa Keterangan</td>
						<td class="fon2" style="text-align:center"><?= round($entry_wali['alpa']/4,0) ?> Hari</td>
					</tr>
				</table>
			</div>
			<?php if ($semester == 2): ?>
				<div class="kanan">
					<p style="font-size: 15px; font-weight: bold; border-bottom: 1px solid grey; padding: 9px 5px 9px 5px;">Keputusan:</p> 
					<p class="fon2">Berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2, Siswa ditetapkan:</p>

					<?php  
						$rombel = substr($kelas['nama_kelas'],0,1);
					?>

					<?php if ($semester == 2 && $rombel == 3): ?>
						<p class="fon2" style="font-weight: bold;">  <?= $kelas_baru[1] ?> </p>
					<?php else: ?>
						<p class="fon2" style="font-weight: bold;">Naik ke Kelas <?= $kelas_baru[0].' ('.$kelas_baru[1].')' ?></p>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
		<div style="clear: left;"></div>
		<div class="ttd fon2" style="margin-left:20px; margin-top:30px;">
			<div class="tgl">
				<div class="bagi-dua">
					Mengetahui,
				</div>
				<div class="bagi-dua" style="margin-top: 0; margin-right: 100px ">
					Sampang, 5 Juni 2021
				</div>
			</div>
			<?php if ($semester == 1): ?>
				<div class="tempat-ttd cf">
					<div class="bagi-dua">
						<div class="sebagai">Orang Tua/Wali</div>
						<br><br><br><br>
						<div class="isi">_____________________</div>
					</div>
					<div class="bagi-dua" style="margin-left: 250px;">
						<div class="sebagai">Wali Kelas</div>
						<br><br><br><br>
						<div class="isi"><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>
				</div>
			<?php endif ?>
			<?php if ($semester == 2): ?>
				<div class="tempat-ttd cf">
					<div class="bagi-tiga">
						<div class="sebagai">Orang Tua/Wali</div>
						<div class="isi">_____________________</div>
					</div>
					<div class="bagi-tiga">
						<div class="sebagai">Wali Kelas</div>
						<div class="isi"><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>

					<div class="bagi-tiga">
						<div class="sebagai">Kepala Sekolah</div>
						<div class="isi"><u>Mudhar, S.Pd.</u> <br> NIY. 940613051</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
</body>
</html>