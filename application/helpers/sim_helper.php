<?php

function is_login()
{
	$ci = get_instance();
	
	if (!$ci->session->userdata('email') and ($ci->uri->segment(1) != 'auth'))
	{
		redirect('auth','refresh');
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

function is_boleh()
{
	$ci = get_instance();
}
