<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Santri_model extends CI_Model {

	function santriPerKlub($id_klub)
	{
		return $this->db->get_where('t_klub', ['minat_id'=>$id_klub])->num_rows();
	}

	function anggotaKlub($id_klub)
	{
		$stringQ = " SELECT k.`santri_id`, s.`nama_santri`, s.`idk_mii`, m.`nama_minat`, m.`kategori_minat`, kl.`nama_kelas`, w.`tra_tri`
					FROM t_klub k JOIN m_santri s
					ON k.`santri_id` = s.`id_santri` JOIN t_minat m
					ON m.`id_minat` = k.`minat_id` JOIN t_agtkelas a
					ON a.`santri_id` = k.`santri_id` JOIN m_kelas kl
					ON kl.`id_kelas` = a.`kelas_id` join t_wali w
					on kl.`id_kelas` = w.`kelas_id`
					WHERE k.`minat_id` = $id_klub
					GROUP BY s.`id_santri` ";
		return $this->db->query($stringQ)->result_array();
	}

	public function klubTerpilih($santri_id, $minat_id)
	{
		$data = [
			'santri_id' => $santri_id,
			'minat_id' => $minat_id
		];
		return $this->db->get_where('t_klub', $data)->num_rows();
	}

	public function kelasSantri($tahun,$kelas)
	{
		$stringQ = "SELECT s.`id_santri`,s.`nisn`, s.`nama_santri`
					FROM t_agtkelas a JOIN m_santri s
					ON a.`santri_id` = s.`id_santri`
					WHERE a.`tahun_id` = $tahun
					AND a.`kelas_id` = $kelas";
		return $this->db->query($stringQ)->result_array();
	}
}