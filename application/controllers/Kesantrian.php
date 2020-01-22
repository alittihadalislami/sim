<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kesantrian extends CI_Controller {

	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		// is_login();
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
		$data['klub'] = $this->sm->anggotaKlub($id_klub);

		$this->load->view('templates/header', $data);
		$this->load->view('kesantrian/klub', $data);
		$this->load->view('templates/footer');
	}
}