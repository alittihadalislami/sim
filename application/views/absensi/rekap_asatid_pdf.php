
    <table cellspacing="2" cellpadding="2" border="0">
        <tr>
            <td style="width:80px"> Nama</td>
            <td style="width:300px">: <?= $pengguna['nama_asatid']?></td>
            <td style="width:80px">Bulan</td>
            <td style="width:222px">: <?= $bulan_tahun[0] ?></td>
        </tr>
        <tr>
            <td> NIY</td>
            <td>: <?= $pengguna['niy'] ?></td>
            <td>Tahun</td>
            <td>: <?= $bulan_tahun[1] ?></td>
        </tr>
    </table>

    <div>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th style="text-align: center;width:30px">No.</th>
                <th style="text-align: center;width:120px">Tanggal</th>
                <th style="text-align: center;width:50px">Kelas</th>
                <th style="text-align: center;width:40px">Jam ke</th>
                <th style="text-align: center;width:150px">Mata Pelajaran</th>
                <th style="text-align: center;width:200px">Materi</th>
                <th style="text-align: center;width:50px">Ket</th>
            </tr>
            <?php $no=1; foreach ($list_guru as $value) : ?>
            <tr>
                <td style="text-align: center; vertical-align: middle;"><?=$no++?></td>
                <td style="text-align: center; vertical-align: middle;">
                    <?=str_replace(', ', "<br>", $value['tgl'])?>
                </td>
                <td style="text-align: center; vertical-align: middle;"><?=$value['kelas_alias']?></td>
                <td style="text-align: center; vertical-align: middle;"><?=$value['jamke']?></td>
                <td style="text-align: center; vertical-align: middle;"><?=$value['mapel_alias']?></td>
                <td style="padding-top: 50px; padding-bottom: 50px;text-align: center; vertical-align: middle;">
                    <?=$value['materi']?>
                </td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>