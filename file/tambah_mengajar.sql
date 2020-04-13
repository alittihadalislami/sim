INSERT INTO m_mengajar (mapel_id, kelas_id, asatid_id, tahun_id)
SELECT m.`mapel_id`, m.`kelas_id`, m.`asatid_id`, 3 AS tahun_id
FROM m_mengajar	 m
WHERE m.`tahun_id` = 2