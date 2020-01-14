<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
		
	var $data=[];

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('User_model','um');

	}

	public function index()
	{
		is_login();
		$data['judul'] = 'Menejemen menu';

		$stringQ = " SELECT h.`id_head`, h.`nama`, '1' AS kategori FROM menu_head  h ";
		$data['head'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.`id_menu`, s.`nama_menu`, '2' AS kategori FROM menu s ORDER BY s.`head_id`, s.`urutan` ";
		$data['menu'] = $this->db->query($stringQ)->result();

		$stringQ = " SELECT s.`id_submenu`, s.`nama_submenu`, s.`menu_id`, '3' AS kategori FROM menu_sub  s ";
		$data['sub_menu'] = $this->db->query($stringQ)->result();

		// var_dump($data['sub_menu']);die();

		$this->load->view('templates/header', $data);
		$this->load->view('menu/home_menu', $data);
		$this->load->view('templates/footer');
	}

	public function tambahMenu()
	{

		$data['judul'] = "Tambah Data";

		
		$this->load->view('templates/header', $data);
		$this->load->view('menu/tambahMenu', $data);
		$this->load->view('templates/footer');
	}

	public function aksiTambahSubmenu()
	{
		$daput = $this->input->post();
		var_dump($daput);

		$this->db->insert('menu_sub', $daput);
		$submenu_id = $this->db->insert_id();

		$object  = [
			'rule_id' => 1,
			'submenu_id' => $submenu_id
		];

		$this->db->insert('akses_submenu', $object);
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

		//redirect('menu','refresh')
	}

}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */