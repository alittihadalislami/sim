<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
    public function jadwalHariIni($hari, $asatid_id, $tahun_id)
    {
        $stringQ = " SELECT k.*, a.`nama_asatid`, m.`mapel_alias`, l.`nama_kelas`
					FROM t_kbm k JOIN `m_asatid` a 
					ON k.`id_asatid` = a.`id_asatid` JOIN m_mapel m
					ON m.`id_mapel` = k.`id_mapel` JOIN m_kelas l
					ON l.`id_kelas` = k.`id_kelas`
					WHERE k.`hari` = '$hari' AND a.`id_asatid` = '$asatid_id' AND k.`id_tahun` = $tahun_id
					GROUP BY k.`id_asatid`,k.`id_kelas`,k.`id_mapel`,k.`hari`,k.`jamke`,k.`id_tahun`
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
        $this->db->where('kbm_id', $id_kbm);
        $this->db->where('tgl', $tanggal);
        return $this->db->get('t_jurnal')->row_array();
    }

    public function cekAbsensi($jurnal_id, $santri_id)
    {
        $this->db->select('id_absensi, absen');
        $this->db->where('jurnal_id', $jurnal_id);
        $this->db->where('santri_id', $santri_id);
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

    public function listGuru($tahun, $jenjang)
    {
        $stringQ = " SELECT a.`id_asatid`, a.`niy`, a.`nama_asatid`
                    FROM m_mengajar m JOIN m_kelas k
                    ON m.`kelas_id` = k.`id_kelas` JOIN m_asatid a
                    ON a.`id_asatid` = m.`asatid_id`
                    WHERE m.`tahun_id` = '$tahun' 
                    AND k.`jenjang` = '$jenjang'
                    GROUP BY a.`nama_asatid`
                    ORDER BY a.`nama_asatid` ";
        return $this->db->query($stringQ)->result_array();
    }

    public function dataKehadiran($tahun, $bulan, $id_asatid, $tgl='>=1')
    {
        $stringQ = " SELECT j.*, k.`id_asatid` , a.`nama_asatid`, k.`jamke`, kl.`kelas_alias`, ml.`mapel_alias`,
                    TRIM(SUBSTRING_INDEX(j.`tgl`, ',', 1)) AS hari,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 1)) AS tanggal,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 2)), ' ', -1)) AS bulan,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', -1)) AS tahun
                    FROM t_jurnal j JOIN t_kbm k
                    ON j.`kbm_id` = k.`id_kbm` JOIN m_asatid a
                    ON a.`id_asatid` = k.`id_asatid` JOIN m_kelas kl
                    ON k.`id_kelas` = kl.`id_kelas`  JOIN m_mapel ml
                    ON k.`id_mapel` = ml.`id_mapel`
                    WHERE k.`id_asatid` = '$id_asatid'
                    HAVING tahun = '$tahun'
                    AND bulan = '$bulan' 
                    AND tanggal $tgl 
                    ORDER BY CAST(tanggal AS UNSIGNED), jamke ASC ";
        return $this->db->query($stringQ)->result_array();
    }
    public function dataKehadiranSantri($tahun, $bulan, $kelas, $mapel)
    {
        $stringQ = " SELECT a.*, k.`id_mapel`, k.`id_kelas`, j.`tgl`,
                    TRIM(SUBSTRING_INDEX(j.`tgl`, ',', 1)) AS hari,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 1)) AS tanggal,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 2)), ' ', -1)) AS bulan,
                    TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', -1)) AS tahun
                    FROM t_absensi a JOIN t_jurnal j
                    ON a.`jurnal_id` = j.`id_jurnal` JOIN t_kbm k
                    ON k.`id_kbm` = j.`kbm_id`
                    WHERE k.`id_kelas` = $kelas
                    AND k.`id_mapel` = $mapel
                    HAVING bulan = '$bulan'
                    AND tahun = '$tahun'
                    ORDER BY a.`santri_id` ";
        return $this->db->query($stringQ)->result_array();
    }

    public function dataKehadiranSantriPerSemester($tahun, $sem=1, $kelas)
    {

        // if ($sem == 2 ) {
        //     $bulan = "('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni')";
        // } else {
        //     $bulam = "('Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')";
        // }
        if ($sem == 1) {
            $string_condition = "NOT IN";
        } else {
            $string_condition = "IN";
        }

        $stringQ = " SELECT a.*, k.`id_mapel`, k.`id_kelas`, j.`tgl`,
                TRIM(SUBSTRING_INDEX(j.`tgl`, ',', 1)) AS hari,
                TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 1)) AS tanggal,
                TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', 2)), ' ', -1)) AS bulan,
                TRIM(SUBSTRING_INDEX(TRIM(SUBSTRING_INDEX(j.`tgl`, ',', -1)), ' ', -1)) AS tahun
                FROM t_absensi a JOIN t_jurnal j
                ON a.`jurnal_id` = j.`id_jurnal` JOIN t_kbm k
                ON k.`id_kbm` = j.`kbm_id`
                WHERE k.`id_kelas` = $kelas
                HAVING bulan $string_condition ('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni')
                AND tahun = '$tahun'
                ORDER BY a.`santri_id` ";
        return $this->db->query($stringQ)->result_array();
    }

    public function showRuleLevelByEmail($email)
    {
        $stringQ = " SELECT a.`id_asatid`, a.`nama_asatid`, a.`niy`, a.`tetap`, dr.`rule_id`, us.`level`
                    FROM m_asatid a JOIN user_data u
                    ON a.`nohp` = u.`nohp` RIGHT JOIN  user_dapat_rule dr
                    ON u.`id_user` = dr.`user_id` LEFT JOIN user_rule us
                    ON dr.`rule_id` = us.`id_rule`
                    WHERE u.`email` = '$email'
                    ORDER BY us.`level` ASC
                    LIMIT 1 ";
        return $this->db->query($stringQ)->result_array();
    }

    public function getMapelAsatid($tahun, $asatid)
    {
        $stringQ = " SELECT k.`id_asatid`, k.`id_mapel`, m.`mapel_alias`
                    FROM t_kbm k LEFT JOIN m_mapel m
                    ON k.`id_mapel` = m.`id_mapel`
                    WHERE k.`id_tahun` = '$tahun'
                    AND k.`id_asatid` = '$asatid'
                    GROUP BY k.`id_mapel` ";
        return $this->db->query($stringQ)->result_array();
    }

    public function getKelasAsatid($tahun, $asatid, $mapel)
    {
        $stringQ = " SELECT k.*, kl.`nama_kelas`, kl.`kelas_alias`
                FROM t_kbm k LEFT JOIN m_kelas kl
                ON k.`id_kelas` = kl.`id_kelas`
                WHERE k.`id_tahun` = '$tahun'
                AND k.`id_asatid` = '$asatid'
                AND k.`id_mapel` = '$mapel'
                GROUP BY k.`id_kelas`
                ORDER BY kl.`nama_kelas`";
        return $this->db->query($stringQ)->result_array();
    }

    public function getAnggotaKelas($tahun, $kelas)
    {
        $stringQ = " SELECT a.`santri_id`, d.`nama_seijazah`
            FROM t_agtkelas a LEFT JOIN t_detail_santri d
            ON a.`santri_id` = d.`santri_id`
            WHERE a.`tahun_id` = '$tahun'
            AND a.`kelas_id` = '$kelas'
            ORDER BY d.`nama_seijazah` ";
        return $this->db->query($stringQ)->result_array();
    }

    public function getJadwal($tahun, $asatid, $mapel, $kelas)
    {
        $stringQ = "SELECT k.*, kl.`nama_kelas`, kl.`kelas_alias`
                    FROM t_kbm k LEFT JOIN m_kelas kl
                    ON k.`id_kelas` = kl.`id_kelas`
                    WHERE k.`id_tahun` = '$tahun'
                    AND k.`id_asatid` = '$asatid'
                    AND k.`id_mapel` = '$mapel'
                    AND k.`id_kelas` = '$kelas'
                    ";
        return $this->db->query($stringQ)->result_array();
    }
}

/* End of file Absensi_model.php */
/* Location: ./application/models/Absensi_model.php */
