<!-- https://gitbrent.github.io/bootstrap4-toggle/ -->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul   ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10">
          <div class="card elevation-2">
            <div class="card-header bg-success">
            </div>
            <div class="card-body">

              <div class="box">

                <div class="box-body no-padding table-responsive">
                  
                  <table class="table table-striped">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Menu | Submenu</th>
                      <?php foreach ($user_rule as $ur): ?>
                        <th style="width: 80px"><?= $ur->id_rule ?></th>
                      <?php endforeach ?>
                    </tr>
                    
                    <?php $no=1; foreach ($menu as $m): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $m->nama_menu ?></td>
                        <?php foreach ($user_rule as $ur): ?>
                          <td>
                            <?php $akses = $this->um->isAksesMenu($ur->id_rule,$m->id_menu); ?>
                            <span class="cek-input" data-menu="<?= $m->id_menu?>" data-rule="<?=$ur->id_rule?>" data-kategori="2">
                              <input class="cek-input" type="checkbox" <?= $akses == 1 ? 'checked' : null ?> data-toggle="toggle"  data-size="xs" data-on="<?= $ur->nama_rule ?>" data-off="<?= $ur->nama_rule ?>" data-onstyle="success" data-offstyle="secondary">
                            </span>
                          </td>
                        <?php endforeach ?>
                      </tr>
                      <?php $urut=1; foreach ($sub_menu as $s): ?>
                        <?php if ($s->menu_id == $m->id_menu): ?>
                          <td></td>
                            <td><?=($no-1).'.'.$urut++.' &nbsp '. $s->nama_submenu ?></td>
                            <?php foreach ($user_rule as $ur): ?>
                              <td>
                                <?php $akses = $this->um->isAksesSubmenu($ur->id_rule,$s->id_submenu); ?>
                                <span class="cek-input" data-menu="<?= $s->id_submenu?>" data-rule="<?=$ur->id_rule?>" data-kategori="3">
                                  <input type="checkbox"  <?= $akses == 1 ? 'checked' : null ?> data-toggle="toggle" data-size="xs" data-on="<?= $ur->nama_rule ?>" data-off="<?= $ur->nama_rule ?>" data-onstyle="success" data-offstyle="secondary">
                                </span>
                              </td>
                            <?php endforeach ?>
                          </tr>
                        <?php endif ?>
                      <?php endforeach ?>
                    <?php endforeach ?>

                  </tbody></table>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
  $(document).ready(function(){
    $('.cek-input').on('click', function(){
       const idMenu = $(this).data('menu');
       const idRule = $(this).data('rule');
       const idKategori = $(this).data('kategori');
       
       $.ajax({
        url: "<?=base_url()?>menu/beriAkses",
        type:'post',
        data: {
          id_menu : idMenu,
          id_rule : idRule,
          kategori : idKategori
        },
        success: function(){
          /*document.location.href = "<?= base_url('menu/hakakses') ?>"*/
        }
       })
    });
  });
</script>
