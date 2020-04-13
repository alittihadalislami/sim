INSERT INTO t_nilai_ijz (mapel_id, santri_id, tahun_id, nrp)
SELECT n.`mapel_id`, n.`santri_id`,  3 AS tahun_id, ROUND(AVG(n.`nrp`),0) AS r_rpt 
FROM t_na n JOIN m_santri s 
ON s.`id_santri` = n.`santri_id`
WHERE n.`mapel_id` IN (SELECT m.`id_mapel`
FROM t_urutmapel u JOIN m_mapel m
ON u.`mapel_id` = m.`id_mapel`
WHERE u.`urut_ijz` IS NOT NULL)
AND s.`id_santri` IN (SELECT s.`id_santri`
FROM t_agtkelas a JOIN m_santri s 
ON a.`santri_id` = s.`id_santri` JOIN m_kelas k
ON k.`id_kelas` = a.`kelas_id`
WHERE a.`tahun_id` = 3 && k.`rombel` = 6)
GROUP BY n.`santri_id`, n.`mapel_id`
