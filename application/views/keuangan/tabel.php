<section class="mt-2 py-5 border-top">
    <div class="text-center">
        <h4>Database Keuangan</43>
    </div>
    <table class="table table-bordered mt-2 table-sm" id="table_id">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <?php for ($i=0; $i < rand(500,600); $i++) : ?> 
        <tr>
        <th scope="row"><?=$i?></th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <?php endfor ?>
    </tbody>
    </table>   
</section> 
<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            "lengthMenu": [ [5, 7, 10, 25, 50, -1], [5, 7, 10, 25, 50, "All"] ],
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
    } );
</script>


