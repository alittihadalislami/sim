SELECT k.`id_asatid`, j.`id_jurnal`, j.`kbm_id`, j.`tgl` AS waktu,
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
ORDER BY k.`id_asatid`, tgl