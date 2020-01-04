<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
	}

	public function index()
	{

		$data['judul'] = "Dashboard Utama";

		$this->db->select('nama');
		$this->db->where('email', $this->session->userdata('email'));
		$data['nama_user'] = $this->db->get('user_data')->row_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/home_dashboard',$data);
		$this->load->view('templates/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata(['email','rule_id']);
		session_destroy();
		redirect('auth','refresh');
	}

	public function profil()
	{
		$data['judul'] = 'Profil';

		$data['email'] = $this->session->userdata('email');

		$data['asatid'] = $this->db->get_where('user_data', ['email' => $data['email'] ])->row_array();

		$this->form_validation->set_rules('nohp', 'No HP.', 'trim|required|min_length[10]|max_length[12]|numeric|is_unique[user_data.nohp]',[
			'required'=>'No. HP Wajib diisi',
			'min_length'=>'No. HP tidak boleh kurang 10 angka',
			'max_length'=>'No. HP tidak boleh lebih 12 angka',
			'is_unique'=>'No. ini telah terdaftar']);

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header',$data);
			$this->load->view('dashboard/profil',$data);
			$this->load->view('templates/footer');

		}else{
			
			$daput = $this->input->post(null,true);
			$object = [
				'nohp' => $daput['nohp']
			];

			$this->db->where('id_user', $daput['id_user']);
			$this->db->update('user_data', $object);

			$this->session->set_flashdata('pesan', '<div class="col-lg-12">
		    		<div class="col-md-6 mt-4 py-1 alert alert-success alert-dismissible elevation-2">
				  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  		<p class="mt-3"><i class="icon fa fa-exclamation-circle"></i> Data berhasil <strong>diubah</strong>.</p>
					</div><br>
	    		</div>');

			redirect('dashboard/profil','refresh');
		}


	}
}
