<?php 
    $this->load->view('templates/header_hc');
 ?>

<body>
    <h2 style="margin-top:0px">P_data_awal Read</h2>
    <table class="table">
    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
    <tr><td>Nik</td><td><?php echo $nik; ?></td></tr>
    <tr><td>Nisn</td><td><?php echo $nisn; ?></td></tr>
    <tr><td>Alamat Pengenal</td><td><?php echo $alamat_pengenal; ?></td></tr>
    <tr><td>Npsn Asal</td><td><?php echo $npsn_asal; ?></td></tr>
    <tr><td>Desa Id</td><td><?php echo $desa_id; ?></td></tr>
    <tr><td>Nohp</td><td><?php echo $nohp; ?></td></tr>
    <tr><td>Proses</td><td><?php echo $proses; ?></td></tr>
    <tr><td>Ijasah</td><td><?php echo $ijasah; ?></td></tr>
    <tr><td>Skhu</td><td><?php echo $skhu; ?></td></tr>
    <tr><td>Kk</td><td><?php echo $kk; ?></td></tr>
    <tr><td>Akte</td><td><?php echo $akte; ?></td></tr>
    <tr><td>Kartu</td><td><img src="<?= site_url('uploads/'.$kartu) ?>"></td></tr>
    <tr><td>Keuangan</td><td><img src="<?= site_url('uploads/tranfer/'.$keuangan) ?>"></td></tr>
    <tr><td>Asesment</td><td><?php echo $asesment; ?></td></tr>
    <tr><td>Verf Keuangan</td><td><?php echo $verf_keuangan; ?></td></tr>
    <tr><td></td><td></td></tr>
</table>
<div class="col-12 text-center">
	<a href="<?php echo site_url('psb') ?>" class="btn btn-default my-auto"><i class="fas fa-backward"></i> Kembali</a>
</div>
<?php  
    $this->load->view('templates/footer_hc');
?>