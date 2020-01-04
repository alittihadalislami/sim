<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model','um');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$this->mengajar();
	}

	public function mengajar()
	{
		$data['judul'] = 'Asatid mengajar';

		$data['sts_nilai'] = $this->um->cekEntryNilai(null, $this->tahunAktif['id_tahun']);

		// var_dump($data['sts_nilai']);die();

		$asatid = $this->db->get('m_asatid')->result_array();
		foreach ($asatid as $a ) {
			$nama_asatid [$a['id_asatid']] = $a['nama_asatid'];
		}
		$data ['nama_asatid'] = $nama_asatid;

		$mapel = $this->db->get('m_mapel')->result_array();
		foreach ($mapel as $m ) {
			$nama_mapel [$m['id_mapel']] = $m['nama_mapel'];
		}
		$data ['nama_mapel'] = $nama_mapel;

		$kelas = $this->db->get('m_kelas')->result_array();
		foreach ($kelas as $k ) {
			$nama_kelas [$k['id_kelas']] = [$k['nama_kelas'],$k['kelas_alias']];
		}
		$data ['nama_kelas'] = $nama_kelas;

		$this->load->view('templates/header', $data);
		$this->load->view('kurikulum/ngajar', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_ngajar()
	{
		$data['judul'] = 'From Tambah Ngajar';

		$data['asatid']= $this->db->get('m_asatid')->result_array();
		$data['mapel']= $this->db->get('m_mapel')->result_array();
		$data['kelas']= $this->db->get('m_kelas')->result_array();
		$data['tahun']= $this->db->get('m_tahun')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('kurikulum/tambah_ngajar', $data);
		$this->load->view('templates/footer');
	}

	public function ex_tbh_ngajar()
	{
		$daput = $this->input->post(null,true);
		
// 		var_dump($daput['kelas']);die();

		foreach ($daput['kelas'] as $id_kelas) {

			$value = [
			'mapel_id' => $daput['mapel'],
			'kelas_id' => $id_kelas,
			'tahun_id' => $daput['tapel']
			];		

			$this->db->where($value);
			$sudah_ada = $this->db->get('m_mengajar')->result_array();

			if($sudah_ada){
			
				$this->session->set_flashdata('pesan', '<div class="col-lg-12">
		    		<div class="col-md-6 mt-4 py-1 alert alert-danger alert-dismissible elevation-2">
				  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Kelas dan Mata Pelajaran tersebut <strong>sudah telah ada di Data Mengajar</strong>.</p>
					</div><br>
	    		</div>');
	    		
			}else{
				$value_insert = [
					'asatid_id' => $daput['asatid'],
					'mapel_id' => $daput['mapel'],
					'kelas_id' => $id_kelas,
					'tahun_id' => $daput['tapel']
				];

				$affect = $this->db->insert('m_mengajar',$value_insert);
				if ($affect) {
					$this->session->set_flashdata('pesan', '<div class="col-lg-12">
		    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
				  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data sudah <strong>ditambahkan</strong>.</p>
					</div><br>
	    		</div>');
				}
			}
		}
	    redirect('kurikulum/tambah_ngajar','refresh');
	}

	public function hapus($id)
	{
		$this->db->where('id_mengajar', $id);
		$affect = $this->db->delete('m_mengajar');

		if ($affect) {
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data sudah <strong>dihapus</strong>.</p>
				</div><br>
			</div>');
			redirect('kurikulum','refresh');
		}
	}
}

/* End of file asatid.php */
/* Location: ./application/controllers/asatid.php */