<style>
    .active {
        background-color: #fff !important;
        box-shadow: 0px 0px 0px green;
        font-weight: bold;
    }

    #nav-tabContent .active {
        font-weight: normal;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }
    }
</style>

<section class="content">
    <div class="container-fluid">
        <div id="myModal" class="modal fade bd-example-modal-lg" style="z-index:5000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col p-5">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div id="kotak-tambah-nominal" class="row" style="display:none;">
                                        <form id="form-tambah-nominal"> 
                                        <div class="col">
                                            <div class="input-group my-3">
                                                <div class="input-group-prepend">
                                                    <span style="width: 200px" class="input-group-text">Tahun Pelajaran</span>
                                                </div>
                                                <input type="text" class="form-control" name="tapel" placeholder="Tulis tanpa tanda baca, contoh:20222023">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label style="width: 200px" class="input-group-text" for="jenis_mutasi">Jenis Tagihan</label>
                                                </div>
                                                <select class="custom-select" id="jenis_mutasi" name="jenis_mutasi">
                                                    <option value="" selected>pilihh...</option>
                                                    <option value="1">SPP</option>
                                                    <option value="2">Tahunan</option>
                                                </select>
                                            </div>
                                            <div class="input-group my-3">
                                                <div class="input-group-prepend">
                                                    <span style="width: 200px" class="input-group-text">Nominal</span>
                                                </div>
                                                <input name="nominal_mutasi" id='nominal_mutasi' type="text" class="form-control uang" placeholder="Tulis tanpa tanda baca, contoh:1000000">
                                            </div>
                                            <div class="col my-2 clearfix">
                                                <button id='submit-form-nominal' class="btn btn-danger float-right">Simpan</button>
                                                <a class="btn-tutup btn btn-secondary float-right mx-3 text-white">Tutup</a>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col ">
                                            <button id="tambah-nominal" class="btn btn-primary mb-2 float-right">Tambah</button>
                                        </div>
                                        <div id="kotak-tagihan" class="col-12 p-2 table-responsive">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Close</a>
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    
    isi_database()
    $('.uang').mask("#.##0", {reverse: true});
    $('#submit-form-nominal').click(function (e) { 
        e.preventDefault();
        let data = $('#form-tambah-nominal').serializeArray()
        let daput = {}
        data.forEach(function(el,index){
            daput [el.name] = el.value
        });        
        $.ajax({
            type: "POST",
            url: "tambahNominal",
            data: {daput},
            dataType: 'json',
            success: function (response) {
                console.log(response)
                isi_database()
            }
        });
    });

    $('.btn-tutup').click(function(){
        $("#kotak-tambah-nominal").css("display", "none")
        $("#tambah-nominal").fadeIn();
    })
 

  
</script>

