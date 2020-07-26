<?php 
    $this->load->view('templates/header_hc');
    $id_csantri = $this->uri->segment(3);
 ?>


    <h2 class="p-2 px-3 d-md-inline-block text-uppercase bg-white rounded elevation-2" style="border-top: 5px solid darkgreen"><i class="far fa-user-circle"></i> <?=$data_diri['Nama']?></h2>

	<div class="row mt-2">
		<div class="col-12">
			<div class="card " style="border-top: 5px solid darkgreen" >
			  	<div class="card-body p-1">
			  		<h5 class="card-title my-2 text-center">
				    	Data Diri Santri
						<footer class="blockquote-footer">Data sesuai Ijazah dan SKHU</footer>
				    </h5>
					<div class="d-md-flex flex-wrap justify-content-around">
				    <?php $no=0; foreach ($data_diri as $data => $isi): ?>
				    	<?php $no++; if ($no > 1 ): ?>
				    		<?php if ( $no == 5 ): ?>
				    			<div class="col-md-7 m-1 p-0 my-3">
						    		<span class="  text-capitalize d-block text-muted border-bottom"><small><?=$data?></small></span>
						    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $isi=='' ? '<span class="badge badge-secondary">kosong</span>' : $isi ?></span>
						    	</div>
				    		<?php else: ?>	
					    	<div class="col-md-3 m-1 p-0 my-3">
					    		<span class="  text-capitalize d-block text-muted border-bottom"><small><?=$data?></small></span>
					    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $isi=='' ? '<span class="badge badge-secondary">kosong</span>' : $isi ?></span>
					    	</div>
				    		<?php endif ?>
				    	<?php endif ?>
				    <?php endforeach ?>
			    </div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card my-3" style="border-top: 5px solid darkgreen" >
			  <div class="card-body p-1">
			    <h5 class="card-title my-2 text-center">
			    	Data Ijasah/Pendidikan
					<footer class="blockquote-footer">Data Kartu Keluarga</footer>
			    </h5>
			    <div class="d-md-flex flex-wrap justify-content-around">
				    <?php foreach ($data_pendidikan as $data => $isi): ?>
				    	<div class="col-md-5 m-1 p-0 my-3">
				    		<span class="  text-capitalize d-block text-muted border-bottom"><small><?=$data?></small></span>
				    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $isi=='' ? '<span class="badge badge-secondary">kosong</span>' : $isi ?></span>
				    	</div>
				    <?php endforeach ?>
			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card my-3" style="border-top: 5px solid darkgreen" >
			  <div class="card-body p-1">
			    <h5 class="card-title my-2 text-center">
			    	Data Orang Tua / Wali
					<footer class="blockquote-footer">Data sesuai Ijazah dan SKHU</footer>
			    </h5>
			    <div class="d-md-flex align-items-start flex-wrap justify-content-around pb-5" style="overflow: scroll; height: 404px">

			    	<div class="border-buttom col-md-11 m-1 p-0 mb-5 ">
			    		<span class="  text-capitalize d-block border-bottom "><small>NO Kartu Keluarga</small></span>
			    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $data_ortu['Nomor Kartu Keluarga']=='' ? '<span class="badge badge-secondary">kosong</span>' : $data_ortu['Nomor Kartu Keluarga'] ?></span>
			    	</div>


				    <?php $no=1; foreach ($data_ortu as $data => $isi): ?>
				    	<?php $no++; if ($no > 2): ?>
					    	<?php if ($no == 12 OR $no == 21): ?>
					    		<div class="bg-info d-block w-75 mx-auto my-4"></div>
					    	<?php endif ?>
					    	<div class="border-buttom col-md-3 m-1 p-0 ">
					    		<span class="  text-capitalize d-block text-muted border-bottom"><small><?=$data?></small></span>
					    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $isi=='' ? '<span class="badge badge-secondary">kosong</span>' : $isi ?></span>
					    	</div>
				    	<?php endif ?>
				    <?php endforeach ?>

			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card my-3" style="border-top: 5px solid darkgreen" >
			  <div class="card-body p-1">
			    <h5 class="card-title my-2 text-center">
			    	Lampiran / Dokument Upload
					<footer class="blockquote-footer">Data sesuai yang diupload User</footer>
			    </h5>

				<?php if (count ($data_upload) < 1): ?>
					<div class="mt-4 col-12 text-center text-gray-dark">Belum ada berkas diupload</div>
				<?php endif ?>

				<!-- start card content -->
			    <div class="d-flex" style="overflow: scroll;">
			    	<?php foreach ($data_upload as $index => $upload ): ?>
			    		<?php  
			    			if ($index == 'keuangan') {
			    				$img = 'https://psb.alittihadalislami.org/uploads/transfer/'.$upload;
			    			}else{
			    				$img = 'https://psb.alittihadalislami.org/uploads/'.$upload;
			    			}
			    		?>
					    <div class="col-md-2">
						    <div class="card text-center">

						    	<a href="<?= $img ?>"  
								   onclick="window.open('<?= $img ?>', 
								                         'newwindow', 
								                         'width=500,height=700'); 
								   return false;" >
							  		<img src="<?= $img ?>" class="card-img-top img-thumbnail" style="height: 200px; width: auto;">
								</a>

							  <div class="card-body text-center">
							    <p class="card-text font-weight-bold"><?= strtoupper($index) ?></p>
							    <a href="#" class="btn btn-primary">Verifikasi</a>
							  </div>
							</div>
					    </div>
			    	<?php endforeach ?>
			    </div>
				<!-- end card -->
			  </div>
			</div>
		</div>
	</div>

   
<div class="col-12 text-center">
	<a href="<?php echo site_url('psb') ?>" class="btn btn-secondary my-auto"><i class="fas fa-backward"></i> &nbsp Kembali</a>
	<a href="<?php echo site_url('psb/diterima/').$id_csantri ?>" class="btn btn-success my-auto ml-3"><i class="far fa-arrow-alt-circle-down"></i> &nbsp Diterima</a>
</div>
<?php  
    $this->load->view('templates/footer_hc');
?>