<table id ='tagihan' class="table table-sm table-striped table-hover text-nowrap text-center">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Nominal</th>
            <th scope="col">Keuangan</th>
            <th scope="col">Bulan</th>
            <th scope="col">Tahun</th>
            <th scope="col">Tahun Ajaran</th>
            <th scope="col">Nominal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($nominal as $value) : ?>
        <tr>
            <th scope="row"><?=$no++?></th>
            <td><?=$value['id_nominal']?></td>
            <td><?=$value['mutasi_keuangan']?></td>
            <td><?=$value['bulan'] == NULL ? '-': $value['bulan'] ?></td>
            <td><?=$value['tahun'] == NULL ? '-': $value['tahun'] ?></td>
            <td class="tahun-ajaran"><?php
                $tapel1 = substr($value['tapel'],0,4);
                $tapel2 = substr($value['tapel'],4,4);
                echo $tapel1.'-'.$tapel2;
            ?></td>
            <td class="uang"><?=$value['nominal']?></td>
            <td>
                <a href="#">edit</a> ||
                <a class="hapus-data-nominal" href="#" data-id="<?=$value['id_nominal']?>">hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $('#tagihan').DataTable({
        "lengthMenu": [ [13, 25, 50, -1], [13, 25, 50, "Sadejeh"] ],
        "language": {
            "lengthMenu": "_MENU_  Perhalaman",
            "zeroRecords": "Sobung datanah..",
            "info": "_START_-_END_ dari <b>_TOTAL_</b> data",
            "infoEmpty": "Sobung datanah..",
            "infoFiltered": "(total _MAX_ data.)",
            "thousands": ".",
            "search": "Cari:",
            "loadingRecords": "Sedang memuat...",
            "processing": "Sedang memproses...",
            "paginate": {
                "next": '<i class="fa fa-chevron-right"></i>',
                "previous": '<i class="fa fa-chevron-left"></i>'
            },
        }
    });

    $('#tagihan_info').on('DOMSubtreeModified', function(){
        uangkan()
    });
</script>