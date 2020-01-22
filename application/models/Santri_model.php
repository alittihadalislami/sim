<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Santri_model extends CI_Model {

	function santriPerKlub($id_klub)
	{
		return $this->db->get_where('t_klub', ['minat_id'=>$id_klub])->num_rows();
	}

	function anggotaKlub($id_klub)
	{
		$stringQ = " SELECT k.`santri_id`, s.`nama_santri`, s.`idk_mii`, m.`nama_minat`, m.`kategori_minat`, kl.`nama_kelas`
					FROM t_klub k JOIN m_santri s
					ON k.`santri_id` = s.`id_santri` JOIN t_minat m
					ON m.`id_minat` = k.`minat_id` JOIN t_agtkelas a
					ON a.`santri_id` = k.`santri_id` JOIN m_kelas kl
					ON kl.`id_kelas` = a.`kelas_id`
					WHERE k.`minat_id` = $id_klub
					GROUP BY s.`id_santri` ";
		return $this->db->query($stringQ)->result_array();
	}
}