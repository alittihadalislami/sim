<!-- load datatable boostrap css -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Santri</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg lebar">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rekapitulasi Santri</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="santri" class="table table-bordered table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>Nama Kelas</th>
                      <th>A</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D</th>
                      <th>Putra</th>
                      <th>Putri</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                    <?php  for ($i=1; $i<=7; $i++): ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td>A</td>
                        <td>B</td>
                        <td>C</td>
                        <td>D</td>
                        <td>Putra</td>
                        <td>Putri</td>
                        <td>Jumlah</td>
                      </tr>
                    <?php endfor ?>
                    <tr>
                      <td colspan="7" style="text-align: right;"><b>JUMLAH</b></td>
                      <td>dsfasf</td>
                    </tr>
                  <tbody>
                  </tbody>
                </table>
                <br>
                <table id="santri" class="table table-bordered table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>Tingkat</th>
                      <th>Putra</th>
                      <th>Putri</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                    <?php  
                      $tingkat = [1=>'SMP', 'MA', 'Takhassus'];
                    ?>
                    <?php  for ($i=1; $i<=3; $i++): ?>
                      <tr>
                        <td><?= $tingkat[$i] ?></td>
                        <td>A</td>
                        <td>B</td>
                        <td>Jumlah</td>
                      </tr>
                    <?php endfor ?>
                    <tr>
                      <td colspan="3" style="text-align: right;"><b>JUMLAH</b></td>
                      <td>dsfasf</td>
                    </tr>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>

        </div>
      </div>
    </div>
  </section>
</div>


<!-- load js datatable -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script>
  $(document).ready(function() {
    
  });
</script>
