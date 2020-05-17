<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfig_model extends CI_Model {

	function listCopyWali()
	{
		$stringQ = "SELECT w.kelas_id, w.asatid_id, w.tra_tri, (SELECT MAX(m_tahun.`id_tahun`) FROM `m_tahun`) AS tahun_id 
			FROM t_wali w WHERE w.`tahun_id` = (SELECT MAX(m_tahun.`id_tahun`)-1 FROM `m_tahun`)";
		return $this->db->query($stringQ)->result();
	}

	function mapelMii6()
	{
		$stringQ = "SELECT m.`id_mapel`
			FROM t_kbm k JOIN m_mapel m
			ON m.`id_mapel` = k.`id_mapel`
			WHERE k.`id_tahun` = 2 AND k.`id_kelas` = 24 AND m.`id_mapel` != 43
			GROUP BY m.`id_mapel`";
		return $this->db->query($stringQ)->result_array();
	}

	function cekNilaiMii6($tahun_id, $mapel_id)
	{
		$stringQ = "SELECT a.`kelas_id`, COUNT(a.`nkh`) AS nhk, COUNT(a.`nhr`) AS nhr, COUNT(a.`pts`) AS pts, COUNT(a.`pas`) AS pas, COUNT(a.`nrp`) AS nrp
			FROM t_na a
			WHERE a.`tahun_id` = $tahun_id AND a.`kelas_id` IN (12,13,24)
			AND a.`mapel_id` = $mapel_id
			GROUP BY a.`kelas_id`";
		return $this->db->query($stringQ)->result_array();
	}

	function deleteDuplikat()
	{
		$stringQ = " DELETE FROM t_nilai_ijz
						WHERE `t_nilai_ijz`.`id_nilai` NOT IN 
						(
							SELECT MAX(n.`id_nilai`)
							FROM t_nilai_ijz n
							GROUP BY n.`mapel_id`, n.`tahun_id`, n.`santri_id`
						)";
		$this->db->query($stringQ);
		return $this->db->affected_rows();
	}
}