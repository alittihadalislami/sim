<?php

function is_login()
{
	$ci = get_instance();
	
	if (!$ci->session->userdata('email') and ($ci->uri->segment(1) != 'auth'))
	{
		redirect('auth','refresh');
	}

	if($ci->session->userdata('email') && ($ci->uri->segment(1) == ''))
	{
		redirect('dashboard','refresh');
	}
		
	if($ci->session->userdata('email') && ($ci->uri->segment(1) == 'auth'))
	{
		redirect('dashboard','refresh');
	}

}

function is_ngajar()
{
	$ci = get_instance();
	$ci->load->model('User_model','um');

	$tahunAktif = $ci->um->tahunAktif()['id_tahun'];
	$nohp = $ci->um->dataAktif($ci->session->userdata('email'))['nohp'];
	$mapel = $ci->um->ngajarApa($nohp,$tahunAktif);
	
	$uri_asatid = $ci->uri->segment(3);
	$uri_mapel = $ci->uri->segment(4);
	$uri_kelas = $ci->uri->segment(5);

	$point=0;
	foreach ($mapel as $m) {
		if ( ($m['id_asatid'] == $uri_asatid) && ($m['id_mapel'] == $uri_mapel) && ($m['id_kelas'] == $uri_kelas) ) {
		 	$point = 1;
 		}
	}
 	
 	if ($point < 1) {
 		redirect('dashboard','refresh');
 	}
}

function is_uamii()
{
	$ci = get_instance();
	$ci->load->model('User_model','um');
	$tahunAktif = $ci->um->tahunAktif()['id_tahun'];

	$email = '"'.$ci->session->userdata('email').'"';


	$guruKelas6 = $ci->um->guruKelas6("$email","$tahunAktif");
	
	if ($guruKelas6 < 1) {
 		redirect('dashboard','refresh');
 	}

}

function is_boleh()
{
	$ci = get_instance();

	$ci->load->model('User_model','um');
	$id_user = $ci->um->dataAktif($ci->session->userdata('email'))['id_user'];
	
	$rules = $ci->db->select("rule_id")->get_where('user_dapat_rule', ['user_id'=>$id_user])->result_array();

	$url_menu = $ci->uri->segment(1);

	$ci->db->select('id_menu');
	$id_menu = $ci->db->get_where('menu', ['url LIKE '=> "$url_menu%"])->row_array();

	$akses_menu = 0;
	foreach ($rules as $rule) {
		$where = [
			'rule_id' => $rule['rule_id'],
			'menu_id' => $id_menu['id_menu']
		];

		$akses_menu += $ci->db->get_where('akses_menu',$where)->num_rows();
	} 

	if ($akses_menu < 1) {
		redirect('My404','refresh');
	}
}
