<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfig extends CI_Controller {
	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		is_boleh();
		$this->load->model('User_model','um');
		$this->load->model('Kelas_model','km');
		$this->load->model('Konfig_model','fm');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$data['judul'] = 'Konfigurasi';

		$data['daftar'] = [
			'Import data walikelas genap dari data ganjil' => base_url('konfig/aturwali'),
			'Mengajar' => 0,
			'Tahun Ajaran' => 0,
			'Hitung nilai Kehadiran' => base_url('konfig/hitungNkh'),
			'Ambil nilai ijazah untuk nilai raport' => 0,
			'Ambil nilai serumpun' => 0,
		];

		$this->load->view('templates/header', $data);
		$this->load->view('konfig/index', $data);
		$this->load->view('templates/footer');
	}

	public function aturWali()
	{
		$objectWali = $this->fm->listCopyWali();
		
		$hasilEksekusi = [
			'insert'=> 0,
			'tersedia' => 0
		];

		foreach ($objectWali as $ow ) {
			$object = [
				'kelas_id' => $ow->kelas_id,
				'asatid_id' => $ow->asatid_id,
				'tra_tri' => $ow->tra_tri,
				'tahun_id' => $ow->tahun_id
			];
			$cek = $this->db->get_where('t_wali', $object)->num_rows();
				if ($cek < 1) {
					$this->db->insert('t_wali', $object);
					$hasilEksekusi ['insert'] += 1;
				}else{
					$hasilEksekusi ['tersedia'] += 1;
				}
		}

		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">Well done!</h4>
		  <p>Aww yeah, Anda telah melakukan copy data Wali Kelas dari semester Ganjil ke semester Genap.</p>
		  <hr>
		  <p class="mb-0">Data yang masukkan adalah = '.$hasilEksekusi['insert'].', dan yang sudah tersedia = '.$hasilEksekusi['tersedia'].'</p>
		</div>');

		redirect('konfig','refresh');
	}

	public function uamiiRaport()
	{
		$mapel_mii = $this->fm->mapelMii6();
		foreach ($mapel_mii as $mii) {
			echo $mii['id_mapel'];
		}
	}

	public function hitungNkh()
	{
		ini_set('max_execution_time', 1200);

		$tgl_awal_semester = 20200101;
		$q = $this->um->generateNKH($tgl_awal_semester);
		$id_tahun = $this->tahunAktif['id_tahun'];

		foreach ($q as $v) {
			$object = [
				'santri_id' => $v['santri_id'],
				'kelas_id' => $v['id_kelas'],
				'mapel_id' => $v['id_mapel'],
				'tahun_id' => $id_tahun,
			];
			
			$adaRow = $this->db->get_where('t_na', $object)->result_array();

			if (!$adaRow) {
				$object = [
					'santri_id' => $v['santri_id'],
					'kelas_id' => $v['id_kelas'],
					'mapel_id' => $v['id_mapel'],
					'tahun_id' => $id_tahun,
					'nkh' => round($v['hadir'] / $v['total'] * 100,0)
				];
				$this->db->insert('t_na', $object);
			}else {
				$id_na = $adaRow[0]['id_na'];
				$nkh = round($v['hadir'] / $v['total'] * 100,0) ;

				$this->db->where('id_na', $id_na );
				$this->db->where('tahun_id', $id_tahun ); 
				$this->db->update('t_na', ['nkh'=> $nkh] );
			}
		}

		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">Well done!</h4>
		  <p>Aww yeah, Penghitungan Nilai Kehadiran sudah dilakukan.</p>
		  <hr>
		  <p class="mb-0">Perhitungan dimulai dari tanggal '.$tgl_awal_semester.'</p>
		</div>');

		redirect('konfig','refresh');
	}

}