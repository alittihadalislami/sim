
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
  <link rel="stylesheet" href="<?= base_url('assets/font_awesome')?>/css/all.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/adminlte.min.css">
  <!-- iCheck -->
  <!-- boostrap -->
  <link rel="stylesheet" href="<?= base_url('assets')?>/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .card {
      border-top: 4px solid green;
    }
  </style>
</head>
<body class="hold-transition register-page">
  <?=$this->session->flashdata('pesan');?>
<div class="register-box mt-4">
  <div class="register-logo">
    <span> <b>Ma'had</b><br>Al Ittihad Al Islami</span>
  </div>

<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Halaman login</p>

      <form action="<?= base_url('auth') ?>" method="post">
        <?= form_error('email', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Alamat email" name="email" value="<?= set_value('email'); ?>">
          <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
        </div>
        <?= form_error('password', '<div class="text-danger"><small>', '</small></div>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Masukkan password" name="password">
          <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
        </div>
        <div class="row mb-3 clear-fix">
          <!-- /.col -->
          <div class="col-4 float-right">
            <button type="submit" class="btn btn-success btn-block btn-flat px-0 mx-auto"><i class="fa fa-door-open fa-sm"></i> Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="#" class="text-success"><small>Lupa password</small></a>
      </p>
      <p class="mb-0">
        <a href="<?=base_url('auth/register')?>" class="text-center text-success"><small>Belum punya akun, silahkan daftar</small></a>
      </p>
    </div>
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/js/')?>jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>
<!-- <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script> -->
<!-- <script src="?=base_url('assets/js/')?>/js/bootstrap.bundle.min.js"></script> -->
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
