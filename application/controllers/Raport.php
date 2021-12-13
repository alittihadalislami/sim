<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport extends CI_Controller {

	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
		$this->tahunAktif = $this->um->tahunAktif();
		
		$this->load->model('Raport_model','rm');
	}

	public function index()
	{
		$this->rapotsmp();
	}

	public function cetaksmp($santri,$kls)
	{
		$jenjang = 'smp';

		$data['judul'] = 'Raport - SMP Al Ittihad Camplong';

		$id_santri = $this->uri->segment(3);
		$id_kelas = $this->uri->segment(4);

		$data['nama'] = $this->um->showNamaSantri($id_santri)['nama_santri'];
		$data['nis'] = '';
		$data['nisn'] ='';
		$data['kelas'] =  $this->um->showNamaKelas($id_kelas);
		$data['semester'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['semester'];
		$data['tahun'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['nama_tahun'];
		$data ['entry_wali'] = $this->extra($santri);

		$data['kelas_baru'] = $this->naikke($data['kelas']['nama_kelas']);

		$data['dkn'] = $this->siapkanNilai($kls,$jenjang);

		$this->load->view('raport/raport_smp', $data);
		
	}

	public function cekwali()
	{
		$tahun_aktif = $this->tahunAktif['id_tahun'];
		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$id_asatid = $this->um->idAsatid($nohp)['id_asatid'];
		$data_wali = $this->um->adaIdWali($id_asatid,$tahun_aktif);
		return $data_wali;
	}

	public function nisn()
	{
		
		$data['judul'] = 'NISN';
		$filter_kelas = $this->cekwali()['kelas_id'];
		$data['id_kelas'] = $filter_kelas;
		$data['santri'] = $this->um->santriKelas($data ['id_kelas'], $this->tahunAktif['id_tahun']);

		$daput = $this->input->post('simpan');

		if ($daput) {
			$input = $this->input->post();
			
			foreach ($input as $k => $v) {

				if ( $v != null and $k != 'simpan') {
					
					$id_santri = explode('-', $k)[1] ;
					$nisn = $v;

					$this->db->where('id_santri', $id_santri);
					$this->db->update('m_santri', ['nisn'=>$nisn]);		
				}
			}

			echo "<script>
			alert('Data berhasil disimpan..');
			window.location.href='".base_url('penilaian/raport')."';
			</script>";

		}else{
			$this->load->view('templates/header', $data);
			$this->load->view('raport/raport_nisn', $data);
			$this->load->view('templates/footer');
		}

	}

	public function pdfsmp($santri,$kls)
	{
		$jenjang = $this->rm->jenjangKelas($kls); 

		$data['judul'] = 'Raport - SMP Al Ittihad Camplong';

		$id_santri = $this->uri->segment(3);
		$id_kelas = $this->uri->segment(4);

		$id_asatid = $this->cekwali()['asatid_id'];

		//nama fix santri dari table detail atau dari tabel santri
		$detail = $this->db->get_where('t_detail_santri', ['santri_id'=> $id_santri])->row_array();
	    if ($detail) {
	        if(strlen($detail['nama_seijazah']) > 3 ){
	          	$data['nama'] = $detail['nama_seijazah'];
	        }else{
	          	$data['nama'] = $this->um->showNamaSantri($id_santri)['nama_santri'];
	        }  
	    }else{
			$data['nama'] = $this->um->showNamaSantri($id_santri)['nama_santri'];
	    }

		
		$data['wali'] = $this->um->showNamaAsatid($id_asatid);
		$data['nis'] = $this->rm->nomorSantri($id_santri)['idk_umum'];
		$data['nisn'] = $this->rm->nomorSantri($id_santri)['nisn'];
		$data['kelas'] =  $this->um->showNamaKelas($id_kelas);
		$data['semester'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['semester'];
		$data['tahun'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['nama_tahun'];
		$data ['entry_wali'] = $this->extra($santri);

		$data['kelas_baru'] = $this->naikke($data['kelas']['nama_kelas']);

		$data['dkn'] = $this->siapkanNilai($kls,$jenjang);

		$namafile = "Raport-SMP Al Ittihad-".$data['nama']."-".$data['kelas']['nama_kelas']."-s".$data['semester'].'_'.$data['tahun'];
		

		$this->load->library('pdf');
		
		$this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "$namafile.pdf";
	    $this->pdf->load_view('raport/raport_smp_pdf', $data);
	    
        // $this->load->view('raport/raport_smp_pdf', $data);
		
	}
	
	public function pdfma($santri,$kls)
	{

		$jenjang = $this->rm->jenjangKelas($kls); 
		$rombel = $this->um->showRombel($kls)['rombel'];

		$data['judul'] = 'Raport - MA Al-Ittihad Al-Islami';

		$id_santri = $this->uri->segment(3);
		$id_kelas = $this->uri->segment(4);

		$id_asatid = $this->cekwali()['asatid_id'];

		$data['kel1'] = [20,5,4,17,36,6];
		$data['kel2'] = [22,19,38,37];
		$data['kel3'] = [13,10,29,2,42,28]; 

		/*
		24: Sharaf
		18: Nahwu
		*/

		//unset($data['kel3'][3]);//buang id ke 3 (41:ilmu kalam)

		// if ($rombel == 6) {
		// 	$data['kel3'][6] = 7; //jika kelas 6 ubah idmapel menjadi balaghoh
		// }

		//nama fix santri dari table detail atau dari tabel santri
		$detail = $this->db->get_where('t_detail_santri', ['santri_id'=> $id_santri])->row_array();

	    if ($detail) {
	        if(strlen($detail['nama_seijazah']) > 3 ){
	          	$data['santri'] = $detail['nama_seijazah'];
	        }else{
	          	$data['santri'] = $this->um->showNamaSantri($id_santri)['nama_santri'];
	        }  
	    }else{
			$data['santri'] = $this->um->showNamaSantri($id_santri)['nama_santri'];
	    }

		$data['wali'] = $this->um->showNamaAsatid($id_asatid);
		$data['nis'] = $this->rm->nomorSantri($id_santri)['idk_umum'];
		$data['nisn'] = $this->rm->nomorSantri($id_santri)['nisn'];
		$data['kelas'] =  $this->um->showNamaKelas($id_kelas);
		$data['semester'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['semester'];
		$data['tahun'] = $this->um->showNamaTahun($this->tahunAktif['id_tahun'])['nama_tahun'];
		$data ['entry_wali'] = $this->extra($santri);

		$data['kelas_baru'] = $this->naikke($data['kelas']['nama_kelas']);

		$data['dkn'] = $this->siapkanNilai($id_kelas,$jenjang);

		$namafile = "Raport-MA Al Ittihad-".$data['santri']."-".$data['kelas']['nama_kelas']."-s".$data['semester'].'_'.$data['tahun'];

		// $this->load->view('raport/raport_ma_pdf',$data); die();

		$this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "$namafile.pdf";
	    $this->pdf->load_view('raport/raport_ma_pdf', $data);
		
	}

	public function cetakma()
	{
		$data['judul'] = 'Raport - MA Al Ittihad Al Islami';
		$id_santri = $this->uri->segment(3);
		$id_kelas = $this->uri->segment(4);


		$this->load->view('raport/raport_ma', $data);
		
	}

	public function naikke($nama_kelas)
	{
			
		$baru_kelas = substr($nama_kelas, 0,1)+1;

		switch ($baru_kelas) {
			case 2:
				$kelas = ['VIII','Delapan'];
				break;
			case 3:
				$kelas = ['IX','Sembilan'];
				break;
			case 4:
				$kelas = [ null,'Lulus'];
				break;
			case 5:
				$kelas = [ 'XI','Sebelas'];
				break;
			case 6:
				$kelas = [ 'XII','Dua Belas'];
				break;
			case 7:
				$kelas = [ '','Lulus'];
				break;
			
			default:
				echo "tidak ada kelas";
				break;
		}
			return $kelas;
	}

	public function dkn($kelas) //nilai alittihad
	{
		$jenjang = $this->rm->jenjangKelas($kelas);
		$rombel = $this->um->showRombel($kelas)['rombel'];

		$data['judul'] = 'Daftar Nilai Kolektif';
		$is_Konfersi = $this->rm->sudahAdaKonfersi($kelas,$this->tahunAktif['id_tahun']);

		if ($is_Konfersi == null) {
			$data['dkn'] = $this->nilai($kelas, $jenjang);
			$data['mapel'] = $this->rm->showMapel($jenjang,$rombel);

			$is_lengkap = 0;
			$kosongs = [];
			foreach ($data['dkn'] as $dkn) {
				foreach ($data['mapel'] as $mapel) {
					
					$idmapel = $mapel['mapel_id'];

					$nilai_p = isset($dkn['mapel'][$idmapel]['p']) ? $dkn['mapel'][$idmapel]['p'] : null;
					$nilai_k = isset($dkn['mapel'][$idmapel]['k']) ? $dkn['mapel'][$idmapel]['k'] : null;
					
					if ($nilai_p == null or $nilai_k == null) {
						$is_lengkap +=1 ;
						$kosongs [] = $mapel['mapel_alias'];
					}
				}
			}

			$data ['kosong'] = array_unique($kosongs);

			if ($is_lengkap > 0 ) {
				$is_lengkap = false;
			}else{
				$is_lengkap = true;
			}

			$data['is_lengkap'] = $is_lengkap;

			$this->load->view('templates/header', $data);
			$this->load->view('raport/dkn_smp', $data);
			$this->load->view('templates/footer');
		}else{
			$this->showDknRaport($kelas, $jenjang);
		}

	}

	function resetDKN($kelas,$tahun)
	{
		$this->db->where('kelas_id', $kelas);
		$this->db->where('tahun_id', $tahun);
		$this->db->delete('t_dkn_raport');

		redirect('penilaian/raport','refresh');
	}

	public function minmax($kelas, $mapel, $kd)
	{

		$hasil = $this->rm->minmax($this->tahunAktif['id_tahun'],$kelas,$kd);

		foreach ($hasil as $minmax) {
			if (isset($minmax['min']) and $minmax['mapel_id'] == $mapel and $minmax['kelas_id'] == $kelas ) {
				$hasil_minmax ['mapel_id'] = $minmax['mapel_id'];
				$hasil_minmax ['kelas_id'] = $minmax['kelas_id'];
				$hasil_minmax ['tahun_id'] = $minmax['tahun_id'];

				$hasil_minmax ['min'] = $minmax['min'];
			}
			if (isset($minmax['max']) and $minmax['mapel_id'] == $mapel and $minmax['kelas_id'] ==  $kelas ) {
				$hasil_minmax ['max'] = $minmax['max'];
			}
			
		}
		// var_dump($hasil);
		// var_dump($hasil_minmax);
		return $hasil_minmax;
		
	}

	public function hitungPredikat($nilai=85, $kkm =75)
	{
		$interval = (100 - $kkm)/3;
		$kkm_intv[0] = intval($kkm);

		for ($intv=1; $intv < 4; $intv++) { 
			$kkm = $kkm + $interval;
			$kkm_intv [$intv] = intval($kkm)  ;
		}
		// var_dump($kkm_intv);
		// echo '<hr>';

		switch (true) {
			
			case  $nilai < $kkm_intv[0]:
				$predikat[] = "D";
				$predikat[] = "Kurang ";
			break;

			case  $nilai < $kkm_intv[1]:
				$predikat[] = "C";
				$predikat[] = "Cukup ";
			break;

			case  $nilai < $kkm_intv[2]:
				$predikat[] = "B";
				$predikat[] = "Baik ";
			break;
			
			default:
				$predikat[] = "A";
				$predikat[] = "Sangat Baik ";
				break;
		}
		// var_dump($predikat);
		return $predikat;
	}
	
	public function desBaru($nilai, $kkm, $santri, $kelas, $mapel, $jenis_kd)
	{
		// $kkm = 70;
		// $nilai = 80;
		// $santri = 414;
		// $kelas = 2 ;
		// $mapel = 8;
		// $jenis_kd= 'p';

		$rombel = $this->um->showRombel($kelas)['rombel'];
		
		$tahun = $this->tahunAktif['id_tahun'];

		$nilai_nh = $this->rm->minmaxKd($tahun, $mapel, $santri);

		for ($i=0; $i <count($nilai_nh); $i++) {

			if ($jenis_kd == 'p') {
				$kd[$i+1] = intval($nilai_nh[$i]["nilai_kdp"]);
			}else{
				$kd[$i+1] = intval($nilai_nh[$i]["nilai_kdk"]);
			}
		}

		//mencari yang terkecil dan terbesar nilai array
		$min_kd = array_keys($kd,min($kd));
		$max_kd = array_keys($kd,max($kd));


		//memilih nilai KD dari yang terendah/teringgi
		$min_terpilih = $min_kd[0];
		$max_terpilih = $max_kd[count($max_kd)-1];


		//mengambil desrkiprsi sesua kd yang terpilih
		$deskrip ['min'] = [
			'pre' => $this->hitungPredikat(min($kd),$kkm)[1],
			'desk' => strtolower($this->rm->pilihDeskripsiKD($tahun, $mapel, $rombel, $min_terpilih, $jenis_kd)["kd$jenis_kd"]),
		];
		$deskrip ['max'] = [
			'pre'=>$this->hitungPredikat($nilai,$kkm)[1],
			'desk'=>strtolower($this->rm->pilihDeskripsiKD($tahun, $mapel, $rombel, $max_terpilih, $jenis_kd)["kd$jenis_kd"]),
		];

		if ($deskrip['max']['pre'] == $deskrip['min']['pre']) {
			$hasil = $deskrip['max']['pre'].'dalam hal '.$deskrip['max']['desk'].', dan dalam hal '.$deskrip['min']['desk'];
		}else{
			$hasil = $deskrip['max']['pre'].'dalam hal '.$deskrip['max']['desk'].', dan '.$deskrip['min']['pre'].'dalam hal '.$deskrip['min']['desk'];
		}

		// echo $hasil;
		return $hasil;
	}

	public function tampilPredikat($santri, $kelas, $mapel, $jenis_kd)
	{
		$rombel = $this->um->showRombel($kelas)['rombel'];

		/*$santri = 418;*/
		$tahun = $this->tahunAktif['id_tahun'];
/*		$mapel = 17;
		$jenis_kd='k';
		$kelas = 1;*/

		$nilai_nh = $this->rm->minmaxKd($tahun, $mapel, $santri);

		for ($i=0; $i <count($nilai_nh); $i++) {

			if ($jenis_kd == 'p') {
				$kd[$i+1] = intval($nilai_nh[$i]["nilai_kdp"]);
			}else{
				$kd[$i+1] = intval($nilai_nh[$i]["nilai_kdk"]);
			}
		}

		//mencari yang terkecil dan terbesar nilai array
		$min_kd = array_keys($kd,min($kd));
		$max_kd = array_keys($kd,max($kd));

		//memilih nilai KD dari yang terendah/teringgi
		$min_terpilih = $min_kd[0];
		$max_terpilih = $max_kd[count($max_kd)-1];

		//mengambil desrkiprsi sesua kd yang terpilih
		$deskrip ['min'] = [
			'pre' => $this->hitungPredikat(min($kd),75)[1],
			'desk' => strtolower($this->rm->pilihDeskripsiKD($tahun, $mapel, $rombel, $min_terpilih, $jenis_kd)["kd$jenis_kd"]),
		];
		$deskrip ['max'] = [
			'pre'=>$this->hitungPredikat(max($kd),75)[1],
			'desk'=>strtolower($this->rm->pilihDeskripsiKD($tahun, $mapel, $rombel, $max_terpilih, $jenis_kd)["kd$jenis_kd"]),
		];

		// var_dump($deskrip);

		if ($deskrip['max']['pre'] == $deskrip['min']['pre']) {
			$hasil = $deskrip['max']['pre'].'dalam hal '.$deskrip['max']['desk'].', dan dalam hal '.$deskrip['min']['desk'];
		}else{
			$hasil = $deskrip['max']['pre'].'dalam hal '.$deskrip['max']['desk'].', dan '.$deskrip['min']['pre'].'dalam hal '.$deskrip['min']['desk'];
		}

		// echo $hasil;
		return $hasil;
	}

	public function konfersi($kelas)
	{
		$jenjang = $this->rm->jenjangKelas($kelas);
		$rombel = $this->um->showRombel($kelas)['rombel'];
		$mapel = $this->rm->showMapel($jenjang,$rombel);

		
		//Menetukan target mapel yang akan dikantrol
		foreach ($mapel as $mp) {

			$kkm = $this->rm->kkm($rombel, $mp['mapel_id'], $this->tahunAktif['id_tahun']);

			if ($kkm == null) {
				$kkm = 75;
			}

			$peng_terkecil = $this->minmax($kelas, $mp['mapel_id'], 'p')['min'];
			$kete_terkecil = $this->minmax($kelas, $mp['mapel_id'], 'k')['min'];

			$peng_terbesar = $this->minmax($kelas, $mp['mapel_id'], 'p')['max'];
			$kete_terbesar = $this->minmax($kelas, $mp['mapel_id'], 'k')['max'];
			
			$target_max_p = $peng_terbesar < 85 ? 85 : $peng_terbesar;
			$target_max_k = $kete_terbesar < 85 ? 85 : $kete_terbesar;


			if ($peng_terkecil < $kkm) { //jika nilai PENGETAHUAN kurang dari kkm
				
				$target_siswa = $this->rm->ambilSiswaBawahKkm($kelas, $mp['mapel_id'], $this->tahunAktif['id_tahun']);
				foreach ($target_siswa as $ts) { //ekeskusi setiap siswa
					$id = $ts['id_dkn_raport'];
					$nilai_p = $ts['p'];
					$nilai_p_kantrol = $kkm + (( $ts['p'] - $peng_terkecil)/($peng_terbesar-$peng_terkecil)*($target_max_p-$kkm)) ;

					$data = ['p'=>round($nilai_p_kantrol,0)];

					 // var_dump($data);

					$this->db->update('t_dkn_raport', $data, ['id_dkn_raport'=>$id]);
				}
			}

			if ($kete_terkecil < $kkm) { //jika nilai KETERAMPILAN kurang dari kkm
				
				$target_siswa = $this->rm->ambilSiswaBawahKkm($kelas, $mp['mapel_id'], $this->tahunAktif['id_tahun']);
				foreach ($target_siswa as $ts) { //ekeskusi setiap siswa
					$id = $ts['id_dkn_raport'];
					$nilai_p = $ts['k'];
					$nilai_k_kantrol = $kkm + (( $ts['k'] - $kete_terkecil)/($kete_terbesar-$kete_terkecil)*($target_max_k-$kkm)) ;

					$data = ['k'=>round($nilai_k_kantrol,0)];

					 // var_dump($data);

					$this->db->update('t_dkn_raport', $data, ['id_dkn_raport'=>$id]);
				}
			}
		
		}
	}

	public function siapkanNilai($kelas){

		$jenjang = $this->rm->jenjangKelas($kelas);


		$santri = $this->rm->anggotaKelas($kelas,$this->tahunAktif['id_tahun']);
		$dkn = $this->rm->dknRaport($kelas,$this->tahunAktif['id_tahun'],$jenjang);

		foreach ($santri as $sa) {

			$dkn_list[$sa['santri_id']] = [
				'santri_id'=> $sa['santri_id'],
				'nama_santri'=> $this->um->showNamaSantri($sa['santri_id'])['nama_santri'],
				'induk_umum'=> $this->um->showNamaSantri($sa['santri_id'])['idk_umum'],
				'nilai'=> []
			]; 

			foreach ($dkn as $dk) {
				if ($sa['santri_id'] == $dk['santri_id']) {
					$var[$dk['mapel_id']] = [
						'mapel_id'=>$dk['mapel_id'],
						'nama_mapel'=>$this->um->showNamaMapel($dk['mapel_id'])['mapel_alias'],
						'p'=>$dk['p'],
						'k'=>$dk['k']
					];
					$dkn_list[$sa['santri_id']]['nilai'] = $var;
				}
			}
		}
		return $dkn_list;
	}

	public function showDknRaport($kls=null)
	{
		$jenjang = $this->rm->jenjangKelas($kls);
		$rombel = $this->um->showRombel($kls)['rombel'];

		if (!isset($kls) and !isset($jenjang)) {
			$data_id = $this->session->flashdata('pesan');

			$kls = $data_id[0];
			$jenjang = $data_id[1];
		}

		$this->konfersi($kls, $jenjang);


		$data['judul'] = 'Daftar Nilai Kolektif (DKN)';

		$data['kls'] = $kls;
		$data['rombel'] = $this->um->showRombel($kls)['rombel'];
		$data['tahun'] =  $this->tahunAktif['id_tahun'];

		$data['dkn'] = $this->siapkanNilai($kls,$jenjang);
		$data['mapel'] = $this->rm->showMapel($jenjang,$rombel);

		$this->load->view('templates/header', $data);
		$this->load->view('raport/dkn_fix', $data);
		$this->load->view('templates/footer');
	}

	public function InsertDknRaport($kelas) //nilai raport umum 
	{
		$jenjang = $this->rm->jenjangKelas($kelas);
		$rombel = $this->um->showRombel($kelas)['rombel'];

		$dkn = $this->nilai($kelas, $jenjang);
		$data['mapel'] = $this->rm->showMapel($jenjang, $rombel);
		$data['judul'] = 'Daftar Nilai Kolektif';
		$kelas =  $this->uri->segment(3);


		foreach ($dkn as $k => $dk) {
			foreach ($dk['mapel'] as $km => $mp) {
				if (isset($dk['mapel'][$km]['p']) and isset($dk['mapel'][$km]['k'])) {
					$dkn_raport[]=[
						'santri_id' => $dk['id_santri'],
						'mapel_id' => $dk['mapel'][$km]['mapel_id'],
						'kelas_id' => $kelas,
						'tahun_id' => $this->tahunAktif['id_tahun'],
						'p' => $dk['mapel'][$km]['p'],
						'k' => $dk['mapel'][$km]['k']
					];
				}else{
					$dkn_raport[]=[
						'santri_id' => $dk['id_santri'],
						'mapel_id' => $dk['mapel'][$km]['mapel_id'],
						'kelas_id' => $kelas,
						'tahun_id' => $this->tahunAktif['id_tahun'],
						'p' => null,
						'k' => null
					];
				}
			}
		}

		foreach ($dkn_raport as $dk) {
			$dk['id_dkn_raport'] = $dk['santri_id'].$dk['mapel_id'].$dk['tahun_id']; 
			// var_dump($dk);
			$this->db->replace('t_dkn_raport', $dk);
			$insert = $this->db->affected_rows();
		}

		$this->session->set_flashdata('pesan', [$kelas,$jenjang]);
		redirect('raport/showDknRaport/'.$kelas,'refresh');
	}

	public function nilai($kelas)
	{
		$jenjang = $this->rm->jenjangKelas($kelas);
		$rombel = $this->um->showRombel($kelas)['rombel'];

		$santri = $this->rm->anggotaKelas($kelas,$this->tahunAktif['id_tahun']);
		$mapel = $this->rm->showMapel($jenjang,$rombel);

		$pengetahuan = $this->rm->nilai($this->tahunAktif['id_tahun'], $kelas, $jenjang,'kdp');
		$keterampilan = $this->rm->nilai($this->tahunAktif['id_tahun'], $kelas, $jenjang,'kdk');
		$ujian =  $this->rm->nilaiUjian($this->tahunAktif['id_tahun'], $kelas, $jenjang);
		
		//mengabung ujian + pengetahuan
		foreach ($ujian as $uj) {
			foreach ($pengetahuan as $pg) {
				if ( ($uj['mapel_id'] == $pg['mapel_id'] && ($uj['santri_id'] == $pg['santri_id'])) ) {
					$total_pengetahuan[] = [
						'santri_id' => $uj['santri_id'], 
						'mapel_id' => $uj['mapel_id'],
						'total_kdp'=> ($uj['nkh'] + $uj['pts'] + $uj['pas'] + $pg['rata_kdp']) / 4
					];
				}
			}
		}
		

		//membuat Array DKN TABLE
		foreach ($santri as $sa) {
			$dkn_list[$sa['santri_id']]=[
				'id_santri' => $sa['santri_id'],
				'nama_santri' => $this->um->showNamaSantri($sa['santri_id'])['nama_santri'],
				'mapel'=>[]
			];
			
			foreach ($mapel as $mp) {
				$var=[
					'mapel_id'=>$mp['mapel_id']
				];
				$dkn_list [$sa['santri_id']]['mapel'][$mp['mapel_id']] =  $var;

				foreach ($keterampilan as $kt) {
					if ( ($kt['mapel_id'] == $mp['mapel_id']) && ($kt['santri_id'] == $sa['santri_id']) ) {
						$dkn_list [$sa['santri_id']]['mapel'][$mp['mapel_id']]['k'] = round($kt['rata_kdk'],0) > 1 ? round($kt['rata_kdk'],0) : null;
					}
				}
				foreach ($total_pengetahuan as $pg) {
					if ( ($pg['mapel_id'] == $mp['mapel_id']) &&  ($pg['santri_id'] == $sa['santri_id']) ) {
						$dkn_list [$sa['santri_id']]['mapel'][$mp['mapel_id']]['p'] = round($pg['total_kdp'],0) > 1 ? round($pg['total_kdp'],0) : null;
					}
				}

			}

		}
		
		return $dkn_list; 
	}

	public function DeskSikap($santri)
	{
		$q = $this->rm->deskripSikap($santri, $this->tahunAktif['id_tahun']);

		$suluk = $q[0]['suluk'];
		$spirit = $q[1][1]['suluk'];
		$sosial = $q[1][0]['suluk'];

		$nilai_spirit =  ($spirit + $suluk )/2;
		$nilai_sosial =  ($sosial + $suluk )/2;


		$des['spirit'] = [
			'dalam melakukan kegiatan berdoa, menjalan ibadah, memberi salam, dan baik dalam hal menunjukkan sikap bersyukur, tawakal, menjaga hubungan baik dan menghormati orang lain.',
			'dalam melakukan kegiatan berdoa, menjalan ibadah, memberi salam, dan cukup dalam hal menunjukkan sikap bersyukr, tawakal, menjaga hubungan baik dan menghormati orang lain.'
		];

		$des['sosial'] = [
			'dalam menunjukkan sikap jujur, disiplin, tanggung jawab, sopan santun, dan percaya diri.',
			'dalam menunjukkan sikap jujur, disiplin, tanggung jawab, dan cukup dalam hal sopan santun, dan percaya diri.'
		];

		if ($nilai_spirit > 84) {
			$sikap_spirit = [
				'nilai'=> $nilai_spirit,
				'predikat'=>$this->hitungPredikat($nilai_spirit),
				'des'=>$this->hitungPredikat($nilai_spirit)[1].$des['spirit'][0]
			];
		}else{
			$sikap_spirit = [
				'nilai'=> $nilai_spirit,
				'predikat'=>$this->hitungPredikat($nilai_spirit),
				'des'=>$this->hitungPredikat($nilai_spirit)[1].$des['spirit'][1]
			];
		}

		if ($nilai_sosial > 84) {
			$sikap_sosial = [
				'nilai'=> $nilai_sosial,
				'predikat'=>$this->hitungPredikat($nilai_sosial),
				'des'=>$this->hitungPredikat($nilai_sosial)[1].$des['sosial'][0]
			];
		}else{
			$sikap_sosial = [
				'nilai'=> $nilai_sosial,
				'predikat'=>$this->hitungPredikat($nilai_sosial),
				'des'=>$this->hitungPredikat($nilai_sosial)[1].$des['sosial'][1]
			];
		}

		$data = [$sikap_spirit, $sikap_sosial];
		
		return $data;
	}

	public function extra($santri)
	{
		$jenjang = $this->rm->showJenjang($santri, $this->tahunAktif['id_tahun']);

		$nilai_sorasi = $this->rm->nilaiExtra($santri, $this->tahunAktif['id_tahun'],$jenjang ); //sorogan/literasi
		$nilai_wali = $this->rm->nilaiWali($santri, $this->tahunAktif['id_tahun'] ); 
		$nilai_wali ['sorasi'] =  $this->puluhanSatuan($nilai_sorasi['nrp'])[0];


		$des = [
			1=>['A','Sangat aktif dalam setiap kegiatan dan meraih prestasi dalam kegiatan'],
			2=>['B','Sangat aktif dalam kegiatan'],
			3=>['C','Aktif dalam kegiatan'],
			4=>['D','Kurang aktif dalam kegiatan'],
		];

		$jenjang == 'smp' ? $sorasi = 'Jurnalistik': $sorasi = 'Baca Kitab';

		$nilai_wali ['des_ismi']=  $des[$nilai_wali['ismi']][0];
		$nilai_wali ['des_pramuka']= $des[$nilai_wali['pramuka']][0];
		$nilai_wali ['des_tahfid']=  $des[$nilai_wali['tahfid']][0];
		$nilai_wali ['des_sorasi']= $des[$nilai_wali['sorasi']][0];

		$nilai_wali ['predikat_ismi']=  $des[$nilai_wali['ismi']][1].' OSIS/ISMII';
		$nilai_wali ['predikat_pramuka']= $des[$nilai_wali['pramuka']][1].' Pramuka ';
		$nilai_wali ['predikat_tahfid']=  $des[$nilai_wali['tahfid']][1].' Tahfidzul Qur\'an' ;
		$nilai_wali ['predikat_sorasi']= $des[$nilai_wali['sorasi']][1].' '.$sorasi ;
		
		return $nilai_wali;
	}

	public function puluhanSatuan($nilai)
	{
		switch (true) {
			
			case  $nilai < 61 :
				$predikat[] = "4";
				$predikat[] = "Kurang ";
			break;

			case  $nilai < 71:
				$predikat[] = "3";
				$predikat[] = "Cukup ";
			break;

			case  $nilai < 81:
				$predikat[] = "2";
				$predikat[] = "Baik ";
			break;
			
			default:
				$predikat[] = "1";
				$predikat[] = "Sangat Baik ";
				break;
		}

		return $predikat;
	}
	
	public function identitas($santri_id)
	{
		$data['judul'] = 'Halaman identitas';

		$data['kol'] = [
			'Nama Santri (lengkap)',
			'Nomor Induk / NIK',
			'Tempat / Tanggal Lahir',
			'Jenis Kelamin',
			'Agama',
			'Anak ke',
			'Status dalam Keluarga',
			'Alamat Peserta Didik',
			'a. Telpon / HP',
			'Diterima di Ma\'had ini',
			'a. Di Kelas',
			'b. Pada Tanggal',
			'c. Semester ',
			'Sekolah Asal',
			'a. Nama Sekolah ',
			'b. Alamat',
			'Ijasah SD/MI SMP/MTs',
			'Tahun',
			'Nomor',
			'SKHU SD/MI SMP/MTs',
			'Tahun',
			'Nomor',
			'Nama Orang Tua ',
			'a. Nama Ayah',
			'b. Nama Ibu',
			'Alamat Orang Tua',
			'a. Telpon/HP',
			'Pekerjaan Orang Tua',
			'a. Ayah',
			'b. Ibu',
			// 'Nama Wali',
			// 'a. Alamat wali',
			// 'b. Telpon/HP',
			// 'Pekerjaan Wali'
		];

		$idt = $this->rm->identitas($santri_id);

		foreach ($idt as $i) {
			$urut = 1;
			foreach ($i as $v) {
				$detail [$urut++] = $v;
			}
		}

		if (isset($detail)) {
			$data ['detail']= $detail;
		}else{
			$data ['detail']= null;
		}


		$kelas = $this->db->get_where('t_agtkelas', [
			'santri_id' => $santri_id,
			'tahun_id' => $this->tahunAktif['id_tahun']
		])->row_array()['kelas_id'];

		$jt = $this->rm->jenjangTratri($kelas);

		if ($jt['jenjang'] < 2) {
			$data['jenjang'] = 'Sekolah';
			$data['kepala'] = 'Mudhar, S.Pd.';
			$data['niy'] = '940613051';
		}else{
			$data['jenjang'] = 'Madrasah';
			$data['kepala'] = 'Mughni Musa, Lc., M.Ag.';
			$data['niy'] = '940613009';

		}

		if ($jt['tra_tri'] == 'tri') {
			$data['jenis'] = 'Perempuan';
		}else{
			$data['jenis'] = 'Laki-laki';
		}

		$data['tanggal'] = $this->um->tmkbm(6)['tmkbm'];

		// $this->load->view('templates/header', $data);
		$this->load->view('raport/identitas', $data);
		// $this->load->view('templates/footer');
	}


}

/* End of file Raport.php */
/* Location: ./application/controllers/Raport.php */