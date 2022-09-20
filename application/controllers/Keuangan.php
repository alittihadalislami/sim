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
    $data['transaksi_terakhir'] = rand(10,100)."%";
    $data['tagihan'] = rand(10,100)."%";
    $data['lunas'] = rand(10,100)."%";
    $data['tunggakan'] = rand(10,100)."%";

    $isi1 = $this->load->view('keuangan/status',$data,true);
    $isi2 = $this->load->view('keuangan/tabel',null,true);
    $isi3 = $this->load->view('keuangan/invoice',null,true);
    echo $isi1.$isi2.$isi3;
  }

  public function database()
  {
    $data['judul'] = "database";
    $this->load->view('templates/header', $data);
    $this->load->view('keuangan/database',$data);
    $this->load->view('templates/footer');
  }
}

/* End of file keuangan.php */
/* Location: ./application/controllers/keuangan.php */