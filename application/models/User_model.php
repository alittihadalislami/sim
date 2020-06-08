<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function dataAktif($email)
	{ /*ambil data tabel user dari email login*/
		$stringQ = " SELECT d.`id_user`, d.`nama`, d.`email`, d.`foto`, d.`is_active`, d.`date_created`, r.`id_rule`, r.`nama_rule`, d.`nohp`, a.`kategori`
					FROM `user_data` d JOIN `user_rule` r
					ON d.`rule_id` = r.`id_rule` LEFT JOIN m_asatid a
					on a.`nohp` = d.`nohp`
					WHERE d.`email` = '$email' ";
		return $this->db->query($stringQ)->row_array();
	}

	function multipleRule($user_id){
		$this->db->select('rule_id');
		return $this->db->get_where('user_dapat_rule', ['user_id'=>$user_id])->result_array();
	}

	function daftarHeading($rule_id)
	{
		$stringQ = " SELECT DISTINCT(h.`id_head`), h.`nama` AS nama_head
						FROM `menu_head` h JOIN `menu` m
						ON h.`id_head`= m.`head_id` JOIN akses_menu a
						ON a.`menu_id`= m.`id_menu`
						WHERE a.`rule_id` IN ($rule_id)
						ORDER BY h.`urutan` ASC
						 ";
		return $this->db->query($stringQ)->result_array();
	}

	function daftarMenu($rule_id)
	{
		$stringQ = " SELECT h.`id_head`, m.`id_menu`, m.`nama_menu`, m.`url`, m.`icon`
					FROM akses_menu a JOIN menu m
					ON a.`menu_id` = m.`id_menu` JOIN `menu_head` h
					ON h.`id_head` = m.`head_id`
					WHERE a.`rule_id` IN ($rule_id)
					ORDER BY m.`urutan` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	function daftarSubmenu($rule_id)
	{
		$stringQ = " SELECT s.`id_submenu`, s.`nama_submenu`, s.`url`, s.`icon`, s.`menu_id`
					FROM `menu_sub` s JOIN `akses_submenu` asm
					ON s.`id_submenu`=asm.`submenu_id`
					WHERE asm.`rule_id` IN ($rule_id)
					ORDER BY s.`urutan` ASC ";
		return $this->db->query($stringQ)->result_array();
	}
	function adaSubmenu($rule_id, $menu_id)
	{
		$stringQ = " SELECT COUNT(s.`id_submenu`) AS submenu
					FROM `menu_sub` s JOIN `akses_submenu` asm
					ON s.`id_submenu`=asm.`submenu_id`
					WHERE asm.`rule_id` = $rule_id AND s.`menu_id` = $menu_id ";
		return $this->db->query($stringQ)->row_array();
	}

	function ngajarApa($nohp, $idTAhunSemeseter)
	{
		$stringQ = " SELECT p.`id_mapel`, k.`id_kelas`, k.`rombel`, a.`id_asatid`, k.`nama_kelas`, p.`nama_mapel`, a.`nama_asatid`
					FROM m_mengajar m JOIN m_mapel p
					ON m.`mapel_id`= p.`id_mapel` JOIN m_kelas k
					ON m.`kelas_id` = k.`id_kelas` JOIN m_asatid a
					ON a.`id_asatid` = m.`asatid_id`
					WHERE a.`nohp` = $nohp AND m.`tahun_id` = $idTAhunSemeseter
					ORDER BY p.`nama_mapel`,k.`nama_kelas` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	function santriKelas($idkelas ,$id_tahun)
	{
		$stringQ = "SELECT s.`id_santri`, s.`idk_mii`, s.`nama_santri`
					FROM t_agtkelas k JOIN m_santri s
					ON k.`santri_id` = s.`id_santri`
					WHERE k.`kelas_id` = $idkelas and k.`tahun_id` = $id_tahun 
					ORDER BY s.`nama_santri` ";
		return  $this->db->query($stringQ)->result_array();
	}

	function tahunAktif(){
		$this->db->where('is_active', 1);
		return $this->db->get('m_tahun')->row_array();
	}

	function arsipKD($rombel, $mapel_id, $semester)
	{
		$stringQ = " SELECT DISTINCT(d.`kdp`), d.`kdk`, d.`tahun_id`, d.`id_kd` 
					FROM t_kd d 
					WHERE d.`rombel` = $rombel AND d.`mapel_id` = $mapel_id  
					AND d.`tahun_id` IN (SELECT id_tahun FROM m_tahun t WHERE t.`semester` = $semester)";
		return $this->db->query($stringQ)->result_array();
	}

	function kdTersedia($id_mapel, $id_kelas, $id_tahun)
	{
		$this->db->select('kelas_id, mapel_id, kdp, kdk, kkm');
		$this->db->where('mapel_id', $id_mapel);
		$this->db->where('kelas_id', $id_kelas);
		$this->db->where('tahun_id', $id_tahun);
		return $this->db->get('t_kd');
	}

	function kdTersedia2($id_mapel, $rombel, $id_tahun)
	{
		$this->db->select('kelas_id, mapel_id, kdp, kdk, kkm');
		$this->db->where('mapel_id', $id_mapel);
		$this->db->where('rombel', $rombel);
		$this->db->where('tahun_id', $id_tahun);
		return $this->db->get('t_kd');
	}

	function cariDoubleKd($id_mapel, $rombel, $urut, $tahun_id)
	{
		$stringQ = " SELECT id_kd FROM t_kd	
					WHERE rombel = $rombel AND mapel_id = $id_mapel AND urut = $urut AND tahun_id = $tahun_id ";
		return $this->db->query($stringQ)->num_rows();
	}

	function kdOke($id_mapel, $rombel, $tahun_id)
	{
		$stringQ = " SELECT id_kd FROM t_kd	
					WHERE rombel = $rombel AND mapel_id = $id_mapel AND tahun_id = $tahun_id ";
		return $this->db->query($stringQ)->num_rows();
	}

	function nilaiKd($mapel_id, $kelas_id, $tahun_id){
		$this->db->where('mapel_id', $mapel_id);
		$this->db->where('kelas_id', $kelas_id);
		$this->db->where('tahun_id', $tahun_id);
		return $this->db->get('t_nh')->result_array();
	}

	function cekNilaiKd($tahun, $kelas, $mapel, $santri, $urut_kd){
		$stringQ = " SELECT n.`id_nh`
						FROM t_nh n
						WHERE n.`santri_id` = $santri
						AND n.`mapel_id` = $mapel
						AND n.`kelas_id` = $kelas
						AND n.`tahun_id` = $tahun
						AND n.`urut_kd` = $urut_kd ";
		return  $this->db->query($stringQ)->row_array();
	}

	function hitungHhr($tahun, $kelas, $mapel, $santri)
	{
		$stringQ = " SELECT ROUND((AVG(n.`nilai_kdp`)+AVG(n.`nilai_kdk`))/2,2) AS nhr
					FROM t_nh n
					WHERE n.`mapel_id` = $mapel
					AND n.`kelas_id` = $kelas
					AND n.`tahun_id` = $tahun
					AND n.`santri_id` = $santri ";
		return  $this->db->query($stringQ)->row_array();
	}

	function cekNilaiAkhir($tahun, $kelas, $mapel, $santri){
		$stringQ = " SELECT n.`id_na`
						FROM t_na n
						WHERE n.`santri_id` = $santri
						AND n.`mapel_id` = $mapel
						AND n.`kelas_id` = $kelas
						AND n.`tahun_id` = $tahun ";
		return  $this->db->query($stringQ)->row_array();
	}

	function ambilNilaiAkhir($tahun, $kelas, $mapel){
		$stringQ = " SELECT n.*
						FROM t_na n
						WHERE n.`mapel_id` = $mapel
						AND n.`kelas_id` = $kelas
						AND n.`tahun_id` = $tahun ";
		return  $this->db->query($stringQ)->result_array();
	}

	function cekEntryNilai($walikelas=null, $tahun_id)
	{
		if ($walikelas == null) {
			$whereQ = "WHERE m.`tahun_id` = '$tahun_id' ";
		}else{
			$whereQ = "WHERE m.`tahun_id` = '$tahun_id' AND m.`kelas_id` = '$walikelas' ";
		}

		$stringQ =" SELECT m.`id_mengajar`, m.`asatid_id`, m.`mapel_id`, m.`kelas_id`, m.`tahun_id`, 
					(SELECT COUNT(k.id_kd) 
					FROM t_kd k 
					WHERE k.kelas_id = m.`kelas_id`
					AND k.mapel_id = m.`mapel_id`
					AND k.tahun_id = m.`tahun_id`
					) AS kd,
					(SELECT COUNT(h.id_nh) 
					FROM t_nh h 
					WHERE h.kelas_id = m.`kelas_id`
					AND h.mapel_id = m.`mapel_id`
					AND h.tahun_id = m.`tahun_id`
					) AS nh,
					(SELECT COUNT(a.id_na) 
					FROM t_na a 
					WHERE a.kelas_id = m.`kelas_id`
					AND a.mapel_id = m.`mapel_id`
					AND a.tahun_id = m.`tahun_id`
					) AS na
					FROM m_mengajar m
					$whereQ
					ORDER BY m.`kelas_id`,m.`mapel_id` ";
		return  $this->db->query($stringQ)->result_array();
	}

	public function idAsatid($nohp)
	{
		$this->db->select('id_asatid');
		return $this->db->get_where('m_asatid', ['nohp' => $nohp ])->row_array();
	}

	public function adaIdWali($id_asatid, $id_tahun)
	{
		return $this->db->get_where('t_wali', ["asatid_id" => $id_asatid, "tahun_id" => $id_tahun])->row_array();
	}

	public function legerKd($rombel, $tahun_id){
		$this->db->order_by('mapel_id', 'asc');
		return $this->db->get_where('t_kd', ['rombel' => $rombel, 'tahun_id'=>$tahun_id])->result_array();
	}
	
	public function showRombel($kelas_id)
	{
		$this->db->select('rombel');
		return $this->db->get_where('m_kelas', ['id_kelas' => $kelas_id])->row_array();
	}

	public function showNamaKelas($id_kelas){
		$this->db->select('nama_kelas, kelas_alias, jenjang');
		return $this->db->get_where('m_kelas', ['id_kelas' => $id_kelas])->row_array();
	}

	public function showNamaMapel($id_mapel){
		$this->db->select('nama_mapel, mapel_alias');
		return $this->db->get_where('m_mapel', ['id_mapel' => $id_mapel])->row_array();
	}

	public function showNamaAsatid($id_asatid){
		$this->db->select('nama_asatid, niy');
		return $this->db->get_where('m_asatid', ['id_asatid' => $id_asatid])->row_array();
	}

	public function showNamaTahun($id_tahun){
		$this->db->select('nama_tahun, semester');
		return $this->db->get_where('m_tahun', ['id_tahun' => $id_tahun])->row_array();
	}

	public function showNamaSantri($id_santri){
	    $this->db->select('nama_santri, idk_mii, idk_umum');
		return $this->db->get_where('m_santri', ['id_santri' => $id_santri])->row_array();
	}

	public function showNamaWali($id_kelas,$tahun_id){
		$this->db->select('asatid_id');
		$asatid_id = $this->db->get_where('t_wali', ['kelas_id' => $id_kelas, 'tahun_id' => $tahun_id])->row_array();
		$asatid_id = $asatid_id['asatid_id'];
		return $this->showNamaAsatid($asatid_id);
	}

	public function showPengajar($kelas_id, $mapel_id, $tahun_id){
		$kreteria = [
			'kelas_id' => $kelas_id,
			'mapel_id' => $mapel_id,
			'tahun_id' => $tahun_id
		];

		$this->db->select('asatid_id');
		$asatid_id = $this->db->get_where('m_mengajar', $kreteria)->row_array();
		return $asatid_id['asatid_id'];
	}

	public function mapelPerkelas($kelas_id, $tahun_id)
	{
		$stringQ = "SELECT mapel_id, p.`nama_mapel`
					FROM m_mengajar m JOIN m_mapel p 
					ON m.`mapel_id` = p.`id_mapel` 
					WHERE kelas_id = $kelas_id AND tahun_id = $tahun_id
					ORDER BY p.`nama_mapel`";
		return  $this->db->query($stringQ)->result_array();
	}

	public function nilaiPerkelas($kelas_id, $tahun_id)
	{
		$stringQ = "SELECT n.`kelas_id`, n.`mapel_id`, n.`tahun_id`, n.`santri_id`, n.`nkh`, n.`nhr`, n.`pts`, n.`pas`, ROUND((n.`nkh`+ n.`nhr` + n.`pts`+ n.`pas`)/4,2) AS nrp
					FROM t_na n
					WHERE kelas_id = $kelas_id AND tahun_id = $tahun_id";
		return  $this->db->query($stringQ)->result_array();
	}

	public function sulukPersantriPerkelas($kelas_id, $tahun_id)
	{
		$stringQ = "SELECT n.`kelas_id`, n.`mapel_id`, n.`tahun_id`, n.`santri_id`,n.`urut_kd`, ROUND(AVG(n.`nilai_suluk`),1) as slk
					FROM t_nh n
					WHERE n.`kelas_id` = $kelas_id AND n.`tahun_id` = $tahun_id AND n.`urut_kd`=1
					GROUP BY n.`santri_id`";
		return  $this->db->query($stringQ)->result_array();
	}

	public function rapotMii($id_tahun, $id_santri, $id_kelas){
		$stringQ = " SELECT a.*, m.`nama_mapel`, m.`mapel_alias`, m.`mapel_ar`
					FROM  `t_na` AS a JOIN `t_urutmapel` AS u 
					ON a.`mapel_id` = u.`mapel_id` JOIN m_mapel AS m
					ON m.`id_mapel` = a.`mapel_id` 
					WHERE a.`tahun_id`=$id_tahun AND a.`santri_id` =  $id_santri AND a.`kelas_id` = $id_kelas AND u.`urut_mii` > 0
					ORDER BY u.`urut_mii` ASC ";
		return  $this->db->query($stringQ)->result_array();
	}

	public function rataNrp($kelas_id, $mapel_id){
		$stringQ = " SELECT ROUND(AVG(n.`nrp`),1) AS rata_nrp
					FROM t_na AS n
					WHERE n.`mapel_id` = $mapel_id
					AND n.`kelas_id` = $kelas_id 
					AND n.`nrp` > 0 " ;
		$hasil = $this->db->query($stringQ)->row_array();
		return $hasil['rata_nrp'];
	}

	public function showSuluk($kelas_id, $santri_id, $tahun_id )
	{
		$stringQ = " SELECT ROUND(AVG(h.`nilai_suluk`),0) AS suluk
					FROM t_nh AS h
					WHERE h.`kelas_id` = $kelas_id AND h.`santri_id` = $santri_id AND h.`tahun_id` = $tahun_id ";
		
		$hasil = $this->db->query($stringQ)->row_array();

		switch ( $hasil['suluk'] ) {
				case $hasil['suluk'] > 90 :
					$suluk_k = "A";
					break;
				case $hasil['suluk'] > 80 :
					$suluk_k = "B";
					break;
				case $hasil['suluk'] > 70 :
					$suluk_k = "C";
					break;
				case $hasil['suluk'] > 60 :
					$suluk_k = "D";
					break;
				default:
					$suluk_k = "E";
					break;
		}
		return $suluk_k;
	}

	public function cekEntry($santri_id, $kelas_id, $tahun_id)
	{
		$stringQ = " SELECT *
					FROM t_entriwali AS e
					WHERE e.`santri_id` = $santri_id AND e.`kelas_id` = $kelas_id  AND e.`tahun_id` = $tahun_id ";
		return $this->db->query($stringQ)->row_array();
	}

	public function dataTambahan($santri_id, $tahun_id)
	{
		return $this->db->get_where('t_entriwali', ['santri_id' => $santri_id, 'tahun_id' => $tahun_id ])->row_array();
	}
	
	public function statusNaik($tahun_id, $santri_id)//raport mii
	{
		$stringQ = "SELECT a.`kelas_id`,a.`mapel_id`,a.`tahun_id`,a.`santri_id`,ROUND((a.`nhr`+a.`nkh`+a.`pts`+a.`pas`)/4,0)AS nrp, m.`nama_mapel`
			FROM  `t_na` AS a JOIN  m_mapel AS m
			ON m.`id_mapel` = a.`mapel_id` 
			WHERE a.`tahun_id`= $tahun_id AND a.`santri_id` = $santri_id 
			AND (a.`mapel_id`=2 OR a.`mapel_id`=3 OR a.`mapel_id`=8 ) ";
		$mapel_kreteria = $this->db->query($stringQ)->result_array();


		$string = "SELECT a.`kelas_id`,a.`mapel_id`,a.`tahun_id`,a.`santri_id`,ROUND(AVG((a.`nhr`+a.`nkh`+a.`pts`+a.`pas`)/4),2)AS rata2
			FROM  `t_na` AS a JOIN  m_mapel AS m
			ON m.`id_mapel` = a.`mapel_id` 
			WHERE a.`tahun_id`= $tahun_id AND a.`santri_id` = $santri_id ";
		$rata_semua_mapel = $this->db->query($string)->row_array();

		$naik = 0;
		if ($mapel_kreteria[0]['nrp'] >=70) { //akhlaq
			$naik = $naik + 1; 
		}
		if ($mapel_kreteria[1]['nrp'] >=70) { //fiqih
			$naik = $naik + 1;
		}
		if ($mapel_kreteria[2]['nrp'] >=70) { //akidah
			$naik = $naik + 1;
		}
		if ($rata_semua_mapel['rata2']>=60) { //ratasemua
			$naik = $naik + 1;
		}
		return $naik; //jika return 4, jika lolos semua kreteria
	}

	public function siapPrint($santri,$tahun)
	{
		$stringQ = " SELECT w.`id_entriwali`, d.`id_dkn_raport`, s.`nisn`
					FROM t_entriwali AS w JOIN t_dkn_raport d
					ON w.`santri_id` = d.`santri_id` JOIN m_santri AS s
					ON s.`id_santri` = w.`santri_id`
					WHERE s.`id_santri` = $santri AND w.`tahun_id`=$tahun
					GROUP BY s.`id_santri` ";
		$hasil = $this->db->query($stringQ)->row_array();
		
		$status = 0;

		if ($hasil['id_entriwali']) {
			$status = $status + 1;
		}
		if ($hasil['id_dkn_raport']) {
			$status = $status + 1;
		}
		if ($hasil['nisn']) {
			$status = $status + 1;
		}

		return $status;
	}
	
	public function generateNKH($tgl_awal_semester)
	{
		//$tgl_awal_semester = yyyymmhh;
		/* $stringQ = " SELECT a.`santri_id`, k.`id_kelas`, k.`id_mapel`, 
						COUNT(IF(a.`absen`=0,1,NULL)) AS alpa, 
						COUNT(IF(a.`absen`=1,1,NULL)) AS izin, 
						COUNT(IF(a.`absen`=2,1,NULL)) AS sakit, 
						COUNT(IF(a.`absen`>2,1,NULL)) AS hadir,
						COUNT(a.`santri_id`) AS total
					FROM t_absensi a JOIN `t_jurnal` j
					ON a.`jurnal_id` = j.`id_jurnal` JOIN `t_kbm` k
					ON j.`kbm_id` = k.`id_kbm`
					GROUP BY a.`santri_id`, k.`id_mapel`, k.`id_kelas`";
		*/
		$stringQ = " SELECT santri_id,id_mapel,id_kelas,
						COUNT(IF(datasemua.`absen`=0,1,NULL)) AS alpa, 
						COUNT(IF(datasemua.`absen`=1,1,NULL)) AS izin, 
						COUNT(IF(datasemua.`absen`=2,1,NULL)) AS sakit, 
						COUNT(IF(datasemua.`absen`>2,1,NULL)) AS hadir,
						COUNT(datasemua.`santri_id`) AS total
					FROM 
					(SELECT a.`santri_id`, k.`id_mapel`, k.`id_kelas`, k.`id_asatid`, j.`tgl`,a.`absen`,
							CONCAT (
								SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',-1),
								CASE
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Januari' THEN '01'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Februari' THEN '02'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Maret' THEN '03'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'April' THEN '04'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Mei' THEN '05'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Juni' THEN '06'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Juli' THEN '07'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Agustus' THEN '08'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'September' THEN '09'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'Oktober' THEN '10'
								    WHEN SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',2), ' ', -1) = 'November' THEN '11'
								    ELSE '12'
								END,
								IF (SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',1) < 10, CONCAT('0',SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',1)), SUBSTRING_INDEX(SUBSTRING_INDEX(j.`tgl`, ', ', -1),' ',1)) 
							) AS tgl_unix 
						FROM t_absensi a JOIN `t_jurnal` j
						ON a.`jurnal_id` = j.`id_jurnal` JOIN `t_kbm` k
						ON j.`kbm_id` = k.`id_kbm`) AS datasemua
					WHERE datasemua.tgl_unix > $tgl_awal_semester
					GROUP BY datasemua.santri_id, datasemua.id_mapel, datasemua.id_kelas ";
		return $this->db->query($stringQ)->result_array();
	}


	public function isAksesMenu($id_rule, $id_menu)
	{
		$stringQ = " SELECT am.`menu_id`, am.`rule_id` 
					FROM `akses_menu` AS am
					WHERE am.`menu_id` = $id_menu
					AND am.`rule_id` = $id_rule ";
		return $this->db->query($stringQ)->num_rows();

	}

	public function isAksesSubmenu($id_rule, $id_submenu)
	{
		$stringQ = " SELECT ab.`submenu_id`, ab.`rule_id` 
					FROM `akses_submenu` AS ab
					WHERE ab.`submenu_id` = $id_submenu
					AND ab.`rule_id` = $id_rule ";
		return $this->db->query($stringQ)->num_rows();

	}

	public function listMapelIjz($id_mapel = null)
	{
		if ($id_mapel != null ) {
			$kond = "WHERE u.`urut_ijz` IS NOT NULL and u.`mapel_id` = $id_mapel";
		} else{
			$kond = "WHERE u.`urut_ijz` IS NOT NULL";
		}

		$stringQ = " SELECT m.`id_mapel`, u.`urut_ijz`, m.`mapel_alias`,  m.`mapel_ar`
				FROM t_urutmapel u JOIN m_mapel m
				ON u.`mapel_id` = m.`id_mapel`
				$kond ORDER BY u.`urut_ijz` ASC ";
		return $this->db->query($stringQ)->result_array();
	}

	public function guruKelas6($email)
	{
		$stringQ=" SELECT a.`id_asatid`, p.`id_mapel`, p.`mapel_alias`, k.`kelas_alias`, u.`email`, a.`nama_asatid`
			FROM m_mengajar	m JOIN m_kelas k
			ON k.`id_kelas` = m.`kelas_id` JOIN m_asatid a
			ON a.`id_asatid` = m.`asatid_id` JOIN user_data u
			ON u.`nohp` = a.`nohp` JOIN m_mapel p
			ON p.`id_mapel` = m.`mapel_id`
			WHERE k.`rombel` = 6 AND m.`tahun_id` = 3 AND u.`email` = $email
			GROUP BY a.`id_asatid`, p.`id_mapel` ";
		return $this->db->query($stringQ)->num_rows();
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */