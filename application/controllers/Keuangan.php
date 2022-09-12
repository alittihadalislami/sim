<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Raport_model','rm');
		$this->load->model('User_model','um');
		$this->load->model('Kelas_model','km');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
    $data['judul'] = 'Dashboard Keuangan';
    $this->load->view('templates/header', $data);
    $this->load->view('keuangan/index_keuangan', $data);
		$this->load->view('templates/footer');
  }
  public function tabel()
  {
    $isi1 = $this->load->view('keuangan/status',null,true);
    $isi2 = $this->load->view('keuangan/tabel',null,true);
    echo $isi1.$isi2;
  }
}

/* End of file keuangan.php */
/* Location: ./application/controllers/keuangan.php */