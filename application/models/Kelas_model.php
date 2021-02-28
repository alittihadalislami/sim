<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	public function santri($tahun_id = 3, $wali=null)
	{
		if ($wali == null) {
			$this->db->select('m_santri.id_santri, m_santri.idk_mii, m_santri.idk_umum, m_santri.idk_umum2, m_santri.nama_santri, m_kelas.nama_kelas');
			$this->db->from('m_santri');
			$this->db->join('t_agtkelas', 't_agtkelas.santri_id = m_santri.id_santri');
			$this->db->join('m_kelas', 't_agtkelas.kelas_id = m_kelas.id_kelas');
			$this->db->where('t_agtkelas.tahun_id', $tahun_id);
			return $this->db->get();
		}else{
			$this->db->select('m_santri.id_santri, m_santri.idk_mii, m_santri.idk_umum, m_santri.idk_umum2, m_santri.nama_santri, m_kelas.nama_kelas');
			$this->db->from('m_santri');
			$this->db->join('t_agtkelas', 't_agtkelas.santri_id = m_santri.id_santri');
			$this->db->join('m_kelas', 't_agtkelas.kelas_id = m_kelas.id_kelas');
			$this->db->where('t_agtkelas.tahun_id', $tahun_id);
			$this->db->where('t_agtkelas.kelas_id', $wali);
			return $this->db->get();
		}
	}

	public function indukAkhir()
	{

		$stringQ = " SELECT MAX( DISTINCT( s.`idk_mii`)) AS mii, MAX( DISTINCT( s.`idk_umum`)) AS smp, MAX( DISTINCT( s.`idk_umum2`)) AS ma
			FROM m_santri s ";

		return $induk = $this->db->query($stringQ)->row_array();
	}

	function idSantriAkhir()
	{
		$stringQ = "SELECT s.id_santri AS id_santri
					FROM m_santri s ORDER BY s.`id_santri` DESC LIMIT 1";
		$id_santri = $this->db->query($stringQ)->row_array();
		return $id_santri['id_santri'];
	}

	public function adaDetail($id)
	{
		return $this->db->get_where('t_detail_santri', ['santri_id'=>$id])->num_rows();
	}

	public function detailTerisi()
	{
		$stringQ = " SELECT d.`santri_id`,
						IF( d.`nik` IS NULL || d.`nik` = '', 0,1)
						+ IF( d.`nok` IS NULL || d.`nok` = '', 0,1) 
						+ IF( d.`tmp_lahir` IS NULL || d.`tmp_lahir` = '', 0,1)
						+ IF( d.`tgl_lahir` IS NULL || d.`tgl_lahir` = '', 0,1) 
						+ IF( d.`anak_ke` IS NULL || d.`anak_ke` = '', 0,1) 
						+ IF( d.`jml_saudara` IS NULL || d.`jml_saudara` = '', 0,1) 
						+ IF( d.`bapak` IS NULL || d.`bapak` = '', 0,1) 
						+ IF( d.`kerja_bapak` IS NULL || d.`kerja_bapak` = '', 0,1) 
						+ IF( d.`ibu` IS NULL || d.`ibu` = '', 0,1)
						+ IF( d.`kerja_ibu` IS NULL || d.`kerja_ibu` = '', 0,1)
						+ IF( d.`alamat_ortu` IS NULL || d.`alamat_ortu` = '', 0,1)
						+ IF( d.`nama_seijazah` IS NULL || d.`nama_seijazah` = '', 0,1) 
						+ IF( d.`bapak_seijazah` IS NULL || d.`bapak_seijazah` = '', 0,1) 
						+ IF( d.`nisn` IS NULL || d.`nisn` = '', 0,1) 
						+ IF( d.`no_ujian` IS NULL || d.`no_ujian` = '', 0,1) 
						+ IF( d.`nilai_ijazah` IS NULL || d.`nilai_ijazah` = '', 0,1)
						+ IF( d.`seri_ijazah` IS NULL || d.`seri_ijazah` = '', 0,1)
						+ IF( d.`seri_skhun` IS NULL || d.`seri_skhun` = '', 0,1)
						+ IF( d.`tahun_ijazah` IS NULL || d.`tahun_ijazah` = '', 0,1)
						+ IF( d.`sekolah_asal` IS NULL || d.`sekolah_asal` = '', 0,1)
						+ IF( d.`npsn` IS NULL || d.`npsn` = '', 0,1)
						+ IF( d.`tgl_terima` IS NULL || d.`tgl_terima` = '', 0,1)
						+ IF( d.`kelas_terima` IS NULL || d.`kelas_terima` = '', 0,1)
						+ IF( d.`semester_terima` IS NULL || d.`semester_terima` = '', 0,1)
						+ IF( d.`hp_bapak` IS NULL || d.`hp_bapak` = '', 0,1)
						+ IF( d.`hp_ibu` IS NULL || d.`hp_ibu` = '', 0,1)
						AS isian
					FROM t_detail_santri d ";
		return $this->db->query($stringQ)->result_array();
	}

	public function santriIjz($tahun_id)
	{
		$stringQ = " SELECT s.`id_santri`, s.`idk_mii`, s.`idk_umum`, s.`nisn`, s.`nama_santri`, k.`nama_kelas`
			FROM t_agtkelas a JOIN m_santri s 
			ON a.`santri_id` = s.`id_santri` JOIN m_kelas k
			ON k.`id_kelas` = a.`kelas_id`
			WHERE a.`tahun_id` = $tahun_id && k.`rombel` = 6 ";
		return $this->db->query($stringQ)->result_array();
	}

	public function nilaiIjz($santri_id, $mapel_id, $tahun_id)
	{
		$stringQ = " SELECT * 
					FROM t_nilai_ijz 
					WHERE santri_id = $santri_id and mapel_id = $mapel_id and tahun_id = $tahun_id ";
		return $this->db->query($stringQ)->row_array();
	}

	public function adaNilaiIjz($id_mapel,$id_santri)
	{
		return $this->db->get_where('t_nilai_ijz', ['mapel_id'=>$id_mapel, 'santri_id'=>$id_santri])->row_array();
	}

	public function sulukIjz()
	{
		$stringQ = " SELECT	`santri_id`, ROUND(AVG(slk),1) slk
					FROM t_nilai_ijz 
					GROUP BY santri_id ";
		return $this->db->query($stringQ)->result_array();
	}

	public function hitungRatarataRaport($id_tahun_aktif, $rombel=6)
	{
		$id_tahun_hitung = "";

		$max = 5; // jumlah semester maksimal yang dihitung
		for ($i=$id_tahun_aktif-1 ; $i>0 ; $i--) { 
			$id_tahun_hitung .= $i;
			$max = $max - 1;
			$pemisah=',';
			if ($max == 0 || $i == 1) {
				break;
			}
			$id_tahun_hitung .= $pemisah;
		}

		$stringQ = " SELECT CONCAT(a.`tahun_id`, n.`santri_id` , n.`mapel_id`) AS id_nilai, n.`mapel_id`, n.`santri_id`,a.`tahun_id`, ROUND(AVG(n.`nrp`),0) AS nrp
					FROM t_na n JOIN t_agtkelas a
					ON a.`santri_id` = n.`santri_id` JOIN m_kelas k
					ON k.`id_kelas` = a.`kelas_id` 
					WHERE a.`tahun_id` = $id_tahun_aktif
					AND k.`rombel` = $rombel
					AND n.`tahun_id` IN ($id_tahun_hitung)
					GROUP BY n.`mapel_id`, n.`santri_id` ";
		return $this->db->query($stringQ)->result_array();
	}

}