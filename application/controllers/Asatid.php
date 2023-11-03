<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asatid extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
        is_boleh();
		$this->load->model('User_model','um');
	}

	public function index()
	{
		$data['judul'] = 'Daftar Asatid Grup';
		$data['asatid'] = $this->db->order_by('sts', 'desc')->order_by('niy', 'asc')->get('m_asatid')->result_array();

		$data['kategori'] = [1=>'guru','pegawai'];

		$this->load->view('templates/header', $data);
		$this->load->view('asatid/df_asatid', $data);
		$this->load->view('templates/footer');
	}

	public function tambahAsatid()
	{
		$this->load->view('templates/header', $data);
		$this->load->view('asatid/df_asatid', $data);
		$this->load->view('templates/footer');
	}

	public function input()
	{
		$data['judul'] = 'Input no HP';
		$data['id_asatid'] = $this->uri->segment(3);
		$data['kategori'] = [1=>'guru','pegawai'];

		$this->load->view('templates/header', $data);
		$this->load->view('asatid/input', $data);
		$this->load->view('templates/footer');

	}

	public function updateCivitas()
	{
		$data_input = $this->input->post();

	
		$this->db->where('id_asatid', $data_input['id_asatid']);
		$this->db->update('m_asatid', $data_input );
		$status = $this->db->affected_rows();

		if ($status > 0)
		{
		 	redirect('asatid','refresh');
		}
	}

	public function tambahCivitas()
	{
		$data_input = $this->input->post();

		$niy ['niy'] = $this->db->select_max('niy')->get('m_asatid')->row()->niy+1;
		$count_asatid = $this->db->select('id_asatid')->get('m_asatid')->num_rows();
		$id['id_asatid'] = $this->input->post('kategori').$count_asatid;

		$object = array_merge($id,$niy,$data_input);

		$this->db->insert('m_asatid', $object);
		$status = $this->db->affected_rows();

		if ($status > 0)
		{
		 	redirect('asatid','refresh');
		}
	}

    public function detail($niy)
	{
		$data['judul'] = 'Detail Asatid';
		$data['niy'] = $niy;

		$this->load->view('templates/header', $data);
		$this->load->view('asatid/detail', $data);
		$this->load->view('templates/footer');

	}

}

/* End of file asatid.php */
/* Location: ./application/controllers/asatid.php */