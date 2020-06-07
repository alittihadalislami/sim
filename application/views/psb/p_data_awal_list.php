<?php 
    $this->load->view('templates/header_hc');
 ?>

        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Daftar calon santri 2020</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <!-- <?php echo anchor(site_url('psb/create'), '<i class="fas fa-plus-circle"></i> Tambah', 'class="btn btn-primary"'); ?> -->
        		<!-- // <?php echo anchor(site_url('psb/excel'), 'Excel', 'class="btn btn-primary"'); ?> -->
        		<!-- // <?php echo anchor(site_url('psb/word'), 'Word', 'class="btn btn-primary"'); ?> -->
    	    </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive p-3">
                
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                		    <th width="49%">Nama calon santri</th>
                		    <th>NIK</th>
                            <th>ID</th>
                		    <th width="10%">Formulir</th>
                		    <th>Ijasah</th>
                		    <th>Skhu</th>
                		    <th>Kk</th>
                		    <th>Akte</th>
                		    <th>Kartu</th>
                		    <th width="15%" >Dokumen</th>
                		    <th width="15%">Keuangan</th>
                		    <th width="10%">Asesment</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
        	    
                </table>
            </div>
        </div>
        <?php  
            $this->load->view('templates/footer_hc');
        ?>
        <script type="text/javascript">

            function tidakKosong100(param){
                if (param == null || param == '' ) {
                    return param = 0;
                }else{
                    if (param >= 0 && param <= 110 ) {
                        return param;
                    }else{
                        return param = 100;
                    }
                }
            }

            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "Sabar..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?= base_url('psb/json') ?>", "type": "POST"},
                    columns: [
                        {
                            "data": "id_data_awal",
                            "orderable": false
                        },
                        {"data": "nama",
                            "render": function (data, type, row) {
                                let sts_lgkp = eval(tidakKosong100(row.proses))+eval(tidakKosong100(row.ijasah))+eval(tidakKosong100(row.skhu))+eval(tidakKosong100(row.kk))+eval(tidakKosong100(row.akte))+eval(tidakKosong100(row.keuangan))+eval(tidakKosong100(row.verf_keuangan))+eval(tidakKosong100(row.asesment));
                                let persen = Math.round(sts_lgkp/8);
                                return data+'<br><i class="fas fa-user-circle"></i> '+row.nik+'<br><i class="fas fa-key"></i> '+row.npsn_asal+'<br><hr> <a href="<?=base_url("psb/read")?>/'+row.id_data_awal+'" style="text-transform: capitalize" class="badge badge-info"> Detail: '+persen+' % </a`>'
                            }
                        },
                        {"data": "nik"},
                        {"data": "id_data_awal"},
                        // {"data": "nisn"},
                        // {"data": "alamat_pengenal"},
                        // {"data": "npsn_asal"},
                        // {"data": "desa_id"},
                        // {"data": "nohp"},
                        {"data": "proses",
                            "render": function (data, type, row) {
                                return tidakKosong100(data)+' %';
                            }
                        },
                        {"data": "ijasah"},
                        {"data": "skhu"},
                        {"data": "kk"},
                        {"data": "akte"},
                        {"data": "kartu"},
                        {"data": null, //dokumen
                            "searchable": false,
                            "orderable":false,
                            "render": function (data, type, row) {
                                
                                if (row.ijasah==null || row.ijasah==''){
                                    str_ijasah = '<span class="badge badge-secondary"><i class="far fa-window-close"></i> Ijasah</span><br>';
                                }else{
                                    str_ijasah = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Ijasah</span><br>';
                                }

                                if (row.skhu==null || row.skhu==''){
                                    str_skhu = '<span class="badge badge-secondary"><i class="far fa-window-close"></i> SKHU</span><br>';
                                }else{
                                    str_skhu = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> SKHU</span><br>';
                                }

                                if (row.kk==null || row.kk==''){
                                    str_kk = '<span class="badge badge-secondary"><i class="far fa-window-close"></i> KK</span><br>';
                                }else{
                                    str_kk = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> KK</span><br>';
                                }

                                if (row.akte==null || row.akte==''){
                                    str_akte = '<span class="badge badge-secondary"><i class="far fa-window-close"></i> Akte</span><br>';
                                }else{
                                    str_akte = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Akte</span><br>';
                                }

                                if (row.kartu==null || row.kartu==''){
                                    str_kartu = '<span class="badge badge-secondary"><i class="far fa-window-close"></i> Kartu</span><br>';
                                }else{
                                    str_kartu = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Kartu</span><br>';
                                }
                                
                                return str_ijasah+str_skhu+str_kk+str_akte+str_kartu;
                            }
                        },
                        {"data": "verf_keuangan",
                            // "searchable": false,
                            // "orderable":false,
                            "render": function (data, type, row) {
                                
                                if ( data==null || data=='' ) {
                                    if (row.keuangan == null || row.keuangan =='') {
                                        return '<span class="badge badge-secondary"><i class="far fa-window-close"></i> belum upload<span>';
                                    }else{
                                        return '<a href="#" class="badge badge-warning"><i class="fas fa-file-upload"></i> upload</a>';
                                    }
                                }else
                                    return '<a href="#" class="badge badge-success"><i class="fas fa-check-double"></i> terverifikasi</a>';
                            }
                        },
                        {"data": "asesment",
                            "render": function (data, type, row) {
                                return tidakKosong100(data)+' %';
                            }
                        },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    columnDefs: [
                        {
                            "targets": [ 2,5,6,7,8,9 ],
                            "visible": false
                        },
                        {
                            "targets": [3,4,12],
                            "className": "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
    </body>
</html>