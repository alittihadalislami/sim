<div class="content-wrapper pl-3">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><?= $judul?></h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <button id="klik">klik</button>
          <?= $this->session->flashdata('pesan'); ?>
          <div class="form-group" data-select2-id="79">
<label>Minimal</label>
<select id="tahun" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
<option selected="selected" data-select2-id="19">Alabama</option>
<option data-select2-id="81">Alaska</option>
<option data-select2-id="82">California</option>
<option data-select2-id="83">Delaware</option>
<option data-select2-id="84">Tennessee</option>
<option data-select2-id="85">Texas</option>
<option data-select2-id="86">Washington</option>
</select><span class="select2 select2-container select2-container--bootstrap4 select2-container--above select2-container--focus" dir="ltr" data-select2-id="18" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-y3mx-container"><span class="select2-selection__rendered" id="select2-y3mx-container" role="textbox" aria-readonly="true" title="Alaska">Alaska</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
</div>
          <div class="col" id="content">

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  jQuery(document).ready(function($){
  $('#tahun').change(function (e) { 
    console.log('holla');
    // ambilData()
  });

  $('#klik').click(function (e) { 
    e.preventDefault();
    alert('ok ')
    ambilData()
  });
  const ambilData = () => {
    $.ajax({
      type: "GET",
      url: "<?=base_url()?>keuangan/tabel",
      dataType: "html",
      success: function (response) {
        $('#content').html(response);
      }
    });
  }
}
</script>
