<style>
	ul > li > a.btn{
		padding:  1px 5px;
		margin-right: 10px;
		border-radius: 10px;
	}
	.card{
		border-top: 5px solid green;
	}
	
	@media only screen and (min-width: 769px) {
		.alert{
			margin-left: 15%;
		}
	}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul; ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container">
    	<div class="row" >

    		<?= $this->session->flashdata('pesan'); ?>

			<?php foreach ($id_mapel_unik as $mu) : ?>
				
	    		<div class="card elevation-2 col-lg-5 mb-4 pt-4 py-2 mx-2">
					<ul class="list-group list-group-flush">

						<?php foreach ($mapel as $m): ?>
						<?php if ($mu == $m['id_mapel']): ?>
							
						
					    <li class="list-group-item">
					    	<?= $m['nama_mapel'].'-'.$m['nama_kelas'] ?>
					    	<a href="<?= base_url('penilaian/na') .'/'. $m['id_asatid'].'/'.$m['id_mapel'].'/'.$m['id_kelas'] ?>" class="btn btn-success float-right">
					    		<?php if(!$this->um->ambilNilaiAkhir($tahunAktif, $m['id_kelas'], $m['id_mapel']) ) {  ?>
						    		<span style="position: absolute; right: 20px;" class="badge badge-secondary">
						    			b
						    		</span>
						    	<?php } ?>
					    		NA
					    	</a>
					    	
					    	<a href="<?= base_url('penilaian/nh') .'/'. $m['id_asatid'].'/'.$m['id_mapel'].'/'.$m['id_kelas'] ?>" class="btn btn-primary float-right">
					    		<?php if ( count($this->um->nilaiKd($m['id_mapel'], $m['id_kelas'], $tahunAktif))  < 1 ) : ?>
						    		<span style="position: absolute; right: 62px;" class="badge badge-secondary">
						    			b
						    		</span>
						    	<?php endif ?>
					    		NH
					    	</a>

					    	<a href="<?= base_url('penilaian/kd') .'/'. $m['id_asatid'].'/'.$m['id_mapel'].'/'.$m['id_kelas'] ?>" class="btn btn-warning float-right">
					    		<?php if ($this->um->kdOke($m['id_mapel'],$m['rombel'],2) < 2 ): ?>
						    		<span style="position: absolute; right: 105px;" class="badge badge-secondary">
						    			b
						    		</span>
					    		<?php endif ?>
					    		KD
					    	</a>
					    </li>
					    <div>
					    </div>
	    				<?php endif ?>
						<?php endforeach ?>
					</ul>
	    		</div>
			<?php endforeach ?>

    	</div>
    </div>
  </section>
</div>
