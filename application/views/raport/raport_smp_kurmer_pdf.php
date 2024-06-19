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
	<?php 
		$id_santri = $this->uri->segment(3); 
		$id_kelas=$this->uri->segment(4);
		$rombel =$this->um->showRombel($id_kelas)['rombel'];
		$CI =& get_instance(); 
	?>

	<div class="kertas">
	<h2 class="judul-utama">PENCAPAIAN KOMPETENSI SISWA</h2>
		<table class="atas fon1">
			<tr>
				<td>Nama Sekolah</td>
				<td>:</td>
				<td>SMP Al-Ittihad Camplong</td>
				<td>Fase</td>
				<td>:</td>
				<td><?=$fase?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td style='width:20px;'>:</td>
				<td style='width:220px;'>Jl. Raya Camplong No. 15</td>
				<td>Kelas</td>
				<td style='width:20px;'>:</td>
				<td>
                    <?= $kelas['kelas_alias'] ?>
                </td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $nama ?></td>
				
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
        <br>
        <table>
			<thead>
    			<tr style="font-weight: 700; text-align: center; background-color:#f5f5ef">
    				<td style="width: 40px; vertical-align:middle">No</td>
    				<td style="width: 200px; vertical-align:middle">Muatan Pelajaran</td>
    				<td style="width: 60px; vertical-align:middle">Nilai Akhir</td>
    				<td style="vertical-align:middle">Capaian Kompetensi</td>
    			</tr>
			</thead>
            <tbody>
                <?php 
                    $no=1; 
                    foreach ($dkn[$id_santri]['nilai'] as $nilai): 
                ?>
                
                    <?php $nilai_ = $nilai['p'] ?>
                    <?php $mapel_id = $nilai['mapel_id'] ?>
                    <?php $kkm = $this->rm->kkm($rombel, $mapel_id, $this->tahunAktif['id_tahun']) ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?=$nilai['nama_mapel']?></td>
                    <td style="text-align: center"><?=$nilai_?></td>
                    <td><?= $CI->desBaruKurmer($nilai_, $kkm, $id_santri, $id_kelas, $mapel_id, 'p') ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
		</table>
               <br>
		<table class="lebar hal-akhir">
            <thead>
                <tr style="font-weight: bold; text-align: center; background-color:#f5f5ef">
                    <th style="width: 40px;">No</th>
                    <th style="width: 200px;">Ektrakurikulier</th>
                    <th style="width: 60px;">Predikat</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='font-size:15px'>1</td>
                    <td style='font-size:15px'>Pramuka</td>
                    <td style='font-size:15px; text-align:center'><?= $entry_wali['des_pramuka'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_pramuka'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>2</td>
                    <td style='font-size:15px'>OSIS/ISMII</td>
                    <td style='font-size:15px; text-align:center'><?= $entry_wali['des_ismi'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_ismi'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>3</td>
                    <td style='font-size:15px'>Baca Kitab</td>
                    <td style='font-size:15px; text-align:center'><?= $entry_wali['des_sorasi'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_sorasi'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>4</td>
                    <td style='font-size:15px'>Tahfidzul Qur'an</td>
                    <td style='font-size:15px; text-align:center' > <?= $entry_wali['des_tahfid'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_tahfid'] ?></td>
                </tr>
            </tbdoy>
		</table>
		<br>
		<div class="keterangan">
			<div class="kiri">
				<table class="lebar">
                    <tr style="text-align: center; font-weight: bold; background-color:#f5f5ef">
						<th style="width: 220px;">Ketidakhadiran</th>
						<th style="width: 80px;">Jumlah</th>
					</tr>
					<tr>
						<td style='font-size:15px'>Sakit</td>
                        <?php 
                          $jml_sakit = floor($entry_wali['sakit']/4);
                          $ket_sakit = $jml_sakit > 0 ? $jml_sakit.' hari' : '-';
                        ?>
						<td style='font-size:15px; text-align:center'><?=$ket_sakit?></td>
					</tr>
					<tr>
						<td style='font-size:15px'>Idzin</td>
						<?php 
                          $jml_ijin = floor($entry_wali['ijin']/4);
                          $ket_ijin = $jml_ijin > 0 ? $jml_ijin.' hari' : '-';
                        ?>
						<td style='font-size:15px; text-align:center'><?=$ket_ijin?></td>
					</tr>
					<tr>
						<td style='font-size:15px'>Tanpa Keterangan</td>
						<?php 
                          $jml_alpa = floor($entry_wali['alpa']/4);
                          $ket_alpa = $jml_alpa > 0 ? $jml_alpa.' hari' : '-';
                        ?>
						<td style='font-size:15px; text-align:center'><?=$ket_alpa?></td>
					</tr>
				</table>
			</div>
		</div>
		
		<div style="clear:left; margin-top:20px; height:5px"></div>
		
		<?php if ($semester == 2 ): ?>
			<div class="keputusan">
				<h4><strong>Keputusan:</strong></h4>
				<p style="margin-left: 20px; line-height: 20px; position: relative; bottom: 6px; font-size:15px">Berdasarkan pencapaian kompetensi pada semester 1 dan 2, <br> maka peserta didik ditetapkan: Naik ke Kelas <?= $kelas_baru[0].' ('.$kelas_baru[1].')' ?></p>
			</div>
		<?php endif ?>

		<div class="ttd">
			<div class="cf" style='text-align:right; margin-right: 20px'>
				Sampang, <?= $tgl_raport['smp'] ?>
			</div>
			<br><br>
				<div class="tempat-ttd" style="padding-left:10">
					<div class="bagi-tiga" style='width: 100px; padding-left: 10px;'>
						<div class="sebagai" style='font-size:14px'>Orang Tua/Wali</div>
						<div class="isi">____________________</div>
					</div>
					<div class="bagi-tiga" style='width:300px; padding-left: 20px;'>
						<div class="sebagai" style='font-size:14px'>Wali Kelas</div>
						<div class="isi" style='font-size:14px'><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>
					<div class="bagi-tiga" style='width: 180px; padding-left: 5px;; margin-left:-50'>
						<div class="sebagai" style='font-size:14px'>Mengetahui<br>Kepala Sekolah</div>
						<div class="isi" style='font-size:14px; margin-top:80px;'><u>Mudhar, S.Pd.</u> <br> NIY. 940613051</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>