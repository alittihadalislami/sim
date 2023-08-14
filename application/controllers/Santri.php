<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri extends CI_Controller {

	var $tahunAktif;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
		$this->tahunAktif = $this->um->tahunAktif()['id_tahun'];
		$this->load->model('Kelas_model','km');
		$this->load->model('Santri_model','sm');
	}

	public function perkelas()
	{
		$data['judul'] = 'Dashboard Santri';
		$id_kelas = $this->cekWali();

		if ($id_kelas != null) {
			$id_kelas = $id_kelas['kelas_id'];
		}

		$data['santri'] = $this->km->santri($this->tahunAktif, $id_kelas)->result_array();
		$data['detail_terisi']=$this->km->detailTerisi();
		$email = $this->session->userdata('email');
	    $dataAktif = $this->um->dataAktif($email);
	    $user_id = $dataAktif['id_user'];
	    $data['rule_id'] = $this->um->multipleRule($user_id)[0]['rule_id'];

	    $data['masukTabelWaliTerbaru'] = $this->um->masukTabelWaliTerbaru($email);
	    
		$this->load->view('templates/header', $data);
		$this->load->view('santri/index_santri', $data);
		$this->load->view('templates/footer');
	}

	public function setKelasManual()
	{
		$data['judul'] = 'Setting Kelas manual';

		$data['santri'] = $this->db->get('m_santri')->result_array();

		$this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->db->get_where('m_kelas', ['active'=>1])->result_array();
		$data['tahun'] = $this->tahunAktif;

		$this->load->view('templates/header', $data);
		$this->load->view('santri/kelas_manual', $data);
		$this->load->view('templates/footer');
	}

	public function aksiSetKelasManual()
	{
		$daput = $this->input->post(null,true);

		if ($daput['santri_id'] == "Pilih..." || $daput['kelas_id'] == "Pilih...") {
			$this->session->set_flashdata('pesan','Pilihan masih kosong');
			redirect('santri/setKelasManual','refresh');
		}else{
			$this->db->insert('t_agtkelas', $daput);

			$this->session->set_flashdata('pesan','Berhasil');
			redirect('santri/setKelasManual','refresh');
		}
	}

	public function tambahSantri()
	{

		$data['judul'] = 'Dashboard Santri';
		// $data['santri'] = $this->km->santri()->result_array();

		$simpan = $this->input->post('simpan');

		if (!$simpan) {
			$this->load->view('templates/header', $data);
			$this->load->view('santri/tambah_santri', $data);
			$this->load->view('templates/footer');
		}else{
			$jenjang= $this->input->post('jenjang');
			$santri_data['kode_masuk'] = 'mutasi';
			$santri_data['nama_santri'] = $this->input->post('nama_santri');
			$santri_data['idk_mii'] = intval($this->km->indukAkhir(1))+1;
			$santri_data['idk_umum'] = intval($this->km->indukAkhir(0))+1;
			
			//$this->db->insert('m_santri', $santri_data);

			$agt_data['id_santri'] = $this->km->idSantriAkhir();
			$agt_data['kelas'] = $this->input->post('kelas');
			$agt_data['id_tahun'] = $this->tahunAktif;
			var_dump($jenjang);
			var_dump($santri_data);die();

			redirect('santri/perkelas','refresh');
		}		
	}

	public function manual()
	{
		$object = $this->db->query(" SELECT	s.*, k.`jenjang`
							FROM m_santri s JOIN t_agtkelas a
							ON s.`id_santri` = a.`santri_id` JOIN m_kelas k
							ON k.`id_kelas` = a.`kelas_id`
							WHERE k.`jenjang` = 2 
							AND a.`tahun_id` = 1 ")->result_array();

		foreach ($object as $value) {

			$update = [
				'idk_umum2' => $value['idk_umum'] ,
				'idk_umum' => ''
			];

			$this->db->where('idk_umum > ', 0 );
			$this->db->where('id_santri', $value['id_santri'] );
			$this->db->update('m_santri', $update);
		}
	}

	public function pilihKelas($id_santri)
	{
		$data['santri'] = $this->db->get_where('m_santri', ['id_santri' => $id_santri])->row_array();
		$data['judul'] = 'Pilih Kelas Santri Baru';
		$data['kelas'] = $this->sm->rombelDiterima();

		$this->load->view('templates/header', $data);
		$this->load->view('santri/pilih_kelas_santribaru', $data);
		$this->load->view('templates/footer');
	}

	public function ajax_rombel()
	{
		$kelas = $this->input->post('kelas',true);
		$id_tahun = $this->tahunAktif;

		$rombel = $this->db->query(" SELECT k.*, COUNT(a.`santri_id`) AS jumlah
									FROM m_kelas k LEFT JOIN t_agtkelas a
									ON k.`id_kelas` = a.`kelas_id`
									AND a.`tahun_id` = $id_tahun
									WHERE k.`nama_kelas` != '0' 
									AND k.`nama_kelas` != '8' 
									AND k.`nama_kelas` != '9'
									AND k.`active` = 1
									AND k.`rombel` = $kelas
									GROUP BY k.`id_kelas`
									ORDER BY k.`nama_kelas` ASC ")->result_array();

		echo json_encode($rombel);
	}

	public function edit($santri_id)
	{
		$data['judul'] = 'Ubah data Santri';
		$data['santri'] = $this->db->get_where('m_santri', ['id_santri'=>$santri_id])->row_array();
		$data['d_santri'] = $this->db->get_where('t_detail_santri', ['santri_id'=>$santri_id])->row_array();
		$data['list_minat'] = $this->db->select('id_minat, nama_minat, kategori_minat')->order_by('kategori_minat','asc')->get('t_minat')->result();
		
		$data['kategori'] = [
			'Alqur\'an',
			'Kitab',
			'Bahasa',
			'Kesenian',
			'Olahraga',
			'Lainnya'
		];
		
		$nisn_cek = FALSE;	
		if (isset($data['santri']['nisn'])){
			$nisn_santri = $data['santri']['nisn'];
			//cari di database psb
			$nisn_psb = $this->db->get_where('p_pendaftaran', ['nisn'=>$nisn_santri])->row_array();
			if ($nisn_psb) {
				$nisn_cek = TRUE;
			}
		}

		$data['nisn'] = $nisn_cek;	


		$email = $this->session->userdata('email');
		$user_id = $this->um->dataAktif($email)['id_user'];
		$rule = $this->um->multipleRule($user_id);

		$data['readonly'] = true;

		foreach ($rule as $r) {
			if ($r['rule_id'] == 7 || $r['rule_id'] == 1) {
				$data['readonly'] = false;
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('santri/edit_santri', $data);
		$this->load->view('templates/footer');
	}

	public function simpanKelasDiterima($id_santri, $id_kelas)
	{
		
		$this->db->select('jenjang');
		$jenjang = $this->db->get_where('m_kelas', ['id_kelas' => $id_kelas])->row_array();
		$induk = $this->km->indukAkhir();
		$tahun = $this->tahunAktif;
		
		$induk_umum = NULL;
		$induk_umum2 = NULL;

		if ($jenjang['jenjang'] == 1) {
			$induk_umum = $induk['smp']+1;
		}else if($jenjang['jenjang'] == 2) {
			$induk_umum2 = $induk['ma']+1;
		}
		$this->db->where('id_santri', $id_santri);
		$this->db->update('m_santri', ['idk_umum'=>$induk_umum, 'idk_umum2'=>$induk_umum2]);

		$data_kelas = [
			'santri_id' => $id_santri,
			'kelas_id' => $id_kelas,
			'tahun_id' => $tahun
		];
		$this->db->insert('t_agtkelas', $data_kelas);

		$this->session->set_flashdata('message', 'Kelas berhasil disimpan');
        redirect('psb/index','refresh');
	}

	public function tampilMinat()
	{
		$list_minat = $this->db->select('id_minat, nama_minat, kategori_minat')->order_by('kategori_minat','asc')->get('t_minat')->result_array();
		
		$no=1;
		foreach ($list_minat as $value) {

			echo '<tr>';
				echo '<td>'.$no++.'</td>';
				echo '<td>'.$value['nama_minat'].'</td>';
				echo '<td>'.$value['kategori_minat'].'</td>';

			if ($this->session->userdata('rule_id')<5) {
				
				echo '<td>
						<a href="#" class="btn btn-sm editMinat" data-toggle="modal" data-target="#editModal"
						data-minat="'.$value['nama_minat'].'"
						data-kategori="'.$value['kategori_minat'].'"
						data-id="'.$value['id_minat'].'">
						<i class="far fa-edit text-primary"></i></a>

						<a href="#" class="btn btn-sm hapus ml-3" data-id="'.$value['id_minat'].'" data-minat="'.$value['nama_minat'].'"><i class="far fa-trash-alt text-danger"></i></a>
						</td>';
			}

			echo '</tr>';
		}
	}

	public function tambah_minat()
	{

		$id_santri = $this->input->post('id_santri');

		$daput = [
			'nama_minat' => $this->input->post('nama_minat'),
			'kategori_minat' => $this->input->post('kategori_minat'),
		];

		$this->db->insert('t_minat', $daput);


	}

	public function hapus_minat()
	{
		$id = $this->input->post('id_minat');

		$this->db->where('id_minat',$id)->delete('t_minat');
	}

	function removeWhiteSpace($text)
	{
	    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
	    $text = preg_replace('/([\s])\1+/', ' ', $text);
	    $text = ucwords(strtolower(trim($text)));
	    return $text;
	}

	function cleanString($text)
	{
	    $text = preg_replace('/[\t\n\r\0\x0B]/', ' ', $text);
	    $text = preg_replace('/([\s])\1+/', ' ', $text);
	    $text = str_replace(' : ', ' ', $text);
	    $text = str_replace('Alamat', '', $text);

	    $text = ucwords(strtolower(trim($text)));
	    return $text;
	}

	public function ubahNamaDidetailSantri()
	{
		// $this->db->select('');
		// $this->db->get('t_detail_santri');

		$alamat = " Alamat         : DSN. Benteng Baru
					Desa              : Sambakati
					Kecamatan : Arjasa
					Kebupaten  : Sumenep
					Procinsi.       : Jawa Timur   ";
		echo $this->cleanString($alamat);

	}

    public function simpanKlub()
	{
		$daput = $this->input->post();
		$cek = $this->db->get_where('t_klub', $daput)->num_rows();
		if ($cek < 1) {
			$this->db->insert('t_klub', $daput);
			echo json_encode ('Simpan'.$daput['minat_id']);
		}else{
			$this->db->where($daput);
			$this->db->delete('t_klub');
			echo json_encode('Hapus'.$daput['minat_id']);
		}
	}

	public function ubah_santri()
	{
    $daput = $this->input->post();
    //jika menggunakan ajax
    if ($this->input->is_ajax_request()) {
      $daput = ($daput['ajax']);
    }
		//buang spasi dan huruf kapital
		if ($daput['nama_seijazah'] != null) {
			$clean_nama = $this->removeWhiteSpace($daput['nama_seijazah']);
			$daput['nama_seijazah'] = $clean_nama;
		}

		$ada = $this->km->adaDetail($daput['santri_id']);
        if ($ada > 0) {
			$this->db->where('santri_id', $daput['santri_id']);
			$this->db->update('t_detail_santri', $daput);
		}else{
			$this->db->insert('t_detail_santri', $daput);
		}
    $afftectedRows = $this->db->affected_rows();
    if ($this->input->is_ajax_request()) {
      if ($afftectedRows > 0 ) {
        echo 'berhasil diubah';
      }else{
        echo 'tidak ada perubahan';
      }
		return ;
    }
		redirect('santri/perkelas/','refresh');
	}

	public function cekwali()
	{
		$tahun_aktif = $this->tahunAktif;
		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$id_asatid = $this->um->idAsatid($nohp)['id_asatid'];
		$data_wali = $this->um->adaIdWali($id_asatid,$tahun_aktif);
		return $data_wali;
	}

	public function non_aktif($id)
	{
		$this->db->where('santri_id', $id);
		$this->db->where('tahun_id', $this->tahunAktif);
		$this->db->update('t_agtkelas', ['kelas_id'=> 19]);
		redirect('santri/perkelas','refresh');
	}

	public function updateKelasSantri()
	{
		$data['judul'] = 'Pengaturan anggota kelas';

		$this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->db->get_where('m_kelas', ['active'=>1])->result_array();
		$data['santri'] = $this->sm->kelasSantri($this->tahunAktif,1);

		$this->load->view('templates/header', $data);
		$this->load->view('santri/anggota_kelas_santri', $data);
		$this->load->view('templates/footer');
	}

	public function buatAgtKelas()
	{
		$data['judul'] = 'Membuat anggota kelas';

		$this->db->select('id_tahun, nama_tahun');
		$data['tahun'] = $this->db->get('m_tahun')->result_array();
		
		$this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->db->get_where('m_kelas', ['active'=>1])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('santri/buat_agt_kelas', $data);
		$this->load->view('templates/footer');
	}

	public function ajax_santri()
	{
		$daput = $this->input->post();
		$santri = $this->sm->kelasSantri($daput['tahun'],$daput['kelas']);
		echo json_encode($santri);
	}

	public function ajax_santriRombelTratri()
	{
		$daput = $this->input->post();
		$santri = $this->sm->santriRombelTratri($daput['tahun'], $daput['rombel'], $daput['tratri']);
		echo json_encode($santri);
	}

	public function ajax_rombelLanjut(){

		$daput = $this->input->post();

		$rombel_next = $daput['rombel'] + 1;
		
		if ($rombel_next > 7 ) {
			$rombel_next = 4;
		}
		$this->db->order_by('nama_kelas', 'asc');
		$kelas = $this->db->get_where('m_kelas', ['active'=>1, 'rombel'=>$rombel_next])->result_array();
		echo json_encode($kelas);
	}

	public function ajax_tambahAgtKelas()
	{
		$daput = $this->input->post(null,true);
	
		$tahun_id = 10; //awal tahun aktif semester 1 diubah manual
		$template2 = [1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,1,2,2,1,];
		$id_santri = $daput['idsantri'];
		$id_kelas = $daput['idkelas'];

		if (count($id_kelas)>1 ) {
			$jumlah_santri = count($id_santri);

			$template = array_slice($template2, 0, $jumlah_santri);

			$data = [];
			for ($i=0; $i <$jumlah_santri ; $i++) { 
				$data[] = [
					'id'=>$id_santri[$i],
					'template'=> $template[$i]
				];
			}


			foreach ($data as $santri) {

				if ($santri['template'] == 1 ) {
					$kelas_id = $id_kelas[0];
				}
				else{
					$kelas_id = $id_kelas[1];
				}

				$object = [
					'id_agt_kelas' => $santri['id'].$kelas_id.$tahun_id,
					'santri_id' => $santri['id'],
					'kelas_id' =>$kelas_id,
					'tahun_id' => $tahun_id
				];

				$this->db->replace('t_agtkelas', $object);
				var_dump($object);
			}
		}else{

			foreach ($id_santri as $santri) {

				$object = [
					'id_agt_kelas' => $santri.$id_kelas[0].$tahun_id,
					'santri_id' => $santri,
					'kelas_id' =>$id_kelas[0],
					'tahun_id' => $tahun_id
				];
				$this->db->replace('t_agtkelas', $object);

			}
			
		}
	}

	public function rekap()
	{
		//halaman rekap
		$data['judul'] = "Rekap Santri";

		$data['rekap'] = $this->sm->rekapSantri($this->tahunAktif);
		
		$data['atribut'] = [
			'kelas' => [1,2,3,4,5,6,7],
			'rombel' => ['A','B','C','D']
		];

		$this->load->view('templates/header', $data);
		$this->load->view('santri/rekap', $data);
		$this->load->view('templates/footer');
	}

	public function detailKab()
	{
		$kode = '65.03.08.2001';
		echo $this->um->showAlamat($kode)[0];
	}

	public function ajaxSinkronPsb()
	{
		$daput = $this->input->post('data_send');

		// var_dump
		$id_santri = $daput['santri_id'];

		$this->db->where('santri_id',$id_santri);
		$this->db->update('t_detail_santri', $daput);
	}
	
	public function sinkronDataPsb($nisn)
	{
		$data['judul'] = "Singkron data PSB";

		$data['list_detail'] = [
			"dukcapil" => [
				"1. No Induk Kependudukan (NIK)",
				"2. No Kartu Keluarga (NKK)",
				"3. Anak Ke",
				"4. Jumlah Saudara",
				"5. Nama Bapak",
				"6. Pekerjaan Bapak",
				"7. Nama Ibu",
				"8. Pekerjaan Ibu",
				"9. Alamat orang tua"],
			"ijazah" => [
				"1. Nama Santri sesuai IJAZAH",
				"2. Tempat Lahir",
				"3. Tanggal Lahir",
				"4. Nama Bapak sesuai IJAZAH",
				"5. NISN",
				"6. Nomor Peserta Ujian",
				"7. Jumlah Nilai Ijazah",
				"8. No Seri Ijazah",
				"9. No Seri SKHUN",
				"10. Tahun Ijazah/SKHUN",
				"11. Nama sekolah asal",
				"12. NPSN sekolah asal"
				],
			"psb"=> [
				"1. Diterima tanggal",
				// "2. Kelas",
				// "3. Semester",
				"6. Nomor HP Bapak",
				"7. Nomor HP Ibu"
			]
		];

		$data['atribut'] = [
			"dukcapil" => [
				"nik"=>'nik',
				"nok"=>'nok',
				"anak_ke"=>'anak_ke',
				"jml_saudara"=>'jml_saudara',
				"bapak"=>'nama_bapak',
				"kerja_bapak"=>'pekerjaan_bapak',
				"ibu"=>'nama_ibu',
				"kerja_ibu"=>'pekerjaan_ibu',
				"alamat_ortu"=>'alamat_lengkap'
			],
			"ijazah" => [
				"nama_seijazah"=>'nama_seijasah',
				"tmp_lahir"=>'tmp_lahir',
				"tgl_lahir"=>'tgl_lahir',
				"bapak_seijazah"=>'nama_bapak',
				"nisn"=>'nisn',
				"no_ujian"=>'nopes',
				"nilai_ijazah"=>'nilai_ijasah',
				"seri_ijazah"=>'no_ijasah',
				"seri_skhun"=>'no_skhu',
				"tahun_ijazah"=>'thn_ijs',
				"sekolah_asal"=>'nama_sekolah_asal',
				"npsn"=>'npsn_asal'
				],
			"psb"=> [
				"tgl_terima_mii"=>'diterima',
				// "kelas_terima"=>'',
				// "semester_terima"=>'',
				"hp_bapak"=>'no_hp_bapak',
				"hp_ibu"=>'no_hp_ibu'
			]
		];

		$data['psb'] = $this->db->get_where('p_pendaftaran', ['nisn'=>$nisn])->row_array();
		$data_awal_id = $data['psb']['data_awal_id'];
		$dataawal = $this->db->get_where('p_data_awal', ['id_data_awal'=> $data_awal_id])->row_array();
		$sts_wali = ['bapak','ibu','wali'];
		$data_wali = [] ;

		for ($i=1; $i <= count($sts_wali); $i++) { 

			$ortu = $this->db->get_where('p_wali_pendaftaran',['data_awal_id'=> $data_awal_id, 'sts'=> $i ])->row_array();
			
			if ($ortu) {
				foreach ($ortu as $key => $value) {
					
					$key1 = explode('_ortu',$key);
					$data_wali [$key1[0].'_'.$sts_wali[$i-1] ] = $value;
				}						
			}
		}

		//membersiihkan spaci pada nok
		$nok_baru = str_replace(' ','',$data['psb']['nok']);
		$data['psb']['nok'] = $nok_baru;


		$data['psb'] = array_merge($dataawal,$data['psb'],$data_wali);

		//35 id pertanyaan pada tobel database
		$pekerjaan_bapak = $this->um->showPekerjaan(35,$data['psb']['pekerjaan_bapak']);
		$pekerjaan_ibu = $this->um->showPekerjaan(35,$data['psb']['pekerjaan_ibu']);
		$pekerjaan_wali = $this->um->showPekerjaan(35,$data['psb']['pekerjaan_wali']);

		$data['psb']['pekerjaan_bapak'] = isset($pekerjaan_bapak)?$pekerjaan_bapak['pekerjaan']:'';
		$data['psb']['pekerjaan_ibu'] = isset($pekerjaan_ibu)?$pekerjaan_ibu['pekerjaan']:'';
		$data['psb']['pekerjaan_wali'] = isset($pekerjaan_wali)?$pekerjaan_wali['pekerjaan']:'';

		$string_alamat = $this->um->showAlamat($dataawal['desa_id'])[0];
		$alamat_lengkap = $dataawal['alamat_pengenal'].', '.$string_alamat;
		$data['psb']['alamat_lengkap'] = $alamat_lengkap;

		
		$nama_santri = $data['psb']['nama'];
		$nisn = $data['psb']['nisn'];

		//cek apakah sudah tersimpan di data master santri
		$sudahDiTabelMaster = FALSE;
		$santri_master = $this->db->get_where('m_santri', 
			[
				'nama_santri'=>$nama_santri,
				'nisn'=>$nisn
			]
		)->row_array();
		
		if ($santri_master) { 
			//jika sudah ada di data master (m_santri), dapatkan id_santrinya
			$id_santri = $santri_master['id_santri'];
			$sudahDiTabelMaster = TRUE;
			
			//cek apakah sudah ada data ditabel t_detail_santri, sesuai id_santri yang didapat dari table master
			$cek = $this->db->get_where('t_detail_santri',['santri_id'=> $id_santri])->row();
			if (!$cek) {
				
				$object = [
					'nisn' => $nisn,
					'santri_id'=> $id_santri,
				];

				$this->db->insert('t_detail_santri',$object);
			}else{
				// echo 'data sudah ada di table t_detail_santri <br/>';
				
			}

		}else{
			//jika belum tersimpan di data master (m_santri)
		}

		$data['d_santri'] = $this->db->get_where('t_detail_santri', ['nisn'=>$nisn])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('santri/sinkronDataPsb', $data);
		$this->load->view('templates/footer');
	}

	public function dataUtama()
	{
		$data['judul']= "Data Utama";

		$this->db->order_by('nama_kelas', 'asc');
		$data['kelas']= $this->db->get_where('m_kelas', ['active'=>1])->result_array();

		$data['data_detail'] = $this->sm->dataUtamaDetail($this->tahunAktif);

		
		for ($dt=0; $dt<count($data['data_detail']); $dt++) {

			$nisn_awal = $data['data_detail'][$dt]['nisn'];
			$nisn_dari_wali = $data['data_detail'][$dt]['nisn_wali'];

			if (strlen($nisn_awal) == 10 ) {
				$data['data_detail'][$dt]['nisn_fix'] = $nisn_awal;
			}else{
				if (strlen($nisn_dari_wali) == 10) {
					$data['data_detail'][$dt]['nisn_fix'] = $nisn_dari_wali;
				}else{
					$data['data_detail'][$dt]['nisn_fix'] = null;
				}
			}

		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('santri/data_utama', $data);
		$this->load->view('templates/footer');
	}

	public function pencatatanKesantrian()
	{
		$data['judul'] = "Pencatatan Kesantrian";
		$data['catatan'] = $this->sm->pencatatanKesantrian($this->tahunAktif);

		$this->load->view('templates/header', $data);
		$this->load->view('santri/pencatatanKesantrian', $data);
		$this->load->view('templates/footer');
	}

	public function tambahPencatatanKesantrian()
	{
		$daput = $this->input->post();

		if ($daput) {
			$this->db->insert('t_catatan_santri', $daput);
			redirect('santri/pencatatanKesantrian');
		}else {
            $StringQ = " SELECT s.*
                        FROM m_santri s JOIN t_agtkelas a
                        ON s.`id_santri` = a.`santri_id`
                        WHERE a.`tahun_id` = $this->tahunAktif ";
                        
		    $data['santri'] = $this->db->query($StringQ)->result_array();

			$data['santri'] = $this->db->get('m_santri')->result_array();
			$data['jenis_catatan'] = $this->db->get('t_jenis_catatan')->result_array();

			$data['judul'] = "Pencatatan Kesantrian";
			$this->load->view('templates/header', $data);
			$this->load->view('santri/tambahPencatatanKesantrian', $data);
			$this->load->view('templates/footer');
		}

	}

	public function perbaikiFormatTanggalManual()
	{
		$StringQ = " SELECT ds.`santri_id`, ds.`nik`, ds.`tgl_lahir`,ds.`nama_seijazah`
						FROM t_detail_santri ds ";
		$data = $this->db->query($StringQ)->result_array();
		
		foreach ($data as $value) {
			echo $value['santri_id'].'|';
			echo $value['nik'].'|';
			echo $value['tgl_lahir'].'|';
			echo $value['nama_seijazah'];
			echo '<br>';
		}

	}

    public function j_induk()
    {
        $daput = $this->input->post();

        if ($daput['index'] == 2){
            $kolom_induk = 'idk_ma';
        }
        if ($daput['index'] == 1) {
            $kolom_induk = 'idk_smp';
        }
        $this->db->where('santri_id', $daput['id_santri']);
        $this->db->update('t_detail_santri', [$kolom_induk => $daput['induk']]);

    }

    public function generateNikOrtu($nisn = '0099975852')
    {
        $StringQ = "SELECT a.`nama`, a.`id_data_awal`, a.`alamat_pengenal`, a.`desa_id`,w.`sts`, w.`nik_ortu`,p.`nok`
        FROM p_data_awal a JOIN p_wali_pendaftaran w
        ON a.`id_data_awal` = w.`data_awal_id` JOIN p_pendaftaran p
        ON p.`data_awal_id` = a.`id_data_awal`
        WHERE a.`nisn` = $nisn
        ORDER BY w.`sts` ASC ";
        $data_psb = $this->db->query($StringQ)->result_array();

        if($data_psb==false){
            echo "tidak ada di data PSB";
            return false;
        }
        $nok = $data_psb[0]['nok'];
        $nik_bapak = $data_psb[0]['nik_ortu'];
        $nik_ibu = $data_psb[1]['nik_ortu'];
        $alamat_pengenal = $data_psb[0]['alamat_pengenal'];
        $alamat_id = $data_psb[0]['desa_id'];

        // =====================      
        $StringQ = "SELECT  dt.`santri_id`, dt.`nik`,dt.`alamat_ortu`,dt.`nok`, dt.`nik_bapak`, dt.`nik_ibu`, dt.`alamat_pengenal`, dt.`alamat_id`
                FROM t_detail_santri dt
                WHERE dt.`nisn` = $nisn ";
        $data_detail = $this->db->query($StringQ)->row_array();

        $id_santri = $data_detail['santri_id'];
        $hasil['id_santri'] = $id_santri;
        $hasil['nisn'] = $nisn;
        
        $data_target = [
            ['nok' => ['detail'=>$data_detail['nok'],'psb'=>str_replace(" ","",$nok)] ],
            ['nik_bapak' => [ 'detail'=>$data_detail['nik_bapak'],'psb'=>str_replace(" ","",$nik_bapak)]],
            ['nik_ibu' => [ 'detail'=>$data_detail['nik_ibu'],'psb'=>str_replace(" ","",$nik_ibu)]],
            ['alamat_pengenal' => ['detail'=>$data_detail['alamat_pengenal'],'psb'=>$alamat_pengenal]],
            ['alamat_id' => [ 'detail'=>$data_detail['alamat_id'],'psb'=>$alamat_id]]
        ];        
        foreach ($data_target as $dt) {
            foreach ($dt as $key => $value) {
                $jumlah_huruf_d = strlen($value['detail']);
                $jumlah_huruf_p = strlen($value['psb']);
                if ($jumlah_huruf_d < $jumlah_huruf_p) {
                        $hasil[$key] = $value['psb'] ;
                }
            }
        }
        echo json_encode($hasil);
    }

    public function cekDataTertentu() //nik bapak, nik ibu, alamat, 
    {
        $StringQ = " SELECT  dt.`santri_id`, dt.`nik`,dt.`alamat_ortu`,dt.`nok`, dt.`nik_bapak`, dt.`nik_ibu`, dt.`alamat_pengenal`, dt.`alamat_id`
            FROM t_detail_santri dt ";
        $hasil = $this->db->query($StringQ)->result_array();
        $target = [];
        foreach ($hasil as $seluruh_santri) {
            foreach ($seluruh_santri as $santri => $str) {
                if ($santri != 'santri_id') {
                    if (strlen($str) < 1 )  {
                        $target [ $seluruh_santri['santri_id'] ][] = $santri ;
                    }
                }
            }
        }
        var_dump($target);
    }

}

/* End of file santri.php */
/* Location: ./application/controllers/santri.php */