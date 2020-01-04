<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		$data['judul'] = "Halaman login";

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',['valid_email'=>'Alamat email tidak valid']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Password harus diisi']); 

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/auth/login', $data);
		} else {
			$email=htmlspecialchars($this->input->post('email',TRUE));
			$password=htmlspecialchars($this->input->post('password', TRUE));

			$adaData = $this->db->get_where('user_data',['email'=>$email])->row_array();		
			
			if ($adaData['email']) {
				if (password_verify($password, $adaData['password'])) {
					$data = [
				        'email'  => $adaData['email'],
				        'rule_id'  => $adaData['rule_id']
					];
					$this->session->set_userdata($data);
					redirect('dashboard','refresh');

				} else {
				    $this->session->set_flashdata('pesan', '<div class=" mt-5 mx-auto col-xs-4 col-sm-4 col-md-4 alert alert-danger alert-dismissible">
														  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
														  		<p><i class="icon fa fa-ban"></i> Maaf, password yang dimasukkan <strong>salah</strong>.</p>
															</div>');
					redirect('auth','refresh');
				}
			}else{
				$this->session->set_flashdata('pesan', '<div class=" mt-5 mx-auto col-xs-4 col-sm-4 col-md-4 alert alert-danger alert-dismissible">
														  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
														  <p><i class="icon fa fa-ban"></i> Maaf, email <strong>tidak</strong> terdaftar.</p>
														</div>');
				redirect('auth','refresh');

			}
		}
	}

	public function register()
	{
		$data['judul'] = "Halaman pendaftaran";

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[30]',[
			'required'=>'Nama harus diisi',
			'min_length'=>'Nama  harus lebih 3 karakter',
			'max_length'=>'Nama tidak lebih 30 karakter']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_data.email]',[
			'valid_email'=>'Alamat email tidak valid',
			'is_unique'=>'Email ini telah terdaftar']);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|max_length[30]',['required'=>'Password harus diisi','min_length'=>'Password harus lebih 4 karakter','max_length'=>'Password tidak lebih 30 karakter']); 
		$this->form_validation->set_rules('password2', 'Konfirmasi password', 'trim|required|matches[password1]',['required'=>'Password Konfirm harus diisi & sama','matches'=>'Password tidak sama']);
		$this->form_validation->set_rules('nohp', 'No HP.', 'trim|required|min_length[9]|max_length[12]|numeric|is_unique[user_data.nohp]',[
			'required'=>'No. HP Wajib diisi',
			'min_length'=>'No. HP tidak boleh kurang 9 angka',
			'max_length'=>'No. HP tidak boleh lebih 12 angka',
			'is_unique'=>'No. ini telah terdaftar']);

		if ($this->form_validation->run() == FALSE)
        {
			$this->load->view('templates/auth/register',$data);
        }else{

		$object['nama'] = $this->input->post('nama',true);
		$object['email'] = $this->input->post('email',true);
		$object['password'] = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
		$object['nohp'] = $this->input->post('nohp',true);
		$object['foto'] = 'default.jpg';
		$object['is_active'] = 0;
		$object['date_created'] = time();
		$object['rule_id'] = 8;

		$oke = $this->db->insert('user_data', $object);

			if ($oke) {
				$this->session->set_flashdata('pesan', '<div class=" mt-5 mx-auto col-xs-4 col-sm-4 col-md-4 alert alert-success alert-dismissible">
														  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
														  <p><i class="icon fa fa-check"></i> Alhamdulillah! Data anda <strong>berhasil</strong> didaftarkan.</p>
														</div>');
				redirect('auth/index','refresh');
			}
        }
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */