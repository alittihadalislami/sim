<?php 
    $this->load->view('templates/header_hc');

    // var_dump($data_diri);die();
 ?>


    <h2 style="margin-top:0px" class="display-4 pl-1 text-uppercase"><?=$data_diri['Nama']?></h2>

	<div class="row">
		<div class="col-12">
			<div class="card " style="border-top: 5px solid darkgreen" >
			  	<div class="card-body p-1">
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
					<footer class="blockquote-footer">Data sesuai Ijazah dan SKHU</footer>
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
				    <?php $no=1; foreach ($data_ortu as $data => $isi): ?>
				    	<?php $no++; if ($no == 11 OR $no == 20): ?>
				    		<div class="bg-info d-block w-75 mx-auto my-4"></div>
				    	<?php endif ?>
				    	<div class="border-buttom col-md-3 m-1 p-0 ">
				    		<span class="  text-capitalize d-block text-muted border-bottom"><small><?=$data?></small></span>
				    		<span class="card-text mt-0 p-0" style="line-height: 15px"> <?= $isi=='' ? '<span class="badge badge-secondary">kosong</span>' : $isi ?></span>
				    	</div>
				    <?php endforeach ?>
			    </div>
			  </div>
			</div>
		</div>
	</div>

   
<div class="col-12 text-center">
	<a href="<?php echo site_url('psb') ?>" class="btn btn-success my-auto"><i class="fas fa-backward"></i> &nbsp Kembali</a>
</div>
<?php  
    $this->load->view('templates/footer_hc');
?>