<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	function showMapel($jenjang=null)
	{
		if ($jenjang==null) {
			$jenjang = 'mii';
		}
		$stringQ = "SELECT u.`mapel_id`,u.`urut_$jenjang`,m.`nama_mapel` ,m.`mapel_alias`
					FROM t_urutmapel AS u JOIN m_mapel m
					ON u.`mapel_id` = m.`id_mapel`
					WHERE u.`urut_$jenjang` IS NOT NULL
					ORDER BY u.`urut_$jenjang`";
		return $this->db->query($stringQ)->result_array();
	}

	public function anggotaKelas($kelas, $tahun)
	{
		$stringQ="SELECT k.`santri_id`
				FROM t_agtkelas AS k
				WHERE k.`kelas_id`=$kelas AND k.`tahun_id`=$tahun ";
		return $this->db->query($stringQ)->result_array();
	}

	function nilai($tahun_id, $kelas_id, $jenjang, $kd)
	{
		$stringQ = "SELECT h.`mapel_id`, h.`santri_id`, ROUND(AVG(h.`nilai_$kd`)) AS rata_$kd
					FROM t_nh AS h JOIN t_urutmapel AS u
					ON h.`mapel_id` = u.`mapel_id`
					WHERE h.`tahun_id`=$tahun_id AND h.`kelas_id` =$kelas_id AND u.`urut_$jenjang` IS NOT NULL
					GROUP BY h.`santri_id`, h.`mapel_id`
					ORDER BY u.`urut_$jenjang`, h.`santri_id` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	function nilaiUjian($tahun, $kelas, $jenjang)
	{
		$stringQ = "SELECT a.`mapel_id`, a.`santri_id`, a.`nkh`, a.`nhr`, a.`pts`, a.`pas`
					FROM t_na AS a JOIN t_urutmapel AS u
					ON a.`mapel_id` = u.`mapel_id`
					WHERE a.`tahun_id`=$tahun AND a.`kelas_id`=$kelas
					AND u.`urut_$jenjang` IS NOT NULL
					ORDER BY a.`santri_id`,u.`urut_$jenjang` ASC";
		return $this->db->query($stringQ)->result_array();
	}

	public function kkm($rombel, $mapel, $tahun)
	{
		$stringQ=" SELECT d.`kelas_id`, d.`mapel_id`, d.`kkm`
					FROM t_kd AS d
					WHERE d.`rombel`=$rombel AND d.`mapel_id` = $mapel
					AND d.`tahun_id`=$tahun
					LIMIT 1 ";
		$hasil = $this->db->query($stringQ)->row_array();
		return $hasil['kkm'];
	}

	public function minmax($tahun, $kelas, $kd='p')
	{
		$stringQ= " SELECT dk.`mapel_id`, dk.`kelas_id`, dk.`tahun_id`, MIN(dk.`$kd`) as min
					FROM t_dkn_raport AS dk
					WHERE dk.`kelas_id`=$kelas AND dk.`tahun_id` =$tahun  AND dk.`$kd` > 2
					GROUP BY dk.`mapel_id` ";
		$min = $this->db->query($stringQ)->result_array();

		$stringQ= " SELECT dk.`mapel_id`, dk.`kelas_id`, dk.`tahun_id`, MAX(dk.`$kd`) as max
					FROM t_dkn_raport AS dk
					WHERE dk.`kelas_id`=$kelas AND dk.`tahun_id` =$tahun  AND dk.`$kd` > 2
					GROUP BY dk.`mapel_id` ";
		$max = $this->db->query($stringQ)->result_array();

		return array_merge($min,$max);
	}

	function ambilSiswaBawahKkm($kelas, $mapel, $tahun){
		$stringQ = " SELECT d.`id_dkn_raport`, d.`p`, d.`k`
					FROM t_dkn_raport d
					WHERE d.`kelas_id`=$kelas AND d.`mapel_id`=$mapel AND d.`tahun_id`=$tahun
					AND d.`k` IS NOT NULL AND d.`p` IS NOT NULL ";
		return $this->db->query($stringQ)->result_array();
	}

	public function dknRaport($kelas, $tahun, $jenjang)
	{
		$stringQ = " SELECT a.*
					FROM t_dkn_raport AS a JOIN t_urutmapel AS u
					ON a.`mapel_id` = u.`mapel_id`
					WHERE a.`tahun_id`=$tahun AND a.`kelas_id`=$kelas
					AND u.`urut_$jenjang` IS NOT NULL
					ORDER BY a.`santri_id`,u.`urut_$jenjang` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	public function sudahAdaKonfersi($kelas, $tahun)
	{
		$stringQ = " SELECT r.`id_dkn_raport`
					FROM t_dkn_raport AS r
					WHERE r.`kelas_id` = $kelas AND r.`tahun_id` = $tahun
					LIMIT 1 ";
		return $this->db->query($stringQ)->row_array();
	}

	public function minmaxKd($tahun, $mapel, $santri)
	{
		$stringQ= " SELECT h.`mapel_id`, h.`kelas_id`, h.`tahun_id`, h.`urut_kd`, h.`nilai_kdp`, h.`nilai_kdk`, h.`nilai_suluk`
				FROM t_nh AS h
				WHERE h.`tahun_id`=$tahun AND h.`mapel_id`=$mapel AND h.`santri_id`=$santri ";
		return $this->db->query($stringQ)->result_array();
	}

	public function pilihDeskripsiKD($tahun, $mapel, $rombel, $urut, $kd='p')
	{
		if ($kd == 'p') {
			$kolom = 'p';
		}else{
			$kolom = 'k';
		}
		
		$stringQ="SELECT d.`urut`, d.`kd$kolom`
				FROM t_kd AS d
				WHERE d.`tahun_id`=$tahun AND d.`rombel`=$rombel AND d.`mapel_id`=$mapel AND d.`urut`=$urut";
		return $this->db->query($stringQ)->row_array();
	}

	function deskripSikap($santri, $tahun){
		$stringQ = " SELECT ROUND(AVG(h.`nilai_suluk`),0) AS suluk
						FROM t_nh AS h
						WHERE h.`santri_id`=$santri AND h.`tahun_id`=$tahun
						AND h.`nilai_suluk` IS NOT NULL ";
		$suluk = $this->db->query($stringQ)->row_array();

		$stringQ = " SELECT a.`mapel_id`, a.`nilai_suluk` AS suluk
					FROM t_nh AS a
					WHERE (a.`mapel_id`=3 OR a.`mapel_id`=2) AND a.`santri_id`=414
					GROUP BY a.`mapel_id` ";
		$sulukAkidah = $this->db->query($stringQ)->result_array();

		$data = [$suluk, $sulukAkidah]; 
		
		return $data;
	}

	public function nilaiExtra($santri, $tahun, $jenjang) //Baca Kitap(Sorogan) dan Literasi(bahasa indo)
	{
		if ($jenjang == 'ma') {
			$mapel_id = 30;
		}else{
			$mapel_id = 5;
		}

		$stringQ = " SELECT ROUND((a.`nkh`+a.`nhr`+a.`pts`+a.`pas`)/4,0) AS nrp
					FROM t_na AS a
					WHERE a.`santri_id`=$santri AND a.`tahun_id`=$tahun AND a.`mapel_id`=$mapel_id ";
		return  $this->db->query($stringQ)->row_array();
	}

	public function nilaiWali($santri, $tahun)
	{
		$stringQ = " SELECT *
					FROM `t_entriwali` AS a
					WHERE a.`santri_id`=$santri AND a.`tahun_id`=$tahun  ";
		return  $this->db->query($stringQ)->row_array();
	}

	public function showJenjang($santri, $tahun)
	{
		$stringQ = " SELECT k.`jenjang`
					FROM t_agtkelas g JOIN m_kelas k
					ON g.`kelas_id` = k.`id_kelas`
					WHERE g.`santri_id` = $santri AND g.`tahun_id`= $tahun ";
		$data = $this->db->query($stringQ)->row_array();
		if ($data['jenjang'] == 1) {
		 	return 'smp';
		} else {
			return 'ma';
		}
	}

	public function nomorSantri($id_santri)
	{
		$this->db->select('idk_umum, nisn');
		$this->db->where('id_santri', $id_santri);
		return $this->db->get('m_santri')->row_array();
	}

	public function jenjangKelas($kelas)
	{
		$this->db->select('jenjang');
		$hasil =  $this->db->get_where('m_kelas', ['id_kelas'=>$kelas])->row_array();
		
		if ($hasil['jenjang'] == '1') {
			$jenjangKelas = 'smp';
		}else{
			$jenjangKelas = 'ma';
		}

		return $jenjangKelas;
	}
	
	public function identitas($id_santri)
	{
		$stringQ = " SELECT 
						d.`nama_seijazah`,
						CONCAT(d.`nisn`,' / ', d.`nik`) AS nomor,
						CONCAT(d.`tmp_lahir`,', ',d.`tgl_lahir`) AS tgl,
						'l' AS jenis_kel,
						'Islam' AS agama,
						d.`anak_ke`,
						'Anak Kandung' AS status_kel,
						d.`alamat_ortu` AS alamat,
						d.`hp_ibu` AS hpdianak,
						NULL AS diterima,
						d.`kelas_terima`,
						d.`tgl_terima`,
						d.`semester_terima`,
						NULL AS ket_sekolah_asal,
						d.`sekolah_asal`,
						d.`npsn`,
						NULL AS ijasah,
						d.`tahun_ijazah`,
						d.`seri_ijazah`,
						NULL AS skhu,
						d.`tahun_ijazah` AS 'tahun skhu',
						d.`seri_skhun`,
						NULL AS ortu,
						d.`bapak_seijazah`,
						d.`ibu`,
						d.`alamat_ortu` AS ortu18,
						d.`hp_bapak` AS 18a,
						NULL AS kerja,
						d.`kerja_bapak`,
						d.`kerja_ibu`,
						NULL AS wali,
						NULL AS alamat_wali,
						NULL AS tlp_wali,
						NULL AS kerj_wali
					FROM t_detail_santri d
					WHERE d.`santri_id` = $id_santri
					";
		return $this->db->query($stringQ)->result_array();
	}

	public function jenjangTratri($kelas_id)
	{
		$stringQ = "
					SELECT k.`jenjang`, w.`tra_tri`
					FROM t_wali w JOIN m_kelas k
					ON k.`id_kelas`= w.`kelas_id`
					WHERE k.`id_kelas` = $kelas_id
					GROUP BY k.`id_kelas`
		";
		return $this->db->query($stringQ)->row_array();
	}


}

/* End of file Raport_model.php */
/* Location: ./application/models/Raport_model.php */