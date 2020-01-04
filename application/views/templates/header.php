<?php
    $email = $this->session->userdata('email');
    $rule_id = $this->session->userdata('rule_id');

    $dataAktif = $this->um->dataAktif($email);
    $daftarHeading = $this->um->daftarHeading($rule_id);
    $daftarMenu = $this->um->daftarMenu($rule_id);
    $daftarSubmenu = $this->um->daftarSubmenu($rule_id); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?=base_url('assets/img')?>/favicon.ico" type="image/gif">
  
  <title><?=$judul?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/font_awesome/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="<?=base_url('assets')?>/css/googlefont.css" rel="stylesheet">

  <style>
  .user-panel{
    padding-top: 4px;
    line-height: 90%;
    border-bottom: solid; 
    border-width: 8px; 
    border-color: #F1C93C; 
    height: 100px; 
    background-color:#86C97E; 
    margin-bottom: 10px;
    text-align: center;
  }
  div.wrapper aside .sidebar nav ul li a{
    color: #1E3C13;
  }
  .active{
    background-color: #28A745!important;
    box-shadow: 1px 2px 5px green;
    font-weight: bold;
  }
  aside .sidebar nav ul li a:hover{
    color: #FFFFFF !important;
    background-color: #28A745 !important;
    border-radius: 4!important;
  }
  </style>

  <!-- jQuery -->
<script src="<?=base_url('assets/js/')?>jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/js/')?>bootstrap.bundle.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="x" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <div class="col d-flex justify-content-end ">
        <div class="col-sm">
          <div style="background-color:transparent" class="my-0 py-0 breadcrumb float-sm-right">
              <?php 
              $menuTerpilih = $this->uri->segment(1);

              foreach ($daftarMenu as $df) {
                if ($df['url'] == $menuTerpilih) {
                  $linkq= strtolower($df['nama_menu']);
                }
              }
              isset($linkq) ? $linkq = base_url().$linkq : $linkq = base_url('penilaian/raport');
              ?>

            <li class="breadcrumb-item"><a href="<?=$linkq ?>"><?= strtoupper($menuTerpilih) ?></a></li>
            <li class="breadcrumb-item"><?= strtoupper($this->uri->segment(2)) ?></li>
          </div>
        </div>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: #F4F6F9">

    <a href="" class="brand-link bg-success">
      <img src="<?=base_url('assets/img/logo_mii.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Al ITTIHAD AL ISLAMI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar p-0 " >

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="info">
          <div class="d-block">
            <strong><?=$dataAktif['nama'] ?></strong>
          </div>
          <div>
            <small><?=$dataAktif['nama_rule'] ?></small>
          </div>
        </div>
          <a href="<?=base_url('dashboard/logout') ?>" class=" d-block btn btn-danger btn-sm  my-0" style="position: absolute; top: 50px; left: 90px;"> <i class="fa fa-sign-out-alt"></i> logout</a>
      </div>

      <!-- Sidebar Menu -->
      <nav class="sidebar-menu pl-1 pr-2 pb-5 mb-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach ($daftarHeading as $dh): ?>
            <!-- <li class="nav-header">EXAMPLES</li> -->
          <div class="nav-header mt-2 pt-2 pl-3 text-uppercase" style="font-size: 15px; font-weight:bold;"><?=$dh['nama_head'] ?></div>
            <?php foreach ($daftarMenu as $dm): ?>
              <?php if ($dm['id_head'] == $dh['id_head']): ?>
                <li class="nav-item has-treeview"> <!-- menu-open -->
                  <a href="<?=base_url().$dm['url']?>" class="nav-link rounded-1 py-2">
                    <i class="nav-icon <?= $dm['icon']?>  ?>"></i>
                    <p><?=$dm['nama_menu']; echo $this->um->adaSubmenu($this->session->userdata('rule_id'),$dm['id_menu'])['submenu']>0 ? '<i class="right fa fa-angle-left"></i>' : '';?></p>
                  </a>
                  <?php foreach ($daftarSubmenu as $dsm): ?>
                  <?php if ($dsm['menu_id'] == $dm['id_menu']): ?>
                    <ul class="nav nav-treeview">
                      <li class="nav-item ">
                        <a href="<?= base_url().$dsm['url'] ?>" class="nav-link pl-4 py-0">
                          <i class="icon <?= $dsm['icon'] ?> fa-fw"></i>
                          <p><?= $dsm['nama_submenu'] ?></p>
                        </a>
                      </li>
                    </ul>
                  <?php endif ?>
                  <?php endforeach ?>

                </li>
              <?php endif ?>
            <?php endforeach ?>
          <?php endforeach ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>