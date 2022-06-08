<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Humas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
    is_boleh();
		$this->load->model('User_model','um');
		$this->load->model('Humas_model','hm');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$this->agenda();
	}

  public function agenda()
  {
    $data['judul']='Agenda';

		$this->load->view('templates/header',$data);
		$this->load->view('humas/agenda',$data);
		$this->load->view('templates/footer');
  }
}
