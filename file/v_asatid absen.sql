CREATE VIEW `v_rekap_asatid` AS 
SELECT
  `k`.`id_asatid` AS `id_asatid`,
  `j`.`id_jurnal` AS `id_jurnal`,
  `j`.`kbm_id`    AS `kbm_id`,
  `j`.`tgl`       AS `waktu`,
  SUBSTRING_INDEX(`j`.`tgl`,',',1) AS `hari`,
  SUBSTRING_INDEX(SUBSTRING_INDEX(`j`.`tgl`,' ',2),' ',-1) AS `tgl`,
  SUBSTRING_INDEX(SUBSTRING_INDEX(`j`.`tgl`,' ',3),' ',-1) AS `bulan`,
  SUBSTRING_INDEX(SUBSTRING_INDEX(`j`.`tgl`,' ',4),' ',-1) AS `tahun`,
  `j`.`materi`    AS `materi`,
  `k`.`id_kelas`  AS `id_kelas`,
  `k`.`jamke`     AS `jamke`,
  `k`.`id_mapel`  AS `id_mapel`
FROM (`t_jurnal` `j`
   JOIN `t_kbm` `k`
     ON (`j`.`kbm_id` = `k`.`id_kbm`))
GROUP BY `j`.`tgl`,`k`.`id_mapel`,`k`.`jamke`
ORDER BY `k`.`id_asatid`,SUBSTRING_INDEX(SUBSTRING_INDEX(`j`.`tgl`,' ',2),' ', - 1)