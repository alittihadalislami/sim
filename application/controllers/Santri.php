<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri extends CI_Controller {

	var $tahunAktif;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','um');
		$this->tahunAktif = $this->um->tahunAktif()['id_tahun'];
		$this->load->model('Kelas_model','km');
		$this->load->model('Santri_model','sm');
	}

	public function perkelas()
	{
		$data['judul'] = 'Dashboard Santri';

		$id_kelas = $this->cekWali()['kelas_id'];
		$data['santri'] = $this->km->santri($this->tahunAktif, $id_kelas)->result_array();
		$data['detail_terisi']=$this->km->detailTerisi();

		$email = $this->session->userdata('email');
	    $dataAktif = $this->um->dataAktif($email);
	    $user_id = $dataAktif['id_user'];
	    $data['rule_id'] = $this->um->multipleRule($user_id)[0]['rule_id'];

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

		$rombel = $this->db->query(" SELECT k.*, COUNT(a.`santri_id`) AS jumlah
									FROM m_kelas k LEFT JOIN t_agtkelas a
									ON k.`id_kelas` = a.`kelas_id`
									AND a.`tahun_id` = 4
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
		$data['kategori'] = ['Alqur\'an','Kitab','Kesenian','Olahraga','Kepanduan','Lainnya'];

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

	public function ubah_santri()
	{
		$daput = $this->input->post();

		$ada = $this->km->adaDetail($daput['santri_id']);

		var_dump($daput);die();

		if ($ada > 0) {
			$this->db->where('santri_id', $daput['santri_id']);
			$this->db->update('t_detail_santri', $daput);
		}else{
			$this->db->insert('t_detail_santri', $daput);
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
		redirect('santri','refresh');
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
	
		$tahun_id = 4;
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

}

/* End of file santri.php */
/* Location: ./application/controllers/santri.php */