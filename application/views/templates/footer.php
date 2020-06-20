  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      Jl. Raya Camplong No.15, Camplong Sampang 69281
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> | Sistem Informasi <a href="#">Ma'had </a></strong><br>Al Ittihad Al Islami Camplong.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <div class="preloader" style="display: none">
    <div class="loading">
      <img src="<?= base_url('assets/img/') ?>ajax-loader.png" >
    </div>
  </div>
</div>
<!-- ./wrapper -->


<!-- AdminLTE App -->
<script src="<?=base_url('assets/js/')?>adminlte.min.js"></script>
<!--<script src="<?php //echo base_url('assets/js/')?>Chart.min.js"></script>-->
<script>
  $(document).ready(function(){
    var sm = $('aside .sidebar nav ul li ul li a');
      sm.click(function(){
        sm.removeClass("active");
        $(this).addClass("active");
      });

    var m = $('aside > .sidebar > nav > ul > li > a');
      m.click(function(){
        m.removeClass("active", "menu-open");
        $(this).addClass("active");
      });
    
    sm.each(function(){
      anchorEl = $(this).attr('href');
      if (document.location.href.indexOf(anchorEl) >=0 ){
        $(this).addClass("active");
        // $(this).parent().parent().siblings('.nav-link').addClass("active");
        $(this).parent().parent().parent().addClass("menu-open");
      }
    })
    m.each(function(){
      anchorEl = $(this).attr('href');
      if (document.location.href.indexOf(anchorEl) >=0 ){
        $(this).addClass("active");
      }
    });
  });
  

  $(document).ready(function(){
    $(".preloader").fadeOut('slow');
  })

  $('.klik-lama').on('click', function(){
    $(".preloader").fadeIn('slow');
  })

</script>

<!-- <script type="text/javascript">
  var timestamp = '<?=time();?>';
  function updateTime(){
    $('#time').html(Date(timestamp));
    timestamp++;
  }
  $(function(){
    setInterval(updateTime, 1000);
  });
</script> -->
</body>
</html>