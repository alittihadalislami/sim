<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
        is_boleh();
		$this->load->model('User_model','um');
		$this->load->model('Kur_model','krm');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$this->mengajar();
	}

	public function mengajar()
	{
		$data['judul'] = 'Asatid mengajar';

		$tahun_id = 4;

		$data['ngajar'] = $this->krm->ngajar($tahun_id);

		$this->load->view('templates/header', $data);
		$this->load->view('kurikulum/ngajar', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_ngajar()
	{
		$data['judul'] = 'From Tambah Ngajar';

		$data['asatid']= $this->db->get('m_asatid')->result_array();
		$data['mapel']= $this->db->get('m_mapel')->result_array();

		$this->db->where('active = 1');
		$this->db->order_by('nama_kelas', 'asc');
		$data['kelas']= $this->db->get('m_kelas')->result_array();

		$this->db->group_by('nama_tahun');
		$data['tahun']= $this->db->get('m_tahun')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('kurikulum/tambah_ngajar', $data);
		$this->load->view('templates/footer');
	}

	public function ex_tbh_ngajar()
	{
		$daput = $this->input->post(null,true);

		foreach ($daput['kelas'] as $id_kelas) {
			
			$where = [
				'mapel_id' => $daput['mapel'],
				'kelas_id' => $id_kelas,
				'tahun_id' => $daput['tapel']
			];

			$this->db->where($where);
			$sudah_ada = $this->db->get('m_mengajar')->row_array();

			$mapel_str = $this->um->showNamaMapel($daput['mapel'])['nama_mapel'];
			$kelas_str = $this->um->showNamaKelas($id_kelas)['nama_kelas'];
			$asatid_str = $this->um->showNamaAsatid($sudah_ada['asatid_id'])['nama_asatid'];
	

			if($sudah_ada){
				//catat mapel kelas sudah ada
				$catatan [] = '<i class="fas fa-info-circle text-warning"></i> '.$mapel_str.' '.$kelas_str.'<span class="text-warning font-weight-bold"> sudah ada</span> dengan: '.$asatid_str.'<br>';
			}else{
				$value = [
				'asatid_id' => $daput['asatid'],
				'mapel_id' => $daput['mapel'],
				'kelas_id' => $id_kelas,
				'tahun_id' => $daput['tapel']
				];

				$this->db->insert('m_mengajar', $value);

				if ( $this->db->affected_rows() > 0) { 
					// catatan berhasil
					$catatan [] = '<i class="far fa-check-square text-success"></i> '.$mapel_str.' '.$kelas_str.', berhasil disimpan <br>';
				}else{
					// catatan  gagal
					$catatan [] = '<i class="fas fa-info-circle text-danger"></i> '.$mapel_str.' '.$kelas_str.',gagal disimpan <br>';
				}	
			}

			//tampilkan keterangan sweatalert()
		}

		$note = '';

		foreach ($catatan as $value) {
			$note .= $value;
		}

		// var_dump($note);

		// die();

		$this->session->set_flashdata('pesan', '
		<div class="col-lg-12">
    		<div class="col-md-6 mt-4 py-1 alert alert-light alert-dismissible elevation-2">
		  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  		<p class="mt-3">'.$note.'</p>
			</div><br>
		</div>
		');

	    redirect('kurikulum/tambah_ngajar','refresh');
	}

	public function hapus()
	{
		$daput = $this->input->post(null,true);

		$this->db->where('id_mengajar', $daput['id_mengajar']);
		$affect = $this->db->delete('m_mengajar');

		if ($affect) {
			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
	    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
			  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data sudah <strong>dihapus</strong>.</p>
				</div><br>
			</div>');
			$this->session->set_flashdata('filter', $daput['filter']);
			redirect('kurikulum','refresh');
		}
	}
}

/* End of file asatid.php */
/* Location: ./application/controllers/asatid.php */