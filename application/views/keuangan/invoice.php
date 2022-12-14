<style>
    .list-group-item {
        text-align: inherit;
    }

    .activ {
        color: #0a0a0a;
        background-color: #ffe494;
        font-weight: 600;
    }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laman Pembayaran Santri</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-list"></i> Daftar Tagihan</h5>
                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <span>SPP</span>
                            <div class="list-group my-4">
                                <button type="button" class="list-tagihan list-group-item" data-bulan="JUL-2022" data-uang="100000" >JUL-2022
                                    <span class="uang">100000</span>
                                </button>
                                <button type="button" class="list-tagihan list-group-item">AGU-2022</button>
                                <button type="button" class="list-tagihan list-group-item">SEP-2022</button>
                                <button type="button" class="list-tagihan list-group-item" disabled>OKT-2022</button>
                                <button type="button" class="list-tagihan list-group-item">
                                    Bulan berikutnya
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <span>Tahunan</span>
                            <div class="list-group my-4">
                                <button type="button"
                                    class="list-tagihan list-group-item list-group-item-action">JUL-2022 <span
                                        class="uang">100000</span></button>
                                <button type="button"
                                    class="list-tagihan list-group-item list-group-item-action">AGU-2022</button>
                                <button type="button"
                                    class="list-tagihan list-group-item list-group-item-action">SEP-2022</button>
                                <button type="button" class="list-tagihan list-group-item list-group-item-action"
                                    disabled>OKT-2022</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <span>Lainnya</span>
                            <div class="list-group my-4">
                                <p class="small">- tidak ada tagihan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> MA'HAD AL ITTIHAD AL ISLAMI
                                <!-- <small class="float-right">Date: 2/10/2014</small> -->
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>BENDAHARA MA'HAD</strong><br>
                                Jl. Raya Camplong No 15<br>
                                Desa Dharma Camplong, Kab. Sampang <br>
                                Prop Jawa Timur, Kode Pos: 69281 <br>
                                WA: (804) 123-5432<br>
                                Email: alittihadalislami@gmail.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>John Doe</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> 4F3S8J<br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> 968-34567
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pembayaran</th>
                                        <th>Deskripsi</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="kwitansi">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Total:</th>
                                            <td id="total"><b class="uang"></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                Submit
                                Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    function clear_tagihan() {
        target = $(event.target).parent().parent().parent()
        target.remove()

        jumlah = $('.uang.kwitansi')
        total = 0;
        for (let i = 0; i < jumlah.length; i++) {
            const element = jumlah[i].dataset['uang'];
            total += parseInt(element);
        }
        $('#total').html('<b class="uang">'+total+'</b>');
        uangkan()
        return false
    };

    $('.list-tagihan').click(function (e) {
        e.preventDefault();
        x = $(this).toggleClass("activ").blur()
        kategori = x.parent().siblings().text()
        tagihan_id = x[0].dataset['bulan']
        tagihan = kategori +" "+ tagihan_id
        uang = x[0].dataset['uang']
        urut = $('#kwitansi').children().length + 1
        
        html = "<tr id='"+tagihan_id+"'>"
        html +="<td class='urutan' >"+urut+"</td>"
        html +="<td>"+kategori+"</td>"
        html +="<td>"+tagihan+"</td>"
        html +="<td><span class='uang kwitansi' data-uang='"+uang+"'>"+uang+"</span> <a href='#' onClick='return clear_tagihan()' class='ml-5 text-danger'><b>x</b></a></td>"
        html +="</tr>"
        $('#kwitansi').append(html);
        
        jumlah = $('.uang.kwitansi')
        total = 0;
        for (let i = 0; i < jumlah.length; i++) {
            const element = jumlah[i].dataset['uang'];
            total += parseInt(element);
        }
        $('#total').html('<b class="uang">'+total+'</b>');
        uangkan()
    });
    uangkan()
</script>


