<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Raport_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showMapel($jenjang=null, $rombel)
    {
        if ($jenjang==null) {
            $jenjang = 'mii';
        }

        $stringQ = "SELECT u.`mapel_id`,u.`urut_$jenjang`,m.`nama_mapel` ,m.`mapel_alias`
					FROM t_urutmapel AS u JOIN m_mapel m
					ON u.`mapel_id` = m.`id_mapel`
					WHERE u.`urut_$jenjang` IS NOT NULL
					ORDER BY u.`urut_$jenjang`";
        return $mapel =  $this->db->query($stringQ)->result_array();

        // if ($jenjang == 'ma')
        // {
        // 	if ($rombel == 6 )
        // 	{
        // 		unset($mapel[19]);//hapus sharaf
        // 		return array_values($mapel);
        // 	}else{
        // 		unset($mapel[20]);//hapus balaghah
        // 		return array_values($mapel);
        // 	}
        // }else{
        // 	return $mapel;
        // }
    }

    public function anggotaKelas($kelas, $tahun)
    {
        $stringQ="SELECT k.`santri_id`
				FROM t_agtkelas AS k
				WHERE k.`kelas_id`=$kelas AND k.`tahun_id`=$tahun ";
        return $this->db->query($stringQ)->result_array();
    }

    public function nilai($tahun_id, $kelas_id, $jenjang, $kd)
    {
        $stringQ = "SELECT h.`mapel_id`, h.`santri_id`, ROUND(AVG(h.`nilai_$kd`)) AS rata_$kd
					FROM t_nh AS h JOIN t_urutmapel AS u
					ON h.`mapel_id` = u.`mapel_id`
					WHERE h.`tahun_id`=$tahun_id AND h.`kelas_id` =$kelas_id AND u.`urut_$jenjang` IS NOT NULL
					GROUP BY h.`santri_id`, h.`mapel_id`
					ORDER BY u.`urut_$jenjang`, h.`santri_id` ASC ";
        return $this->db->query($stringQ)->result_array();
    }

    public function nilaiUjian($tahun, $kelas, $jenjang)
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

        return array_merge($min, $max);
    }

    public function ambilSiswaBawahKkm($kelas, $mapel, $tahun)
    {
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
        } else {
            $kolom = 'k';
        }

        $stringQ="SELECT d.`urut`, d.`kd$kolom`
				FROM t_kd AS d
				WHERE d.`tahun_id`=$tahun AND d.`rombel`=$rombel AND d.`mapel_id`=$mapel AND d.`urut`=$urut";
        return $this->db->query($stringQ)->row_array();
    }

    public function deskripSikap($santri, $tahun)
    {
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
        } else {
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

    public function namaBulan($bulan)
    {
        $bulanText = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulan = intval($bulan);
        if ($bulan >=1 && $bulan<=12) {
            return($bulanText[$bulan-1]);
        } else {
            return 'range salah';
        }
    }

    public function angkaBulan($bulan)
    {
        $bulanText = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $i = 1;
        foreach ($bulanText as  $bt) {
            if ($bt == ucwords(strtolower($bulan))) {
                return $i;
            }
            $i++;
        }
        return 'nama bulan salah';
    }

    public function tglRaport($id)
    {
        $this->db->select('tgl_raport_mii,tgl_raport_smp,tgl_raport_ma');
        $this->db->where('id_tahun', $id);
        $hasil =  $this->db->get('m_tahun')->row_array();
        foreach ($hasil as $h => $v) {
            $pecahan = explode("-", $v);
            $new_index = explode("_", $h);
            $res [$new_index[2]]= $pecahan[0].' '.$this->namaBulan($pecahan[1]).' '. $pecahan[2];
        }
        return $res;
    }

    public function jenjangKelas($kelas)
    {
        $this->db->select('jenjang');
        $hasil =  $this->db->get_where('m_kelas', ['id_kelas'=>$kelas])->row_array();

        if ($hasil['jenjang'] == '1') {
            $jenjangKelas = 'smp';
        } else {
            $jenjangKelas = 'ma';
        }

        return $jenjangKelas;
    }

    public function identitas($id_santri, $jenjang)
    {
        $stringQ = " SELECT 
						UPPER(d.`nama_seijazah`),
						CONCAT(d.`nisn`,' / ','') AS nomor,
	                    CONCAT(d.`tmp_lahir`,', ',d.`tgl_lahir` ) AS tgl,
						'l' AS jenis_kel,
						'Islam' AS agama,
						d.`anak_ke`,
						'Anak Kandung' AS status_kel,
						d.`alamat_ortu` AS alamat,
						d.`hp_ibu` AS hpdianak,
						NULL AS diterima,
						d.`kelas_terima_$jenjang`,
						d.`tgl_terima_$jenjang`,
						d.`semester_terima_$jenjang`,
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

    public function jenjangTratri($kelas_id, $tahun_id = null)
    {
        if ($tahun_id == null) {
            $tahun = '(SELECT MAX(DISTINCT w.`tahun_id`) AS last_tahun_id FROM t_wali w)';
        }

        $stringQ = "
					SELECT k.`jenjang`, w.`tra_tri`
					FROM t_wali w JOIN m_kelas k
					ON k.`id_kelas`= w.`kelas_id`
					WHERE k.`id_kelas` = $kelas_id
					AND w.`tahun_id` = $tahun
		";
        return $this->db->query($stringQ)->row_array();
    }

    public function hitungSIA($tanggal_awal_sem = '20210714', $santri_id) //tanggal awal semester yyyymmdd
    {
        $stringQ = " SELECT santri_id, SUM(alpa) as alpa, SUM(izin) as izin, SUM(sakit) as sakit
					FROM (
					SELECT santri_id,id_mapel,id_kelas,
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
					WHERE datasemua.tgl_unix > $tanggal_awal_sem
					GROUP BY datasemua.santri_id, datasemua.id_mapel, datasemua.id_kelas
					) AS lagi
					where santri_id = $santri_id ";
        return $this->db->query($stringQ)->result_array();

        /*
        INSERT INTO t_kd (kelas_id, rombel, mapel_id, tahun_id, kdp, kdk, urut, kkm)
        SELECT d.`kelas_id`, d.`rombel`, 38 AS `mapel_id`, d.`tahun_id`, d.`kdp`, d.`kdk`, d.`urut`, d.`kkm`
        FROM t_kd d
        WHERE d.`mapel_id` = 28
        AND d.`tahun_id` = 3

        INSERT INTO t_nh (mapel_id, kelas_id, santri_id, tahun_id, urut_kd, nilai_kdp, nilai_kdk, nilai_suluk)
        SELECT 38 AS mapel_id , h.`kelas_id`, h.`santri_id`, h.`tahun_id`, h.`urut_kd`, h.`nilai_kdp`, h.`nilai_kdk`, h.`nilai_suluk`
        FROM t_nh h
        WHERE h.`mapel_id` = 28
        AND h.`tahun_id` = 3

        INSERT INTO t_na (kelas_id, mapel_id, tahun_id, santri_id, nkh, nhr, pts, pas, nrp)
        SELECT n.`kelas_id`,38 AS mapel_id, n.`tahun_id`, n.`santri_id`, n.`nkh`, n.`nhr`, n.`pts`, n.`pas`, n.`nrp`
        FROM t_na n
        WHERE n.`mapel_id` = 28
        AND n.`tahun_id` = 3
        */
    }

    public function resetDKN($kelas, $tahun)
    {
        $stringQ = " DELETE FROM `t_dkn_raport` WHERE `t_dkn_raport`.`kelas_id` = 
					$kelas AND `t_dkn_raport`.`tahun_id` = $tahun ";
        $this->db->query($stringQ);
        return $this->db->affected_rows();
    }

    public function lebihSatuNilai($santri, $tahun, $mapel, $kelas)
    {
        //cek nilai apakah terinput lebih dari 1 kali
        $stringQ = " SELECT *
        FROM t_na n
        WHERE n.`santri_id` = $santri
        AND n.`tahun_id` = $tahun
        AND n.`mapel_id` = $mapel
        AND n.`kelas_id` = $kelas ";
        return $this->db->query($stringQ)->result_array();
    }

    public function angkaLatinKeArab($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_western, $arabic_eastern, $str);
    }

    public function bulanHiriyahArab($angka)
    {
        if ($angka > 0 && $angka <= 12) {
            $data = ['المحرم','صفر','ربيع الأول','ربيع الأخير','جمادى الأولى','جمادى الثانية','رجب','شعبان','رمضان','شوال','ذو القعدة','ذو الحجة'];
            return $data[$angka-1];
        }
        return "salah angka bulan!!";
    }

    public function masehiKeHijriyah($yyyy_mm_dd=null)
    {
        //https://pdsi.unisayogya.ac.id/api-konversi-masehi-ke-hijriah/
        //https://service.unisayogya.ac.id/kalender/api/<fungsi>/<metode>/<tahun>/<bulan>/<tanggal>
        if ($yyyy_mm_dd == null) {
            $yyyy_mm_dd = date("Y/m/d");
        }
        str_replace('-', '/', $yyyy_mm_dd);
        $url = 'https://service.unisayogya.ac.id/kalender/api/masehi2hijriah/muhammadiyah/'.$yyyy_mm_dd;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        return $hasil = [
            $this->angkaLatinKeArab($obj->tanggal),
            $this->bulanHiriyahArab($obj->bulan),
            $this->angkaLatinKeArab($obj->tahun)
        ];
    }

    public function cekNilaiPraktik($tahun_id, $kelas_id, $mapel_id)
    {
        $stringQ = "SELECT h.`mapel_id`, h.`kelas_id`, h.`tahun_id`, h.`santri_id`, h.`nilai_kdk` AS 'nilai_praktik'
        FROM t_nh h
        WHERE h.`tahun_id` = $tahun_id
        AND h.`kelas_id` = $kelas_id
        AND h.`mapel_id` = $mapel_id
        AND h.`urut_kd` = (
            SELECT d.`urut`
            FROM t_kd d
            WHERE d.`tahun_id` = $tahun_id
            AND d.`rombel` = (SELECT k.`rombel` FROM m_kelas k  WHERE k.`id_kelas` = $kelas_id)
            AND d.`mapel_id` = $mapel_id
            AND (d.`kdp` = 'Ujian Praktik' OR d.`kdk` = 'Ujian Praktik')
        )
        ";
        return $this->db->query($stringQ)->result_array();
    }

    public function nilaiInformatika($kelas, $tahun)
    {
        $stringQ = "SELECT a.`santri_id`, a.`nhr` ,a.`nrp`
                    FROM t_na a
                    WHERE a.`mapel_id` = 28 #mapel TIK
                    AND a.`tahun_id` = $tahun
                    AND a.`kelas_id` = $kelas ";
        return $this->db->query($stringQ)->result_array();
    }
}

/* End of file Raport_model.php */
/* Location: ./application/models/Raport_model.php */
