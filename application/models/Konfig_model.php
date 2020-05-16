<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfig_model extends CI_Model {

	function listCopyWali()
	{
		$stringQ = "SELECT w.kelas_id, w.asatid_id, w.tra_tri, (SELECT MAX(m_tahun.`id_tahun`) FROM `m_tahun`) AS tahun_id 
			FROM t_wali w WHERE w.`tahun_id` = (SELECT MAX(m_tahun.`id_tahun`)-1 FROM `m_tahun`)";
		return $this->db->query($stringQ)->result();
	}
}