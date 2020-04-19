INSERT INTO t_nilai_ijz (mapel_id, santri_id, tahun_id, nrp)
SELECT 12 AS mapel_id, i.`santri_id`, i.`tahun_id`, 85 AS nrp
FROM t_nilai_ijz i
WHERE i.`mapel_id` = 1