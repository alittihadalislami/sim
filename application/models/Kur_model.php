<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kur_model extends CI_Model {

	function ngajar($tahun_id)
	{
		$stringQ = "SELECT g.`id_mengajar`, g.`mapel_id`, g.`asatid_id`, g.`kelas_id`, g.`tahun_id`, m.`nama_mapel`, a.`nama_asatid`, k.`nama_kelas`
			FROM `m_mengajar` g LEFT JOIN m_mapel m
			ON m.`id_mapel` = g.`mapel_id` LEFT JOIN m_asatid a
			ON a.`id_asatid` = g.`asatid_id` LEFT JOIN m_tahun t
			ON t.`id_tahun` = g.`tahun_id` LEFT JOIN m_kelas k
			ON k.`id_kelas` = g.`kelas_id`
			WHERE g.`tahun_id` = $tahun_id";
		return $this->db->query($stringQ)->result_array();
	}

	public function kbm($tahun_id)
	{
		$stringQ =" SELECT b.*,a.`nama_asatid`, k.`nama_kelas`, p.`nama_mapel`
					FROM t_kbm b JOIN m_asatid a
					ON b.`id_asatid` = a.`id_asatid` JOIN m_kelas k
					ON b.`id_kelas` = k.`id_kelas` JOIN m_mapel p
					ON b.`id_mapel` = p.`id_mapel`
					WHERE b.`id_tahun` = $tahun_id ";
		return $this->db->query($stringQ)->result_array();
	}
}