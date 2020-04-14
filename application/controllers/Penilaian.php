<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
		$this->load->model('Kelas_model','km');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$this->dashboard();
	}

	public function na()
	{
		is_ngajar();

		$data['judul'] = 'Nilai Akhir';
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['id_kelas'] = $this->uri->segment(5);
		$data['id_mapel'] = $this->uri->segment(4);
		$data['santri'] = $this->um->santriKelas($data['id_kelas'], $data['id_tahun']);

		//ambil nilai kkm dari tabel kd
		$this->db->select('kkm');
		$this->db->where('kelas_id', $data['id_kelas']);
		$this->db->where('mapel_id', $data['id_mapel']);
		$this->db->where('tahun_id', $data['id_tahun']);
		$data['kkm'] = $this->db->get('t_kd')->row_array();
		$data['kkm'] ? $data['kkm'] : $data['kkm'] = ['kkm' => '0'];

		//menghitung dan mecacah nilai harian 
		foreach ($data['santri'] as $santri) {
			 $data_nhr = $this->um->hitungHhr($data['id_tahun'], $data['id_kelas'], $data['id_mapel'], $santri['id_santri']);
			 $nhr[$santri["id_santri"]] = round($data_nhr['nhr'],0);
		}
		$data['nhr'] = $nhr;

		//mengambil data jika sudah ada terinput
		$data['na'] = null;
		$data_na = $this->um->ambilNilaiAkhir($data['id_tahun'], $data['id_kelas'], $data['id_mapel']);
			if ($data_na) {
			foreach ($data_na as $d) {
				$na [$d['santri_id']] = [
					'nkh' => $d["nkh"],
					'nhr' => $d["nhr"],
					'pts' => $d["pts"],
					'pas' => $d["pas"],
					'nrp' => round(($d["nkh"] + $d["nhr"] + $d["pts"] + $d["pas"])/4,0)
				];
			}
			$data['na'] = $na;
		}
		
		//var_dump($data['na']);die();
		
		//mencari nama kelas
		$this->db->select('nama_kelas');
		$this->db->where('id_kelas', $data['id_kelas']);
		$nama_kelas = $this->db->get('m_kelas')->row_array();

		//mencari nama mapel
		$this->db->select('nama_mapel');
		$this->db->where('id_mapel', $data['id_mapel']);
		$nama_mapel = $this->db->get('m_mapel')->row_array();

		$data['atribut'] = [
			'nama_kelas' => $nama_kelas['nama_kelas'],
			'nama_mapel' => $nama_mapel['nama_mapel']
		];


		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/na', $data);
		$this->load->view('templates/footer');
	}

	public function uamii_form($id_mapel)
	{

		$data['judul'] = 'Nilai UAMII';
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['santri'] = $this->km->santriIjz($data['id_tahun']);
		$data['mapel'] = $this->um->listMapelIjz($id_mapel);
		$data['nilai_raport'] = $this->db->get_where('t_nilai_ijz', ['mapel_id'=>$id_mapel, 'tahun_id'=>$data['id_tahun'] ])->result_array();

		var_dump($id_mapel);
		var_dump($data['id_tahun']);
		var_dump($data['nilai_raport']);die();
	
		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/uamii_form', $data);
		$this->load->view('templates/footer');
	}

	public function uamii_simpan()
	{
		$daput = $this->input->post(null,true);

		
		$id_tahun = $daput['id-tahun-0'];
		$id_mapel = $daput['id-mapel-0'];

		foreach ($daput as $dp => $val) {
			$cacah = explode('-', $dp);
			if ($cacah[0] != 'id') {
				$arrayc[] =  $cacah[1];
			}
		}

		$santri_id = (array_unique($arrayc));

		foreach ($santri_id as $santri) {

			if ($daput["uamii-$santri"] < 1) {
				$uamii = null;
			}else {
				$uamii = $daput["uamii-$santri"];
			}

			if ($daput["ijazah-$santri"] < 1){
				$ijz=null;
			}else{
				$ijz = $daput["ijazah-$santri"];
			} 

			if ($daput["suluk-$santri"] < 1) {
				$slk = null;
			}else{
				$slk = $daput["suluk-$santri"];
			}

			$object_update=[
    					'uamii' => $uamii,
    					'ijz' => $ijz,
    					'slk' => $slk
    				];
    				
    				$this->db->where('tahun_id', $id_tahun);
    				$this->db->where('mapel_id', $id_mapel);
    				$this->db->where('santri_id', $santri);
    				$affect_update = $this->db->update('t_nilai_ijz', $object_update);
		}

		
			redirect('penilaian/uamii_form/'.$id_mapel,'refresh');
		


	}

	public function uamii() //rekap nilai uamii
	{
		//is_boleh();

		$data['judul'] = 'Nilai UAMII';
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['mapel'] = $this->um->listMapelIjz();
		$data['santri'] = $this->km->santriIjz($data['id_tahun']);
		$data['suluk'] = $this->km->sulukIjz();

	
		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/uamii_nilai', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_na()
	{
		$daput = $this->input->post(null,true);

		
		$id_tahun = $daput['id_tahun-0'];
		$id_kelas = $daput['id_kelas-0'];
		$id_mapel = $daput['id_mapel-0'];

		foreach ($daput as $dp => $val) {
			$cacah = explode('-', $dp);
			if ($cacah[0] != 'id') {
		
				$arrayc[] =  $cacah[1];
				
			}
		}

		$santri_id = (array_unique($arrayc));


		$affect_insert = null;
		$affect_update = null;


		foreach ($santri_id as $santri) { 
		    
		    $key = 'nkh-'.$santri;
            if ( array_key_exists($key,$daput) ){
			
    			$nilai_akhir = $this->um->cekNilaiAkhir($id_tahun, $id_kelas, $id_mapel, $santri);
    			
    			if ($nilai_akhir == null) {
    				//do insert
    				$object_insert=[
    					'tahun_id' => $id_tahun,
    					'kelas_id' => $id_kelas,
    					'mapel_id' => $id_mapel,
    					'santri_id' => $santri,
    					'nkh' => $daput["nkh-$santri"],
    					'nhr' => $daput["nhr-$santri"],
    					'pts' => $daput["pts-$santri"],
    					'pas' => $daput["pas-$santri"],
    					'nrp' => $daput["nrp-$santri"]
    				];
    				// echo "<br>";
    				// var_dump($object_insert);
    				$affect_insert = $this->db->insert('t_na', $object_insert);
    				
    			}else{
    				//do update
    				$object_update=[
    					'nkh' => $daput["nkh-$santri"],
    					'nhr' => $daput["nhr-$santri"],
    					'pts' => $daput["pts-$santri"],
    					'pas' => $daput["pas-$santri"],
    					'nrp' => $daput["nrp-$santri"]
    				];
    				// echo "<br>";
    				// var_dump($object_update);
    				// echo 'nilai-akhir'. $nilai_akhir['id_na'].'<-<br>';
    				$this->db->where('id_na', $nilai_akhir['id_na']);
    				$affect_update = $this->db->update('t_na', $object_update);
    			}
    		}
		}
		if ($affect_insert > 0 ) {
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>ditambahkan</strong>.</p>
				</div><br>
    		</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-warning alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>diubah</strong>.</p>
				</div><br>
    		</div>');
		}
		redirect('penilaian','refresh');
	}


	public function nh()
	{
		is_ngajar();

		$data['judul'] = 'Nilai Harian';
		$data['id_guru'] = $this->uri->segment(3);
		$data['id_mapel'] = $this->uri->segment(4);
		$data ['id_kelas'] = $this->uri->segment(5);
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$rombel = $this->um->showRombel($data['id_kelas'])['rombel'];

		$data['mapel'] = $this->db->get_where('m_mapel',['id_mapel' => $data['id_mapel']])->row_array();
		$data['kelas'] = $this->db->get_where('m_kelas',['id_kelas' => $data ['id_kelas']])->row_array();
		
		$data['jml_kd'] = $this->um->kdOke($data['id_mapel'],$rombel ,$data['id_tahun']);
		$data['santri'] = $this->um->santriKelas($data ['id_kelas'], $data['id_tahun']);
		$data['nilai_kd'] = $this->um->nilaiKd($data['id_mapel'], $data ['id_kelas'], $data['id_tahun']);

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/nh', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_nh()
	{
		$data_input = $this->input->post(null,true);

		$tahun_id = $data_input['id-tahun'];
		$mapel_id = $data_input['id-mapel'];
		$kelas_id = $data_input['id-kelas'];
		
		$rombel = $this->um->showRombel($kelas_id)['rombel'];
		$kd = $this->um->kdOke($mapel_id, $rombel, $tahun_id); //menghitung jumlah KD tersimpan

		foreach ($data_input as $daput => $value) {
			$cacah = explode('-', $daput);
			if ($cacah[0] != 'id') {
		
				$arrayc[] =  $cacah[1];
				
			}
		}

		$santri_id = (array_unique($arrayc));

		$affect_insert = null;
		$affect_update = null;
		
		foreach ($santri_id as $santri) {
			for ($i=1; $i <= $kd ; $i++) {

				// cekk apakah update atau insert; param: tahun/kelas/mapel/santri/urutan
	    		$adaNilaiKd = $this->um->cekNilaiKd($tahun_id, $kelas_id, $mapel_id, $santri, $i);

	    		if ($adaNilaiKd > 0) {
	    		
		    		$object_update = [
						'nilai_kdp' => $data_input['kdp-'.$santri.'-'.$i],
						'nilai_kdk' => $data_input['kdk-'.$santri.'-'.$i],
						'nilai_suluk' => $data_input['slk-'.$santri]
					];
	   
					$this->db->where('id_nh', $adaNilaiKd['id_nh']);
					$affect_update = $this->db->update('t_nh', $object_update);

	    		}else{
					$object_insert = [
						'mapel_id' => $mapel_id,
						'kelas_id' => $kelas_id,
						'santri_id' => $santri,
						'tahun_id' => $tahun_id,
						'urut_kd' => $i,
						'nilai_kdp' => $data_input['kdp-'.$santri.'-'.$i],
						'nilai_kdk' => $data_input['kdk-'.$santri.'-'.$i],
						'nilai_suluk' => $data_input['slk-'.$santri]
					];

					$affect_insert = $this->db->insert('t_nh', $object_insert);
	    		}
			}
		}

		if ($affect_insert > 0 ) {
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>ditambahkan</strong>.</p>
				</div><br>
    		</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-warning alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>diubah</strong>.</p>
				</div><br>
    		</div>');
		}
		redirect('penilaian','refresh');

	}
	

	public function kd()
	{

		$data['judul'] = 'Kompetensi Dasar';
		
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['id_mapel'] = $this->uri->segment(4);
		$data['id_kelas'] = $this->uri->segment(5);
		$data['rombel'] = $this->db->get_where('m_kelas', ['id_kelas' => $data['id_kelas']] )->row_array()['rombel'];

		$jml_kd = $this->um->kdTersedia2($data['id_mapel'],$data['rombel'],$data['id_tahun'])->num_rows();
		$data['jml_kd'] = $jml_kd;
		
		//mencari nama kelas
		$this->db->select('nama_kelas');
		$this->db->where('id_kelas', $data['id_kelas']);
		$nama_kelas = $this->db->get('m_kelas')->row_array();

		//mencari nama mapel
		$this->db->select('mapel_alias');
		$this->db->where('id_mapel', $data['id_mapel']);
		$nama_mapel = $this->db->get('m_mapel')->row_array();

		$data['atribut'] = [
			'nama_kelas' => $nama_kelas['nama_kelas'],
			'mapel_alias' => $nama_mapel['mapel_alias']
		];

		if ($jml_kd) {
			$data['kd'] = $this->um->kdTersedia2($data['id_mapel'],$data['rombel'],$data['id_tahun'])->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('penilaian/kd', $data);
			$this->load->view('templates/footer');

		} else {

			$this->load->view('templates/header', $data);
			$this->load->view('penilaian/kd',$data);
			$this->load->view('templates/footer');
		 
		}
		
		
	}

	function tambah_kd()
	{
		$data_input = $this->input->post();
		$jumlahData = (count($data_input)-3)/3;

		// var_dump($data_input);die();
		
		for ($i=1; $i<=$jumlahData; $i++ ){
			$object=[
				'tahun_id' => $data_input['tahun_id'],
				'kelas_id' => $data_input['kelas_id'],
				'rombel' => $data_input['rombel'],
				'mapel_id' => $data_input['mapel_id'],
				'kdp' => $data_input['kdp'.$i],
				'kdk' => $data_input['kdk'.$i],
				'urut' => $data_input['urut'.$i],
				'kkm' => $data_input['kkm']
			];

			$ada = $this->um->cariDoubleKd($object['mapel_id'],$object['rombel'],$object['urut'],$this->tahunAktif['id_tahun']);

			if($ada){
				$dUpdate=[
					'kdp' => $data_input['kdp'.$i],
					'kdk' => $data_input['kdk'.$i],
					'kkm' => $data_input['kkm'],
				];
								
				$this->db->where('urut', $object['urut']);
				$this->db->where('mapel_id', $object['mapel_id']);
				$this->db->where('rombel', $object['rombel']);
				$this->db->update('t_kd', $dUpdate);

				$this->session->set_flashdata('pesan', '<div class="col-lg-12">
		    		<div class="col-md-6 mt-4 py-1 alert alert-warning alert-dismissible elevation-2">
				  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>diubah</strong>.</p>
					</div><br>
	    		</div>');
			}else{
				
				$this->db->insert('t_kd', $object);
				
				$this->session->set_flashdata('pesan', '<div class="col-lg-12">
		    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
				  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>ditambahkan</strong>.</p>
					</div><br>
	    		</div>');
			}

			if ($data_input['kdp'.$i] == 'hapus' and $data_input['urut'.$i] >= 3 ) {
				$this->db->where('urut', $object['urut']);
				$this->db->where('mapel_id', $object['mapel_id']);
				$this->db->where('kelas_id', $object['kelas_id']);
				$this->db->delete('t_kd');
			}
			
		}
		redirect('penilaian/dashboard');
	}

	function dashboard()
	{
		$data['judul'] = 'Dashboard Penilaian';
		$data['tahunAktif'] = $this->tahunAktif['id_tahun']; //tahun aktif ajaran saat ini.

		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$data['mapel'] = $this->um->ngajarApa($nohp,$data['tahunAktif']);


		if (count($data['mapel']) > 0){

			foreach ($data['mapel'] as $m) {
				$id_mp[] = $m['id_mapel'];
			}
			$data['id_mapel_unik'] = (array_unique($id_mp));

			$this->load->view('templates/header', $data);
			$this->load->view('penilaian/dashboard_nilai', $data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header', $data);
			$this->load->view('penilaian/dashboard_nilai_unactive', $data);
			$this->load->view('templates/footer');
		}

	}

	public function statusNilai()
	{
		$data['judul'] = 'Status Nilai';
		$filter_kelas = $this->cekwali()['kelas_id'];

		$data['sts_nilai'] = $this->um->cekEntryNilai($filter_kelas, $this->tahunAktif['id_tahun']);
		
		//var_dump($data['sts_nilai']);die();

		$asatid = $this->db->get('m_asatid')->result_array();
		foreach ($asatid as $a ) {
			$nama_asatid [$a['id_asatid']] = $a['nama_asatid'];
		}
		$data ['nama_asatid'] = $nama_asatid;

		$mapel = $this->db->get('m_mapel')->result_array();
		foreach ($mapel as $m ) {
			$nama_mapel [$m['id_mapel']] = $m['nama_mapel'];
		}
		$data ['nama_mapel'] = $nama_mapel;

		$kelas = $this->db->get('m_kelas')->result_array();
		foreach ($kelas as $k ) {
			$nama_kelas [$k['id_kelas']] = [$k['nama_kelas'],$k['kelas_alias']];
		}
		$data ['nama_kelas'] = $nama_kelas;

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/status_nilai', $data);
		$this->load->view('templates/footer');
	}

	public function cekwali()
	{
		$tahun_aktif = $this->tahunAktif['id_tahun'];
		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$id_asatid = $this->um->idAsatid($nohp)['id_asatid'];
		$data_wali = $this->um->adaIdWali($id_asatid,$tahun_aktif);
		return $data_wali;
	}


	public function legerKd()
	{
		$data['judul'] = 'Rekap KD';
		$filter_kelas = $this->cekwali()['kelas_id'];
		$data['id_kelas'] = $filter_kelas;
		$data['tahun_aktif'] = $this->tahunAktif['id_tahun'];
		$data['nama_kelas'] = $this->um->showNamaKelas($filter_kelas);

		$rule = $this->session->userdata('rule_id');

		$data['semua_kelas'] = null;

		if ($rule < 5) {
			$this->db->order_by('nama_kelas', 'asc');
			$data['semua_kelas'] = $this->db->get('m_kelas')->result_array();
		}
		
		$rombel = $this->um->showRombel($filter_kelas)['rombel'];

		$data['kd_perkelas'] = $this->um->legerKd($rombel,$data['tahun_aktif']);


		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/leger_kd', $data);
		$this->load->view('templates/footer');
	}

	public function kdAjax()
	{
		$filter_kelas = $this->input->post('id');
		$nama_kelas = $this->um->showNamaKelas($filter_kelas);
		
		$rombel = $this->um->showRombel($filter_kelas)['rombel'];

		$kd = $this->um->legerKd($rombel,$data['tahun_aktif']);

		$kd = $this->um->legerKd($filter_kelas);
		
		foreach ($kd as $k) {
			$id_asatid = $this->um->showPengajar($filter_kelas, $k['mapel_id'], $this->tahunAktif['id_tahun']);
			$pengajar = $this->um->showNamaAsatid($id_asatid)['nama_asatid'];
			$data [] = [
				 'nama_mapel' => $this->um->showNamaMapel($k['mapel_id'])['nama_mapel'],
				 'kdp' => $k['kdp'],
				 'kdk' => $k['kdk'],
				 'pengajar' => $pengajar
			];
		}
		// $data [1000] = ['nama_kelas'=> $nama_kelas] ;

		echo json_encode($data);
	}

	public function legerNilai(){
	    
	    ini_set("memory_limit","512M");
		
		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$id_asatid = $this->um->idAsatid($nohp)['id_asatid'];
		if ($id_asatid == 111 || $id_asatid == 2 || $id_asatid == 'M' || $id_asatid == 9) {
			$data['is_kepala'] = 1;
		}else{
			$data['is_kepala'] = 0;
		}



		$data['judul'] = 'Leger Nilai';
		$filter_kelas = $this->cekwali()['kelas_id'];
		if ($filter_kelas == null) {
			$filter_kelas = 1;
		}

		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['nama_kelas'] = $this->um->showNamaKelas($filter_kelas);
		$data['semua_kelas'] = $this->db->get('m_kelas')->result_array();
		$data['santri'] = $this->um->santriKelas($filter_kelas, $data['id_tahun']);
		$data['mapel_perkelas'] = $this->um->mapelPerkelas($filter_kelas,$data['id_tahun']);
		$data['nilai_perkelas'] = $this->um->nilaiPerkelas($filter_kelas,$data['id_tahun']);
		$suluk_perkelas = $this->um->sulukPersantriPerkelas($filter_kelas,$data['id_tahun']);



		// foreach ($nilai_perkelas as $target) {
		// 	$nilaiperkelas[] = [
		// 		'mapel_id' => $target['mapel_id'], 
		// 		'santri_id' =>$target['santri_id'],
		// 		'nilai' => $target['nrp'],
		// 		'tandd' => $target['nrp']<70 ? "-" : "+"
		// 	];
		// }
		// $data['nilai'] = $nilaiperkelas;

		foreach ($suluk_perkelas as $slk) {
			switch ( $slk['slk'] ) {
				case $slk['slk'] > 90 :
					$suluk_k = "A";
					break;
				case $slk['slk'] > 80 :
					$suluk_k = "B";
					break;
				case $slk['slk'] > 70 :
					$suluk_k = "C";
					break;
				case $slk['slk'] > 60 :
					$suluk_k = "D";
					break;
				default:
					$suluk_k = "E";
					break;
			}
			$nilai_suluk [ $slk['santri_id'] ] = $slk['slk'].'/'.$suluk_k;
		}

		$data['suluk'] = $nilai_suluk;

		$data['semua_kelas'] = null;

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/leger_nilai');
		$this->load->view('templates/footer');
	}

	public function LegerNilaiAll($filter_kelas){
		$data['judul'] = 'Leger Nilai';
		$data['id_kelas'] = $filter_kelas;
		$data['id_tahun'] = $this->tahunAktif['id_tahun'];
		$data['nama_kelas'] = $this->um->showNamaKelas($filter_kelas);
		$data['santri'] = $this->um->santriKelas($data ['id_kelas'], $data['id_tahun']);
		$data['mapel_perkelas'] = $this->um->mapelPerkelas($filter_kelas,$data['id_tahun']);
		$data['nilai_perkelas'] = $this->um->nilaiPerkelas($filter_kelas,$data['id_tahun']);
		$suluk_perkelas = $this->um->sulukPersantriPerkelas($filter_kelas,$data['id_tahun']);

		foreach ($suluk_perkelas as $slk) {

			switch ( $slk['slk'] ) {
				case $slk['slk'] > 90 :
					$suluk_k = "A";
					break;
				case $slk['slk'] > 80 :
					$suluk_k = "B";
					break;
				case $slk['slk'] > 70 :
					$suluk_k = "C";
					break;
				case $slk['slk'] > 60 :
					$suluk_k = "D";
					break;
				default:
					$suluk_k = "E";
					break;
			}

			$nilai_suluk [ $slk['santri_id'] ] = $slk['slk'].'/'.$suluk_k;
		}

		$data['suluk'] = $nilai_suluk;

		$data['semua_kelas'] = null;

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/leger_nilai_min', $data);
		$this->load->view('templates/footer');
	}

	public function raport()
	{
		$data['judul'] = 'Halaman Utama Raport';
		$filter_kelas = $this->cekwali()['kelas_id'];
		$data['id_kelas'] = $filter_kelas;
		$data['tahun_aktif'] = $this->tahunAktif['id_tahun'];
		$data['nama_kelas'] = $this->um->showNamaKelas($filter_kelas);
		$data['santri'] = $this->um->santriKelas($data ['id_kelas'], $data['tahun_aktif']);
		$sekolah = $this->db->get_where('m_kelas',['id_kelas' => $filter_kelas])->row_array();

		$jenjang = $this->um->showNamaKelas($filter_kelas)['jenjang'];
		$jenjang == 1 ? $data['jenjang'] = 'smp' : $data['jenjang'] = 'ma';
		$data['kls'] = $filter_kelas;
		
		if ($sekolah['jenjang'] == 1 ) {
			$data['raport_umum'] = 'SMP';
		}else if ($sekolah['jenjang'] == 2 ) {
			$data['raport_umum'] = 'MA';
		}else{
			$data['raport_umum'] = null;
		}

		// var_dump($sekolah['jenjang']);die();

		$rule = $this->session->userdata('rule_id');

		$data['semua_kelas'] = null;

		if ($rule == 1) {
			$this->db->order_by('nama_kelas', 'asc');
			$data['semua_kelas'] = $this->db->get('m_kelas')->result_array();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/home_raport', $data);
		$this->load->view('templates/footer');
	}

	public function cetakmii($id,$id_kelas)
	{

		$data['judul'] = "Raport - Ma'had Al Ittihad Al Islami";
		$tahun_id = $this->tahunAktif['id_tahun'];
		$na = $this->um->rapotMii($tahun_id,$id,$id_kelas);
		$filter_kelas = $this->cekwali()['kelas_id'];

		$data['at_wali'] = $this->um->showNamaWali($filter_kelas,$tahun_id)['nama_asatid'];
		
		$data['at_kelas'] = $this->um->showNamaKelas($na[0]["kelas_id"])['nama_kelas'];
		$data['at_santri'] = $this->um->showNamasantri($na[0]["santri_id"]);
		$data['at_tahun'] = $this->um->showNamatahun($na[0]["tahun_id"]);
		$data['suluk_k'] = $this->um->showSuluk($na[0]["kelas_id"],$na[0]["santri_id"],$na[0]["tahun_id"]);
		$data['tambahan'] = $this->um->dataTambahan($id,$tahun_id);
		// var_dump($data['tambahan']);die();

		$tahun_id = $na[0]["tahun_id"];

		$jumlah = [
			'nkh' => 0,
			'nhr' => 0,
			'pts' => 0,
			'pas' => 0,
			'nrp' => 0,
			'nrp' => 0,
			'rata2' => 0
		];

		$banyak = 0;

		foreach ($na as $na) {
			$nilai[$na['mapel_id']] = [
					'mapel' => $na['mapel_alias'],
					'mapel_ar' => $na['mapel_ar'],
					'nkh' => round($na['nkh'],0), 
					'nhr' => round($na['nhr'],0), 
					'pts' => round($na['pts'],0), 
					'pas' => round($na['pas'],0), 
					'nrp' => round( ($na['nkh']+$na['nhr']+$na['pts']+$na['pas'])/4 ,0),
					'id_kelas' => $na['kelas_id'],
					'rata2' => strlen(round($this->um->rataNrp($id_kelas, $na['mapel_id']),1)) < 4 ? round($this->um->rataNrp($id_kelas, $na['mapel_id']),1).'.0' : round($this->um->rataNrp($id_kelas, $na['mapel_id']),1)
			];

			$banyak = $banyak + 1;
			$jumlah = [
				'nkh' => $jumlah['nkh'] + $nilai[$na['mapel_id']]['nkh'],
				'nhr' => round($jumlah['nhr'] + $nilai[$na['mapel_id']]['nhr'],0),
				'pts' => $jumlah['pts'] + $nilai[$na['mapel_id']]['pts'],
				'pas' => $jumlah['pas'] + $nilai[$na['mapel_id']]['pas'],
				'nrp' => $jumlah['nrp'] + $nilai[$na['mapel_id']]['nrp'],
				'rata2' => $jumlah['rata2'] + $nilai[$na['mapel_id']]['rata2']
			];
		}


		$jumlah['rata_nkh'] = $jumlah['nkh'] / $banyak; 
		$jumlah['rata_nhr'] = $jumlah['nhr'] / $banyak; 
		$jumlah['rata_pts'] = $jumlah['pts'] / $banyak; 
		$jumlah['rata_pas'] = $jumlah['pas'] / $banyak; 
		$jumlah['rata_nrp'] = $jumlah['nrp'] / $banyak; 
		$jumlah['rata_total'] = ($jumlah['rata_nkh'] + $jumlah['rata_nhr'] + $jumlah['rata_pts'] + $jumlah['rata_pas'] + $jumlah['rata_nrp']) / 5; 		

		$data['nilai_mii'] = $nilai;
		$data['jumlah_mii'] = $jumlah;
		$data['ket'] = $this->naikKe($filter_kelas);
		$data['domir'] = $this->domir($this->kelaminKelas($filter_kelas));
		// var_dump($data['domir']);die();

		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/rapot_mii', $data);
		$this->load->view('templates/footer');
	}

	public function entry()
	{
		$data['judul'] = 'Entry Tambahan';
		$data['tahun_id'] = $this->tahunAktif['id_tahun'];
		$data['kelas_id'] = $this->cekwali()['kelas_id'];
		$data['santri'] = $this->um->santriKelas($data['kelas_id'], $data['tahun_id']);

		
		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/entry_tambahan', $data);
		$this->load->view('templates/footer');
	}

	public function f_entry()
	{
		$data['id_santri'] = $this->uri->segment(3);
		$data['id_kelas'] = $this->uri->segment(4);
		$data['id_tahun'] = $this->uri->segment(5);
		$data['judul'] = 'Form';
		$data['nama_santri'] = $this->um->showNamasantri($data['id_santri']);
		
		$this->db->where('santri_id', $data['id_santri']);
		// $this->db->where('kelas_id', $data['id_kelas']);
		$this->db->where('tahun_id', $data['id_tahun']);
		$data['cek'] = $this->db->get('t_entriwali')->row_array();


		$this->load->view('templates/header', $data);
		$this->load->view('penilaian/f_entry', $data);
		$this->load->view('templates/footer');
	}

	public function doentry()
	{
		// var_dump($this->input->post());die();
		$this->db->where('santri_id', $this->input->post('santri_id'));
	//	$this->db->where('kelas_id', $this->input->post('kelas_id'));
		$this->db->where('tahun_id', $this->input->post('tahun_id'));
		$cek = $this->db->get('t_entriwali')->row_array();

		if ($cek) {
			
			$this->db->where('santri_id', $this->input->post('santri_id'));
// 			$this->db->where('kelas_id', $this->input->post('kelas_id'));
			$this->db->where('tahun_id', $this->input->post('tahun_id'));

			$this->db->update('t_entriwali', $this->input->post());
			redirect('penilaian/entry','refresh');
		
		}else{
			$this->db->insert('t_entriwali', $this->input->post());
			redirect('penilaian/entry','refresh');
		}
	}

	public function naikKe($id_kelas)
	{
		$kelas = $this->db->get_where('m_kelas', ['id_kelas'=>$id_kelas])->row_array();
		$kelas_alias = [
			2 => ['Dua','الثاني'],
			3 => ['Tiga','الثالث'],
			4 => ['Empat','الرابع'],
			5 => ['Lima','الخامس'],
			6 => ['Enam', 'السادس']
		];

		$pre_id = 'Naik ke Kelas: ';
		$pre_ar = ' إلى الفصل : ';

		if ($kelas['rombel'] != 7) {
			if ($kelas['rombel'] == 6) {
					$kelas_lanjut = [
						'kelas'=>'lulus',
						'ket_id'=>'lulus',
						'ket_ar'=>'lulus'
					];
				}
				else{
					$kelas_lanjut = [
						'kelas'=>$kelas['rombel']+1,
						'ket_id'=>$pre_id.$kelas_alias[$kelas['rombel']+1][0],
						'ket_ar'=>$pre_ar.$kelas_alias[$kelas['rombel']+1][1]
					];
				}

		}else{
			$kelas_lanjut = [
				'kelas'=>$kelas['rombel']-3,
				'ket_id'=>$pre_id.$kelas_alias[$kelas['rombel']-3][0],
				'ket_ar'=>$pre_ar.$kelas_alias[$kelas['rombel']-3][1]

			];
		}

		return $kelas_lanjut;
	}

	public function kelaminKelas($id_kelas)
	{
		$kelas = $this->db->get_where('t_wali', ['kelas_id'=>$id_kelas])->row_array();
		return $kelas['tra_tri'];
	}

	public function domir($tra_tri)
	{
		if ($tra_tri == 'tra') {
			$domir = [
				'santri' => 'إسم الطالب',
				'ket' => 'بعد النظر فيما ناله الطالب  من الدرجات، قررت هيئة التدريس بأن الطالب',
				'naik' => 'ناجح',
				'wali' => 'ولي الطالب',
			];
		}else{
			$domir = [
				'santri' => 'إسم الطالبة',
				'ket' => 'بعد النظر فيما ناله الطالبة  من الدرجات، قررت هيئة التدريس بأن الطالبة',
				'naik' => 'ناجحة',
				'wali' => 'ولي الطالبة',
			];
		}
		return $domir;
	}
	
	public function q()
	{
		ini_set('max_execution_time', 1200);

		$q = $this->um->generateNKH();

		foreach ($q as $v) {
			$object = [
				'santri_id' => $v['santri_id'],
				'kelas_id' => $v['id_kelas'],
				'mapel_id' => $v['id_mapel'],
				'tahun_id' => 2,
				//'nkh' => round($v['hadir'] / $v['total'] * 100,0)
				// 'alpa' => $v['alpa'],
				// 'sakit' => $v['sakit'],
				// 'ijin' =>  $v['izin'],
				//echo $v['hadir'];
				//echo $v['total'];
			];
			
			$adaRow = $this->db->get_where('t_na', $object)->result_array();

			if (!$adaRow) {
				$object = [
					'santri_id' => $v['santri_id'],
					'kelas_id' => $v['id_kelas'],
					'mapel_id' => $v['id_mapel'],
					'tahun_id' => 2,
					'nkh' => round($v['hadir'] / $v['total'] * 100,0)
				];
				$this->db->insert('t_na', $object);
			}else {
				$id_na = $adaRow[0]['id_na'];
				$nkh = round($v['hadir'] / $v['total'] * 100,0) ;

				$this->db->where('id_na', $id_na );
				$this->db->where('tahun_id', 2 ); //statis hanya tahun ini
				$this->db->update('t_na', ['nkh'=> $nkh] );
			}
		}
	}

}

/* End of file kelengkapan.php */
/* Location: ./application/controllers/kelengkapan.php */