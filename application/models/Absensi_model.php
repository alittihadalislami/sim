<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

	public function jadwalHariIni($hari,$asatid_id,$tahun_id)
	{
		$stringQ = " SELECT k.*, a.`nama_asatid`, m.`mapel_alias`, l.`nama_kelas`
					FROM t_kbm k JOIN `m_asatid` a 
					ON k.`id_asatid` = a.`id_asatid` JOIN m_mapel m
					ON m.`id_mapel` = k.`id_mapel` JOIN m_kelas l
					ON l.`id_kelas` = k.`id_kelas`
					WHERE k.`hari` = '$hari' AND a.`id_asatid` = '$asatid_id' AND k.`id_tahun` = $tahun_id
					ORDER BY k.`jamke`, l.`nama_kelas` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	public function cekPegewai($id)
	{
		$stringQ=" SELECT *
					FROM m_asatid a
					WHERE a.`kategori`= 2
					AND a.`id_asatid` = $id ";
		return $this->db->query($stringQ)->result();
	}

	public function detailKbm($id_kbm)
	{
		return $this->db->get_where('t_kbm', ['id_kbm'=>$id_kbm])->row_array();
	}

	public function cekJurnal($id_kbm, $tanggal)
	{
		$this->db->select('*');
		$this->db->where('kbm_id' , $id_kbm);
		$this->db->where('tgl' , $tanggal);
		return $this->db->get('t_jurnal')->row_array();
	}

	public function cekAbsensi($jurnal_id, $santri_id)
	{
		$this->db->select('id_absensi, absen');
		$this->db->where('jurnal_id' , $jurnal_id);
		$this->db->where('santri_id' , $santri_id);
		return $this->db->get('t_absensi')->row_array();
	}

	public function rekapSemua()
	{
		$stringQ = " SELECT k.`id_asatid`, j.`id_jurnal`, j.`kbm_id`, j.`tgl` AS waktu,
					SUBSTRING_INDEX(j.`tgl`,',',1) AS hari,
					SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`,' ',2),' ' ,-1) AS tgl,
					SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`,' ',3),' ' ,-1) AS bulan,
					SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`,' ',4),' ' ,-1) AS tahun,
					j.`materi`, k.`id_kelas`, k.`jamke`, k.`id_mapel`
				FROM t_jurnal j INNER JOIN t_kbm k
				ON j.`kbm_id` = k.`id_kbm`
				WHERE k.`id_kbm` != 30 AND k.`id_kbm` != 43
				GROUP BY j.`tgl`, k.`id_mapel`, k.`jamke`
				HAVING bulan = 'November'
				ORDER BY k.`id_asatid`, tgl ";
		return $this->db->query($stringQ)->result_array();
	}

	public function tglHadir($asatid_id, $bulan, $tahun)
	{
		$stringQ = " SELECT ra.`id_asatid`, ra.`waktu`, ra.`hari`, ra.`tgl`, ra.`bulan`, ra.`tahun`
					FROM v_rekap_asatid ra
					WHERE ra.`id_asatid` = '$asatid_id' 
					AND ra.`bulan` = '$bulan'
					AND ra.`tahun` = '$tahun'
					GROUP BY ra.`waktu`
					ORDER BY ra.`bulan` ASC  "; 
		return $this->db->query($stringQ)->result_array();
	}

	public function waktuHadir($id_asatid, $waktu)
	{
		$stringQ = " SELECT ra.`id_asatid`, ra.`waktu`, ra.`id_kelas`, ra.`jamke`,ra.`id_mapel`
					FROM v_rekap_asatid ra
					WHERE ra.`id_asatid` = '$id_asatid'
					AND ra.`waktu` = '$waktu'
					ORDER BY ra.`jamke` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	public function listBulanAbsen()
	{
		$stringQ = " SELECT DISTINCT(ra.`bulan`), ra.`tahun`
					FROM v_rekap_asatid AS ra
					ORDER BY ra.`tahun`, ra.`bulan` ASC ";
		return $this->db->query($stringQ)->result();
	}

}

/* End of file Absensi_model.php */
/* Location: ./application/models/Absensi_model.php */