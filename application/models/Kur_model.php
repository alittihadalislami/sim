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
}