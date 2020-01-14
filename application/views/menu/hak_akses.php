<!-- https://gitbrent.github.io/bootstrap4-toggle/ -->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pl-3" style="color: darkgreen">
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
        <div class="col-lg-8">
          <div class="card elevation-2">
            <div class="card-header bg-success">
            </div>
            <div class="card-body">

              <div class="box">

                <div class="box-body no-padding">
                  
                  <table class="table table-xl table-striped">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Menu | Submenu</th>
                      <?php foreach ($user_rule as $ur): ?>
                        <th style="width: 80px"><?= $ur->nama_rule ?></th>
                      <?php endforeach ?>
                    </tr>
                    
                    <?php $no=1; foreach ($menu as $m): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $m->nama_menu ?></td>
                        <?php foreach ($user_rule as $ur): ?>
                          <td>
                            <input type="checkbox" data-toggle="toggle" data-size="xs" data-on="<?= $ur->id_rule ?>" data-off="<?= $ur->id_rule ?>" data-onstyle="success" data-offstyle="secondary">
                          </td>
                        <?php endforeach ?>
                      </tr>
                      <?php $urut=1; foreach ($sub_menu as $s): ?>
                        <?php if ($s->menu_id == $m->id_menu): ?>
                          <td></td>
                            <td><?=($no-1).'.'.$urut++.' &nbsp '. $s->nama_submenu ?></td>
                            <?php foreach ($user_rule as $ur): ?>
                              <td>
                                <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-on="<?= $ur->id_rule ?>" data-off="<?= $ur->id_rule ?>" data-onstyle="success" data-offstyle="secondary">
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
