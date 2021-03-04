<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Santri_model extends CI_Model {

	function santriPerKlub($id_klub)
	{
		return $this->db->get_where('t_klub', ['minat_id'=>$id_klub])->num_rows();
	}

	function anggotaKlub($id_klub,$tahun_id)
	{
		$stringQ = " SELECT k.`santri_id`, s.`nama_santri`, s.`idk_mii`, m.`nama_minat`, m.`kategori_minat`, kl.`nama_kelas`, w.`tra_tri`
					FROM t_klub k JOIN m_santri s
					ON k.`santri_id` = s.`id_santri` JOIN t_minat m
					ON m.`id_minat` = k.`minat_id` JOIN t_agtkelas a
					ON a.`santri_id` = k.`santri_id` JOIN m_kelas kl
					ON kl.`id_kelas` = a.`kelas_id` join t_wali w
					on kl.`id_kelas` = w.`kelas_id`
					WHERE k.`minat_id` = $id_klub
					AND a.`tahun_id` = $tahun_id
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

	public function santriRombelTratri($tahun, $rombel, $tra_tri)
	{
		/*$stringQ = "SELECT a.`santri_id`,s.`nisn`, s.`nama_santri`
					FROM t_agtkelas a JOIN m_santri s
					ON a.`santri_id` = s.`id_santri`
					WHERE a.`tahun_id` = $tahun
					AND a.`kelas_id`IN ( 
						SELECT k.`id_kelas`
						FROM m_kelas k JOIN t_wali w
						ON k.`id_kelas` = w.`kelas_id`
						WHERE w.`tahun_id` = $tahun
						AND k.`rombel` = $rombel
						AND w.`tra_tri` = '$tra_tri' 
						)";*/

		$stringQ = " SELECT a.`santri_id`,s.`nisn`, s.`nama_santri`, a.`kelas_id`, ROUND(SUM(n.`nrp`),0) AS nilai
			FROM t_agtkelas a JOIN m_santri s
			ON a.`santri_id` = s.`id_santri` JOIN t_na n
			ON n.`santri_id` = a.`santri_id`
			WHERE n.`tahun_id` = $tahun AND a.`tahun_id` = $tahun
			AND a.`kelas_id`IN ( 
				SELECT k.`id_kelas`
				FROM m_kelas k JOIN t_wali w
				ON k.`id_kelas` = w.`kelas_id`
				WHERE w.`tahun_id` = $tahun
				AND k.`rombel` = $rombel
				AND w.`tra_tri` = '$tra_tri' 
				)
			GROUP BY s.`id_santri`
			ORDER BY nilai DESC ";
		return $this->db->query($stringQ)->result_array();
	}

	public function rombelDiterima()
	{
		$stringQ = "SELECT k.`rombel`
					FROM m_kelas k
					WHERE k.`rombel` > 0
					AND k.`rombel` < 8
					GROUP BY k.`rombel`";
		return $this->db->query($stringQ)->result_array();
	}

	public function rekapSantri($tahun_id)
	{
		$stringQ = " SELECT a.`kelas_id`, k.`nama_kelas`, COUNT(a.`santri_id`) AS jumlah, k.`rombel`, k.`jenjang`, w.`tra_tri`
			FROM t_agtkelas a JOIN m_kelas k
			ON k.`id_kelas` = a.`kelas_id` JOIN t_wali w
			ON w.`kelas_id` = a.`kelas_id`
			WHERE a.`tahun_id` = $tahun_id 
			AND w.`tahun_id` = $tahun_id
			AND LENGTH(k.`nama_kelas`) > 1
			GROUP BY a.`kelas_id`
			ORDER BY k.`rombel`, k.`id_kelas` ";
		return $this->db->query($stringQ)->result_array();
	}

	public function dataUtamaDetail($tahun_id)
	{
		$stringQ = "SELECT ds.`santri_id`,s.`nama_santri`,k.`nama_kelas`,s.`nisn` AS nisn_wali, ds.`nama_seijazah`, ds.`nik`, ds.`nisn`, ds.`tmp_lahir`, ds.`tgl_lahir`, ds.`anak_ke`, ds.`jml_saudara`, ds.`seri_ijazah`, ds.`seri_skhun`, ds.`no_ujian`, ds.`ibu`, ds.`bapak`, ds.`tgl_terima`
			FROM t_detail_santri ds JOIN t_agtkelas ak
			ON ds.`santri_id` = ak.`santri_id` JOIN m_santri s
			ON ds.`santri_id` = s.`id_santri` JOIN m_kelas k
			ON ak.`kelas_id` = k.`id_kelas`
			WHERE ak.`tahun_id` = $tahun_id AND k.`jenjang` != 0
			ORDER BY k.`nama_kelas`, s.`nama_santri`";
		return $this->db->query($stringQ)->result_array();
	}
}