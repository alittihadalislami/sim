<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ddm extends CI_Controller {

	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
		$this->load->model('Absensi_model','am');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$data['judul'] = "Data Diri Ma'had";

		$this->load->view('templates/header', $data);
		$this->load->view('ddm/home_ddm', $data);
		$this->load->view('templates/footer');
	}
}