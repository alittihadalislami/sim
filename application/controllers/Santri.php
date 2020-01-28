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

		$this->load->view('templates/header', $data);
		$this->load->view('santri/index_santri', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_santri()
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

	public function edit($santri_id)
	{
		$data['judul'] = 'Ubah data Santri';
		$data['santri'] = $this->db->get_where('m_santri', ['id_santri'=>$santri_id])->row_array();
		$data['d_santri'] = $this->db->get_where('t_detail_santri', ['santri_id'=>$santri_id])->row_array();
		$data['list_minat'] = $this->db->select('id_minat, nama_minat, kategori_minat')->order_by('kategori_minat','asc')->get('t_minat')->result();
		$data['kategori'] = ['Alqur\'an','Kitab','Kesenian','Olahraga','Kepanduan','Lainnya'];

		$this->load->view('templates/header', $data);
		$this->load->view('santri/edit_santri', $data);
		$this->load->view('templates/footer');
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

}

/* End of file santri.php */
/* Location: ./application/controllers/santri.php */