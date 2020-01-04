<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asatid extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model','um');
	}

	public function index()
	{
		$data['judul'] = 'Daftar Asatid Grup';
		$data['asatid'] = $this->db->get('m_asatid')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('asatid/df_asatid', $data);
		$this->load->view('templates/footer');
	}

	public function input()
	{
		$data['judul'] = 'Input no HP';
		$data['id_asatid'] = $this->uri->segment(3);

		$this->load->view('templates/header', $data);
		$this->load->view('asatid/input', $data);
		$this->load->view('templates/footer');

	}

	public function tambahhp()
	{
		$data_input = $this->input->post();

		if ( isset($data_input) ) {
			$this->db->where('id_asatid', $data_input['id_asatid']);
			$this->db->update('m_asatid', ['nohp' => $data_input['nohp'] ]);
			$status = $this->db->affected_rows();
		}

		if ($status > 0)
		{
		 	redirect('asatid','refresh');
		}
	}

}

/* End of file asatid.php */
/* Location: ./application/controllers/asatid.php */