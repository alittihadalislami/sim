<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lx-10 mx-auto pb-5">
          
          <table id="user12" class="table table-sm table-striped table-bordered">
            <thead>
              <tr>
                  <th>#</th>
                  <th>ID User</th>
                  <th>Nama User</th>
                  <th>Email</th>
                  <th>No HP</th>
                  <th>Rule</th>
                  <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="data_user">

            </tbody>
          </table>
        
        </div>
      </div>
    </div>
  </section>
</div>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {

      $('#user12').DataTable( {
          ordering: true,
          processing: true,
          serverSide: true,
          ajax: {
            url: "<?php echo base_url('menu/tampilUser') ?>",
            type:'POST',
          },
          columns: [
              {data:'urut'},
              {data:'id_user'},
              {data:'nama'},
              {data:'email'},
              {data:'nohp'},
              {data:'rule_id'},
              {data:'email',
                "render": function (data,type,row) {
                  console.log(row);
                    let tanya = "apakah yakin?";
                    return '<a href="<?= base_url('menu/deleteUser/') ?>'+row.id_user+'"><i class="buang fas fa-trash text-danger mr-lg-4"></i></a>';
                }
              }
          ],
          // order: [[2, 'asc']]
      })

      

      $('#user12').on('click', 'td a', function (){
          var result = confirm("Want to delete?");
          if (result) {
              return true;
          }else{
            return false;
          }
      });

  });
</script>