
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?=base_url('assets/img')?>/favicon.ico" type="image/gif">
  <meta name="theme-color" content="#206D13">
  <title><?=$judul;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/font_awesome/css/all.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/adminlte.min.css">
  <!-- boostrap -->
  <link rel="stylesheet" href="<?= base_url('assets')?>/css/bootstrap.min.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .card {
      border-top: 4px solid green;
    }
    .input-group-append{
      background-color: whitesmoke;
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box" style="margin-top: 5%;">
  <div class="register-logo">
    <span> <b>Ma'had</b><br>Al Ittihad Al Islami</span>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Pendaftaran Akun</p>

      <form action="<?=base_url('auth/register')?>" method="post">
        <?= form_error('nama', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" value="<?= set_value('nama') ;?>">
          <div class="input-group-append">
              <span class="fa fa-user input-group-text"></span>
          </div>
        </div>
        <?= form_error('email', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ;?>">
          <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <?= form_error('password1', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Tuliskan Password" name="password1" >
          <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-key" ></i></span>
          </div>
        </div>
        <?= form_error('password2', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2">
          <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-key" ></i></span>
          </div>
        </div>
        <?= form_error('nohp', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Nomor WA/HP" name="nohp" value="<?= set_value('nohp')?>" >
          <div class="input-group-append">
              <span class="input-group-text" style="width: 43px"><i class="mx-auto fas fa fw fa-mobile" style="text-align: center;"></i></span>
          </div>
        </div>
        <div class="row my-auto">
          <div class="col-8 mb-3">
            <div class="checkbox">
              <label style="font-size: 13px;">
                <input type="checkbox"> Saya setuju <a href="#">ketentuan</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block btn-flat">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="<?=base_url('auth/index')?>" class="text-center text-success"><small>Sudah punya akun, silahkan login..</small></a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/js/')?>jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- iCheck -->
<!-- <script src="../../plugins/iCheck/icheck.min.js"></script> -->
<!-- <script> -->
  <!-- $(function () { -->
    <!-- $('input').iCheck({ -->
      <!-- checkboxClass: 'icheckbox_square-blue', -->
      <!-- radioClass   : 'iradio_square-blue', -->
      <!-- increaseArea : '20%' // optional -->
    <!-- }) -->
  <!-- }) -->
<!-- </script> -->
</body>
</html>
