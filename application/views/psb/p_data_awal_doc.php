<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>P_data_awal List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Nik</th>
		<th>Nisn</th>
		<th>Alamat Pengenal</th>
		<th>Npsn Asal</th>
		<th>Desa Id</th>
		<th>Nohp</th>
		<th>Proses</th>
		<th>Ijasah</th>
		<th>Skhu</th>
		<th>Kk</th>
		<th>Akte</th>
		<th>Kartu</th>
		<th>Keuangan</th>
		<th>Asesment</th>
		<th>Verf Keuangan</th>
		
            </tr><?php
            foreach ($psb_data as $psb)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $psb->nama ?></td>
		      <td><?php echo $psb->nik ?></td>
		      <td><?php echo $psb->nisn ?></td>
		      <td><?php echo $psb->alamat_pengenal ?></td>
		      <td><?php echo $psb->npsn_asal ?></td>
		      <td><?php echo $psb->desa_id ?></td>
		      <td><?php echo $psb->nohp ?></td>
		      <td><?php echo $psb->proses ?></td>
		      <td><?php echo $psb->ijasah ?></td>
		      <td><?php echo $psb->skhu ?></td>
		      <td><?php echo $psb->kk ?></td>
		      <td><?php echo $psb->akte ?></td>
		      <td><?php echo $psb->kartu ?></td>
		      <td><?php echo $psb->keuangan ?></td>
		      <td><?php echo $psb->asesment ?></td>
		      <td><?php echo $psb->verf_keuangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>