<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kesantrian extends CI_Controller {

	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
        is_boleh();
		$this->load->model('User_model','um');
		$this->load->model('Santri_model','sm');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function peminatan()
	{
		$data['judul'] = "Manajemen Peminatan Santri";
		$data['minat'] = $this->db->get('t_minat')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('kesantrian/home_kesant', $data);
		$this->load->view('templates/footer');
	}

	public function klub($id_klub)
	{
		$data['judul'] = "Klub Santri";
		$tahun = $this->tahunAktif['id_tahun'];
		$data['klub'] = $this->sm->anggotaKlub($id_klub,$tahun);

		$this->load->view('templates/header', $data);
		$this->load->view('kesantrian/klub', $data);
		$this->load->view('templates/footer');
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

	public function ubahMinat()
	{
		$id = $this->input->post('id_minat');
		$object = [
			'nama_minat' => $this->input->post('nama_minat'),
			'kategori_minat' => $this->input->post('kategori_minat')
		];
		$this->db->where('id_minat', $id);
		$this->db->update('t_minat', $object);

	}
}