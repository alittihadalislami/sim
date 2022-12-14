SELECT s.`nama_santri`, s.`idk_mii`, j.`materi`, j.`tgl`, a.`absen`, k.`jamke`, k.`id_kelas`
FROM t_absensi a JOIN `t_jurnal` j
ON a.`jurnal_id` = j.`id_jurnal` JOIN t_kbm k
ON k.`id_kbm` = j.`kbm_id` JOIN m_santri s
ON s.`id_santri` = a.`santri_id`
WHERE a.`santri_id` = 319
AND k.`id_tahun` = 8
AND a.`absen` < 3