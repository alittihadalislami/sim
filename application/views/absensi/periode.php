<style>
	.text-menu{
		font-size: 20px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rekap Absensi Pegawai / Guru</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    	<div class="row w-50">
    		<div class="col-sm-8 col-md-4">
	    		<div class="list-group">
					<?php foreach ($bulan as $val): ?>
					  	<a href="<?= base_url('absensi/rekap/'.$val['0'].'/'.$val['2'])?>" class="klik-lama list-group-item list-group-item-action bg-light ">
					    	<?= $val['1'] ?>
					    	<?= $val['2'] ?>
					  	</a>
					<?php endforeach ?>
				</div>	
    		</div>
    	</div>
    </div>
  </section>
</div>
