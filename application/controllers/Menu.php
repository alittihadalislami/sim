<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
		
	var $data=[];

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('User_model','um');

	}

	public function index()
	{
		is_login();
		$this->tambahMenu();
	}

	public function tambahMenu()
	{

		$data['judul'] = "Tambah Data";

		
		$this->load->view('templates/header', $data);
		$this->load->view('menu/tambahMenu', $data);
		$this->load->view('templates/footer');
	}

	public function deleteMenu()
	{
		
	}

}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */