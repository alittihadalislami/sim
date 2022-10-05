<div class="row mt-2">
    <?php foreach ($santri_terpilih as $val)  :?>
    <div class="mt-2 col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <h2 class="lead"><b>
                                <?=$val['nama_santri']?>
                            </b></h2>
                        <p class="text-muted text-sm">
                            No. Induk:
                            <b>
                                <?=$val['idk_mii']?>
                            </b>
                            | Kelas:
                            <b>
                                <?=$val['nama_kelas']?>
                            </b>
                        </p>
                        <p class="text-muted text-sm"><b>Wali/Ortu:</b>
                            <?=$val['bapak']?>
                        </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small">
                                <span class="fa-li">
                                    <i class="fas fa-lg fa-building"></i>
                                </span>
                                <?=$val['alamat_ortu']?>
                            </li>
                            <hr>
                            <li class="small">
                                <span class="fa-li">
                                    <i class="fas fa-lg fa-phone"></i>
                                </span>
                                <?php
                                    $nohp = '';
                                if  ( strlen($val['hp_bapak'] > 1) ) {
                                    $nohp .= $val['hp_bapak'] ;
                                } 
                                
                                if (strlen($val['hp_ibu'] > 1 ) ) {
                                    if ($val['hp_ibu'] != $val['hp_bapak']) {
                                        if (strlen( $nohp > 1)) {
                                            $nohp .= ' / '.$val['hp_ibu'];
                                        }else{
                                            $nohp .= $val['hp_ibu'];
                                        }
                                    }
                                }
                                if ($nohp == '') {
                                    echo 'Tidak tersedia';
                                }else{
                                    echo $nohp;
                                }
                                
                                ?>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="col-5 text-center">
                        <img src="<?=base_url('assets/img/user.png')?>" alt="user-avatar" class="img-circle img-fluid">
                    </div> -->
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <!-- <a href="#" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                    </a> -->
                    <span class="pilih-santri-bayar btn btn-sm btn-primary text-white"
                        data-id="<?= $val['santri_id']?>">
                        <i class="fas fa-user"></i> Pilih Santri
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<script>
    $(".pilih-santri-bayar").click(function () {
        tgl = new Date()
        waktu = tgl.getTime()
        x = $(this).data('id')
        console.log(waktu)
        $("#santri_terpilih").html('');
    });
</script>