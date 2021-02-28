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
                <h3 class="card-title"><?= 'Data Utama' ?></h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-2 float-right mb-5">
                    <select id="pilih-kelas" class="custom-select">
                      <?php foreach ($kelas as $kls): ?>
                        <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <?php print_r($data_detail) ?>
                <table id="santri" class="table table-bordered table-hover display responsive" width="100%">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>ID Santri</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>NISN</th>
                      <th>NISL</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Absen</th>
                      <th>Anake ke/dari </th>
                      <th>No Ijasah</th>
                      <th>No SKHU</th>
                      <th>No Peserta UN</th>
                      <th>Nama Ibu</th>
                      <th>Nama Bapak</th>
                      <th>Tanggal Masuk</th>
                    </tr>
                  </thead>
                  <tbody id="isi-table">
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

    $('#pilih-kelas').change(function() {
      id_kelas = $(this).val()  
      data = '<tr>'+
                '<td>'+id_kelas+'</td>'+
                '<td style="background:darkred">1212</td>'+
                '<td>Nurul Fuadi</td>'+
              '</tr>';
      data = data + data;
      $('#isi-table').html(data);
    });

    kelas = $('#pilih-kelas').find(":selected").text();
    

    
    $('#santri').dataTable( {
      // "columnDefs": [{ 'visible': false, 'targets': [2] }]
      "scrollY": 200,
      "scrollX": true
    });
  });
</script>
