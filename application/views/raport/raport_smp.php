<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
		body{
			font-size: 18px;
			font-family: tahoma;
		}
		.kertas{
			background-color: whitesmoke;
			width: 827px;
			margin-right: auto;
			margin-left: auto;
			padding: 10px 10px 50px 10px;
		}

		.judul-utama{
			font-size: 25px;
			text-align: center;
			margin-bottom: 40px;
		}
		
		table, tr, td {
			border: 1px solid black;
			padding: 5px;
		}

		table.atas tr td,table.atas tr,table.atas {
			border: 0px solid red;
			padding: 5px;
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
			font-size: 18px;
			font-weight: bold;
		}
		.judul{
			margin-top: 30px;
			margin-bottom: 10px;
			font-size: 18px;
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
			width: 48%;
		}
		.kanan{
			width: 48%;
			padding: 5px;
			margin-top: 57px;
			border: 1px solid black;
		}

		.keputusan{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}

		.tgl{
			margin-top: 30px;
			display: flex;
			flex-direction: row;
			justify-content: space-around;
		}
		.tempat-ttd{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
		}
		.bagi-tiga > .isi{
			background-color: red;
			margin-top: 100px;
		}

	</style>
</head>
<body>
	<?php $id_santri = $this->uri->segment(3); $id_kelas=$this->uri->segment(4) ?>
	<?php  $CI =& get_instance(); ?>
	<div class="kertas">
	<h2 class="judul-utama">PENCAPAIAN KOMPETENSI SISWA</h2>
		<table class="atas">
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
				<td>Jalan Raya Camplong No. 15 Sampang</td>
				<td>Semester</td>
				<td>:</td>
				<td><?= $semester.'/'.$semester_huruf ?></td>
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
				<td>0132 / 9890898980</td>
			</tr>
		</table>
		<h3 class="judul">A. Sikap</h3>
		<h4 class="sub-judul">1. Sikap Spiritual</h4>
		<div class="desk">
			<?= $CI->DeskSikap($id_santri)[0]['des']?>
		</div>
		<h4 class="sub-judul">2. Sikap Sosial</h4>
		<div class="desk">
			<?= $CI->DeskSikap($id_santri)[1]['des']?>
		</div>
		<h3 class="judul">B. Pengetahuan dan Keterampilan</h3>
		<h4 class="sub-judul">Ketuntasan Belajar Minimal</h4>
		<table>
			<tr>
				<td colspan="2" rowspan="2">Mata Pelajaran</td>
				<td colspan="3">Pengetahuan</td>
				<td colspan="3">Keterampilan</td>
			</tr>
			<tr>
				<td style="text-align: center; font-size: 15px">Ang-<br>ka</td>
				<td style="text-align: center; center; font-size: 15px">Pre-<br>dikat</td>
				<td>Pengetahuan</td>
				<td style="text-align: center; center; font-size: 15px">Ang-<br>ka</td>
				<td style="text-align: center; center; font-size: 15px">Pre-<br>dikat</td>
				<td>Keterampilan</td>
			</tr>
				<?php $no=1; foreach ($dkn[414]['nilai'] as $k => $mp): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $mp['nama_mapel'] ?></td>

				<td><?= $dkn[$id_santri]['nilai'][$k]['p'] ?></td>
				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k]['p'], 75)[0] ?></td>
				<td style="font-size: 15px"><?= $CI->tampilPredikat($id_santri, $id_kelas, $k, 'p') ?></td>

				<td><?= $dkn[$id_santri]['nilai'][$k]['k'] ?></td>
				<td><?= $CI->hitungPredikat($dkn[$id_santri]['nilai'][$k]['k'], 75)[0] ?></td>
				<td style="font-size: 15px"><?= $CI->tampilPredikat($id_santri, $id_kelas, $k, 'k') ?></td>
			</tr>
				<?php endforeach ?>
		</table>
		<h3 class="judul">C. Ektrakurikulier</h3>
		<table class="lebar">
			<tr>
				<th>No</th>
				<th>Nama Kegiatan</th>
				<th>Nilai</th>
				<th>Keterangan</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Pramuka</td>
				<td><?= $entry_wali['des_pramuka'] ?></td>
				<td><?= $entry_wali['predikat_pramuka'] ?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>OSIS/ISMII</td>
				<td><?= $entry_wali['des_ismi'] ?></td>
				<td><?= $entry_wali['predikat_ismi'] ?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Jurnalistik</td>
				<td><?= $entry_wali['des_sorasi'] ?></td>
				<td><?= $entry_wali['predikat_sorasi'] ?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Tahfidzul Qur'an</td>
				<td><?= $entry_wali['des_tahfid'] ?></td>
				<td><?= $entry_wali['predikat_tahfid'] ?></td>
			</tr>
		</table>
		<div class="keputusan">
			<div class="kiri">
				<h3 class="judul">D. Ketidakhadiran</h3>
				<table class="lebar">
					<tr>
						<th>Keterangan</th>
						<th>Jumlah</th>
					</tr>
					<tr>
						<td>Sakit</td>
						<td><?= $entry_wali['sakit'] ?> Hari</td>
					</tr>
					<tr>
						<td>Idzin</td>
						<td><?= $entry_wali['ijin'] ?> Hari</td>
					</tr>
					<tr>
						<td>Tanpa Keterangan</td>
						<td><?= $entry_wali['alpa'] ?> Hari</td>
					</tr>
				</table>
			</div>
			<div class="kanan">
				<p>Keputusan:</p> 
				<p>Berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2, Siswa ditetapkan:</p>

				<p style="font-weight: bold;">Naik ke Kelas <?= $kelas_baru[0].' ('.$kelas_baru[1].')' ?></p>
			</div>
		</div>
		<div class="ttd">
			<div class="tgl">
				<div class="bagi-dua">
					Mengetahui,
				</div>
				<div class="bagi-dua">
					Sampang, 11 Oktober 2015
				</div>
			</div>
			<div class="tempat-ttd">
				<div class="bagi-tiga">
					<div class="sebagai">Orang Tua/Wali</div>
					<div class="isi">________________________</div>
				</div>
				<div class="bagi-tiga">
					<div class="sebagai">Wali Kelas</div>
					<div class="isi">Abu Ibnu</div>
				</div>

				<div class="bagi-tiga">
					<div class="sebagai">Kepala Sekolah</div>
					<div class="isi"><u>Mudhar, S.Pd.</u> <br> NIY.38428937</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>