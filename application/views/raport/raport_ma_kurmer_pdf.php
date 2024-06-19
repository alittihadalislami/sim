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
    	
    	.hal-akhir{
            page-break-before: always;
        }
        .tempat-ttd{
            width: 100%;
            display: table;
        }
	    .tempat-ttd > div {
            display: table-cell;
	    }
	    .ttd{
	        margin-top:25px;
	    }
	    .jarak{
	        margin-top:25px;
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
	    <h2 class="judul-utama">LAPORAN HASIL BELAJAR</h2>
		<table class="atas">
			<tr>
				<td>Nama Sekolah</td>
				<td>:</td>
				<td>MA AL ITTIHAD AL ISLAMI</td>
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
        <br>
		<table class="lebar">     
		    <thead>
    			<tr style="font-weight: 700; text-align: center; background-color:#f5f5ef">
    				<td style="width: 40px; vertical-align:middle">No</td>
    				<td style="width: 200px; vertical-align:middle">Muatan Pelajaran</td>
    				<td style="width: 60px; vertical-align:middle">Nilai Akhir</td>
    				<td style="vertical-align:middle">Capaian Kompetensi</td>
    			</tr>
			</thead>
			<tbody>
                <?php $no=1; foreach ($kel1 as $k1): ?>
                <tr>
    				<td style="text-align: center"><?=$no++?></td>
    				<?php $kkm = $this->rm->kkm($rombel, $k1, $this->tahunAktif['id_tahun']) ?>
    				<?php $mapel = $dkn[$id_santri]['nilai'][$k1]['nama_mapel']; ?>
					<td><?= $mapel?></td>
    				<td style="text-align: center;"><?= $dkn[$id_santri]['nilai'][$k1]['p'] ?></td>
    				<td class="teks"><?= $CI->desBaruKurmer($dkn[$id_santri]['nilai'][$k1]['p'], $kkm,$id_santri, $id_kelas, $k1, 'p') ?></td>
    			</tr>
                <?php endforeach ?>
                <?php $no=11; foreach ($kel2 as $k2): ?>
                <tr>
    				<td style="text-align: center"><?=$no++?></td>
    				<?php $kkm = $this->rm->kkm($rombel, $k2, $this->tahunAktif['id_tahun']) ?>
    				<?php $mapel = $dkn[$id_santri]['nilai'][$k2]['nama_mapel']; ?>
					<td><?= $mapel?></td>
    				<td style="text-align: center;"><?= $dkn[$id_santri]['nilai'][$k2]['p'] ?></td>
    				<td class="teks"><?= $CI->desBaruKurmer($dkn[$id_santri]['nilai'][$k2]['p'], $kkm,$id_santri, $id_kelas, $k2, 'p') ?></td>
    			</tr>
                <?php endforeach ?>
                <?php $no=15; foreach ($kel3 as $k3): ?>
                <tr>
    				<td style="text-align: center"><?=$no++?></td>
    				<?php $kkm = $this->rm->kkm($rombel, $k3, $this->tahunAktif['id_tahun']) ?>
    				<?php $mapel = $dkn[$id_santri]['nilai'][$k3]['nama_mapel']; ?>
					<td><?= $mapel?></td>
    				<td style="text-align: center;"><?= $dkn[$id_santri]['nilai'][$k3]['p'] ?></td>
    				<td class="teks"><?= $CI->desBaruKurmer($dkn[$id_santri]['nilai'][$k3]['p'], $kkm,$id_santri, $id_kelas, $k3, 'p') ?></td>
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
                    <td style='font-size:14px;' class='center'><?= $entry_wali['des_pramuka'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_pramuka'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>2</td>
                    <td style='font-size:15px'>OSIS/ISMII</td>
                    <td style='font-size:15px' class='center'><?= $entry_wali['des_ismi'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_ismi'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>3</td>
                    <td style='font-size:15px'>Baca Kitab</td>
                    <td style='font-size:15px' class='center'><?= $entry_wali['des_sorasi'] ?></td>
                    <td style='font-size:15px'><?= $entry_wali['predikat_sorasi'] ?></td>
                </tr>
                <tr>
                    <td style='font-size:15px'>4</td>
                    <td style='font-size:15px'>Tahfidzul Qur'an</td>
                    <td style='font-size:15px' class='center' > <?= $entry_wali['des_tahfid'] ?></td>
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
				<p style="margin-left: 20px; line-height: 20px; position: relative; bottom: 6px; font-size:15px">Berdasarkan pencapaian kompetensi pada semester 1 dan 2, <br> maka peserta didik ditetapkan: Naik ke kelas <?= $kelas_baru[0].' ('.$kelas_baru[1].')' ?></p>
			</div>
		<?php endif ?>

		<div class="ttd">
			<div class="cf" style='text-align:right; margin-right: 20px'>
				Sampang, <?= $tgl_raport['ma'] ?>
			</div>
			<br><br>
				<div class="tempat-ttd">
					<div class="bagi-tiga" style='width: 190px; padding-left: 20px;'>
						<div class="sebagai" style='font-size:14px'>Orang Tua/Wali</div>
						<div class="isi">____________________</div>
					</div>
					<div class="bagi-tiga" style='width: 220px; padding-left: 10px;'>
						<div class="sebagai" style='font-size:14px'>Wali Kelas</div>
						<div class="isi" style='font-size:14px'><u><?= $wali['nama_asatid'] ?></u><br>NIY. <?= $wali['niy'] ?></div>
					</div>
					<div class="kepala" style='width: 180px; padding-left: 10px;'>
						<div class="sebagai" style='font-size:14px'>Mengetahui<br>Kepala Sekolah</div>
						<div class="isi" style='font-size:14px; margin-top:80px;'><u>Mughni Musa, Lc., M.Ag.</u><br>NIY. 940613009</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>