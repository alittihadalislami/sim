<style>
  @media (min-width: 990px){
  div.error-content{
    height: 120px; 
    padding-top: 5px; 
    border-left: 6px solid gold; 
    margin-left: 100px; 
    padding-left: 40px;
    text-align: left;
  }
  div.error-page{
    margin-left: 50px;
  }
  }
  @media (max-width: 991px){
    div.error-content{
    text-align:center;
  }}

</style>

<div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
      <div class="error-page">
        <h2 class="headline" style="color: darkgreen"> 404</h2>

        <div class="error-content ">
          <h3><i class="fas fa-exclamation-triangle text-yellow"></i> Oops! Halaman tidak tersedia.</h3>

          <p>
            Silahkan kembali ke <a href="<?=base_url('dashboard')?>">dashboard</a>, <br>halaman ini dalam perbaikan atau anda tidak memiliki hak akses.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
</div>