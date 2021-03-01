<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
		
	var $data=[];

	public function __construct()
	{
		is_login();
		parent::__construct();		
		$this->load->model('User_model','um');

	}

	public function index()
	{
		is_login();
		$data['judul'] = 'Menejemen menu';

		$stringQ = " SELECT h.`id_head`, h.`nama`, '1' AS kategori FROM menu_head  h ";
		$data['head'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.*, '2' AS kategori FROM menu s ORDER BY s.`head_id`, s.`urutan` ";
		$data['menu'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.*, '3' AS kategori FROM menu_sub  s ";
		$data['sub_menu'] = $this->db->query($stringQ)->result();

		// var_dump($data['sub_menu']);die();

		$this->load->view('templates/header', $data);
		$this->load->view('menu/home_menu', $data);
		$this->load->view('templates/footer');
	}

	public function ubahMenu($id)
	{

		$data['judul'] = "Ubah Menu";

		$data['head'] = $this->db->get('menu_head')->result();
		$data['menu'] = $this->db->get_where('menu',['id_menu'=>$id])->row();
		
		$ubah = $this->input->post('ubah');
		

		if ($ubah != NULL ) {
			
			$id_menu = $this->input->post('id_menu');
			$object = [
				'nama_menu' => $this->input->post('nama_menu'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'urutan' => $this->input->post('urutan'),
				'head_id' => $this->input->post('head_id')
			];

			$this->db->where('id_menu', $id_menu);
			$this->db->update('menu', $object);

			redirect('menu','refresh');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('menu/editMenu', $data);
		$this->load->view('templates/footer');

	}

	public function aksiTambahSubmenu()
	{
		$daput = $this->input->post();

		$this->db->insert('menu_sub', $daput);
		$submenu_id = $this->db->insert_id();

		$object  = [
			'rule_id' => 1,
			'submenu_id' => $submenu_id
		];

		$this->db->insert('akses_submenu', $object);

		redirect('menu','refresh');
	}

	public function updateSubmenu()
	{
		$daput = [
			'nama_submenu' => $this->input->post('nama_submenu'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'menu_id' => $this->input->post('menu_id'),
			'urutan' => $this->input->post('urutan'),
		];		

		$this->db->where('id_submenu', $this->input->post('id_submenu') );
		$this->db->update('menu_sub', $daput);
	
		redirect('menu','refresh');
	}

	public function aksiTambahMenu()
	{
		$daput = $this->input->post();

		$this->db->insert('menu', $daput);
		$menu_id = $this->db->insert_id();

		$object  = [
			'rule_id' => 1,
			'menu_id' => $menu_id
		];

		$this->db->insert('akses_menu', $object);

		redirect('menu','refresh');
	}

	public function deleteMenu($id, $kategori)
	{

		if ($kategori == '2' ) {
			$this->db->where('id_menu', $id);
			$this->db->delete('menu');

			$this->db->where('menu_id', $id);
			$this->db->delete('akses_menu');

		}else if ($kategori == '3'){
			$this->db->where('id_submenu', $id);
			$this->db->delete('menu_sub');
			
			$this->db->where('submenu_id', $id);
			$this->db->delete('akses_submenu');
		}

		redirect('menu','refresh');
	}

	public function hakAkses()
	{
		$data['judul'] = "Pengaturan hak akses";

		is_login();

		$data['user_rule']=$this->db->get_where('user_rule',['id_rule !=' => 1])->result();

		$stringQ = " SELECT h.`id_head`, h.`nama`, '1' AS kategori FROM menu_head  h ";
		$data['head'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.`id_menu`, s.`nama_menu`, '2' AS kategori FROM menu s ORDER BY s.`head_id`, s.`urutan` ";
		$data['menu'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.`id_submenu`, s.`nama_submenu`, s.`menu_id`, '3' AS kategori FROM menu_sub  s ";
		$data['sub_menu'] = $this->db->query($stringQ)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('menu/hak_akses', $data);
		$this->load->view('templates/footer');
	}

	public function beriAkses()
	{
		$sub_menu = $this->input->post('id_menu');
		$rule = $this->input->post('id_rule');
		$kategori = $this->input->post('kategori');

		if ($kategori == 3) {
			$daput = [
				'submenu_id' => $sub_menu,
				'rule_id' => $rule
			];

			$cek = $this->db->get_where('akses_submenu', $daput)->num_rows();

			if ($cek < 1 ) {
				$this->db->insert('akses_submenu', $daput);
			}else{
				$this->db->where($daput);
				$this->db->delete('akses_submenu');
			}
		}else {
			$daput = [
				'menu_id' => $sub_menu,
				'rule_id' => $rule
			];

			$cek = $this->db->get_where('akses_menu', $daput)->num_rows();

			if ($cek < 1 ) {
				$this->db->insert('akses_menu', $daput);
			}else{
				$this->db->where($daput);
				$this->db->delete('akses_menu');
			}
		}

	}

	public function user()
	{
		$data['judul'] = 'List User';
		$this->load->view('templates/header', $data);
		$this->load->view('menu/user', $data);
		$this->load->view('templates/footer');
	}

	function tampilUser()
	{

		$draw=$_REQUEST['draw'];
		$length=$_REQUEST['length'];
		$start=$_REQUEST['start'];
		$search=$_REQUEST['search']["value"];
		$total=$this->db->count_all_results("user_data");

		$output=array();
		
		$output['draw']=$draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();

		if($search!=""){
		$this->db->like("nama",$search);
		$this->db->or_like("nohp",$search);
		$this->db->or_like("email",$search);
		}

		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('nama','asc');
		$query=$this->db->get('user_data');

		if($search!=""){
		$this->db->like("nama",$search);
		$this->db->or_like("nohp",$search);
		$this->db->or_like("email",$search);
		$jum=$this->db->get('user_data');
		$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;
		foreach ($query->result_array() as $user) {
			$url = base_url('menu/ubah');
			$output['data'][]=array(
				'urut' => $nomor_urut, 
				'id_user' => $user['id_user'],
				'nama' => $user['nama'],
				'email' => $user['email'],
				'nohp' => $user['nohp'],
				'rule_id' => $user['rule_id']
			);

		$nomor_urut++;
		}

		echo json_encode($output);

	}

	function deleteUser($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user_data');

		redirect('menu/user','refresh');
	}

}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */