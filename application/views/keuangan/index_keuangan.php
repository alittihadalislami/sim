<Style>
  #rotate {
    width: 20px;
    height: 20px;
    animation-name: spin;
    animation-duration: 2000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear; 
  }
  @keyframes spin {
    from {
      transform:rotate(0deg);
    }
    to {
      transform:rotate(360deg);
    }
  }
</Style>
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><?= $judul?></h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pagination Month</h3>
                    </div>
                    <div class="card-body">
                        <ul class="pagination pagination-month justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Jan</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">
                                <p class="page-month">Feb</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Mar</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Apr</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">May</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Jun</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Jul</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Aug</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Sep</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Oct</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Nov</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <p class="page-month">Dec</p>
                                <p class="page-year">2021</p>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        <div class="row-4 text-center mb-4">
            <div 
                style="background:rgba(82, 191, 124, 0.44); 
                top:0;
                left:0;
                height:100%; 
                width:100%; 
                position:absolute;
                z-index:50;"
                id="transparan"
            >
            </div>
            <p id="belum_siap">Belum siap</p>
            <button onclick="klik()" class="text-center btn btn-primary klik"></button>
            <button onclick="database()" class="text-center btn btn-primary">Data</button>
            <div class="input-group input-group-lg mt-4">
                <input id="cari_santri" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="row">
            <div class="col" id="content">
            </div>
      </div>
    </div>
  </section>
</div>



<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/datatables@1.10.17/media/js/jquery.dataTables.min.js"></script>    
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    let tampil = () => {
        $.ajax({
            type: "POST",
            url: "<?= base_url()?>keuangan/tabel",
            beforeSend: function () {
                spining()
            },
            success: function (response) {
                $('#content').html(response)
                setTimeout(function(){
                    $('.klik').html('Segarkan');
                    $('#belum_siap').remove()
                    $('.klik').prop('disabled', false)
                    $('#cari_santri').focus(function (e) { 
                        e.preventDefault();
                    });
                },0); 
            },
            complete: function () { 
                $("#cari_santri").focus()
                $('#transparan').css('display','none');
             }
        });
    }

    let spining = () => {
        $('tbody').html('<div class="py-2">  Loading...<div>')
        url_gif = '<?=base_url()?>assets/img/rotate2.svg'          
        spinner = '<img class="mx-2" id="rotate" src='+url_gif+'>';
        $('.klik').html('Mohon menunggu, sedang menarik data..'+spinner);
        $('.klik').prop('disabled', true)
    }

    $(window).on('load', function() {
        tampil()
        $("#cari_santri").focus()
    });

    let klik = () => {
        tampil()
    }
    
</script>
