SELECT `a`.`santri_id` AS `santri_id`,`k`.`id_kelas`  AS `id_kelas`,`k`.`id_mapel`  AS `id_mapel`, k.`id_tahun`,
  COUNT(IF(`a`.`absen` = 0,1,NULL)) AS `alpa`,
  COUNT(IF(`a`.`absen` = 1,1,NULL)) AS `izin`,
  COUNT(IF(`a`.`absen` = 2,1,NULL)) AS `sakit`, 
  COUNT(IF(`a`.`absen` = 0,1,NULL)) + COUNT(IF(`a`.`absen` = 1,1,NULL)) + COUNT(IF(`a`.`absen` = 2,1,NULL)) AS `total`,
  s.`nama_santri`, m.`mapel_alias`, kl.`nama_kelas`
FROM `t_absensi` `a` JOIN `t_jurnal` `j`
ON `a`.`jurnal_id` = `j`.`id_jurnal` JOIN `t_kbm` `k`
ON `j`.`kbm_id` = `k`.`id_kbm` JOIN `m_santri` s 
ON s.`id_santri` = a.`santri_id` JOIN m_mapel m
ON m.`id_mapel` = k.`id_mapel` JOIN m_kelas kl
ON kl.`id_kelas` = k.`id_kelas`
WHERE k.`id_tahun` = 9 AND s.`id_santri` NOT IN (
	SELECT agt.santri_id
    FROM t_agtkelas agt LEFT JOIN m_kelas k 
    on agt.kelas_id = k.id_kelas
    WHERE agt.tahun_id = 9 AND k.rombel = 0
)
GROUP BY `a`.`santri_id`,`k`.`id_mapel`,`k`.`id_kelas`, k.`id_tahun`
ORDER BY total DESC