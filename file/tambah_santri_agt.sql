INSERT INTO `t_agtkelas` (santri_id, kelas_id, tahun_id)
SELECT a.`santri_id`, a.`kelas_id`, 3 AS tahun_id
FROM t_agtkelas a
WHERE tahun_id = 2 