function formatRupiah(angka, prefix) {
  angka = angka.toString();
  let number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }
  let lastday = function (y, m) {
    return new Date(y, m + 1, 0).getDate();
  };

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

const tampil = () => {
  $.ajax({
    type: "POST",
    url: "tabel",
    beforeSend: function () {
      spining();
    },
    success: function (response) {
      $("#content").html(response);
      setTimeout(function () {
        $(".klik").html("Segarkan");
        $("#belum_siap").remove();
        $(".klik").prop("disabled", false);
        $("#cari_santri").focus(function (e) {
          e.preventDefault();
        });
      }, 0);
    },
    complete: function () {
      $("#cari_santri").focus();
      $("#transparan").css("display", "none");
    },
  });
};

let spining = () => {
  $("tbody").html('<div class="py-2">  Loading...<div>');
  url_gif = "../assets/img/rotate2.svg";
  spinner = '<img class="mx-2" id="rotate" src=' + url_gif + ">";
  $(".klik").html("Mohon menunggu, sedang menarik data.." + spinner);
  $(".klik").prop("disabled", true);
};

const cariSantri = () => {
  let timeout;
  $("#cari_santri").keyup(function (e) {
    e.preventDefault();
    spin =
      '<img src="../assets/img/loading-emis.gif" style="height:25px" alt="" />';
    $("#icon_cari").html(spin);
    santri_atribut = $(this).val();
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      if (santri_atribut.length > 3) {
        $.ajax({
          type: "POST",
          url: "cariSAntri",
          data: { santri_atribut },
          dataType: "html",
          success: function (response) {
            $("#santri_terpilih").html(response);
            $("#icon_cari").html('<i class="fa fa-search"></i>');
          },
        });
      } else {
        $("#santri_terpilih").html("");
        $("#icon_cari").html('<i class="fa fa-search"></i>');
      }
    }, 0);
  });
};

$(window).on("load", function () {
  $("#x").click();
  tampil();
  cariSantri();
  $("#cari_santri").focus();
});

let klik = () => {
  tampil();
};

const database = () => {
  $.ajax({
    type: "POST",
    url: "database",
    dataType: "html",
    success: function (response) {
      $("#content_modal").html(response);
      $("#myModal").modal({ backdrop: "static", keyboard: false });
      uangkan();
    },
  });
};

const isi_database = () => {
  $.ajax({
    type: "POST",
    url: "isi_database",
    dataType: "html",
    success: function (response) {
      $("#kotak-tagihan").html(response);
      uangkan();
    },
  });
};

const uangkan = () => {
  $.each($(".uang"), function () {
    $(this).html(formatRupiah($(this).html(), true));
  });
};

$(document).ready(function () {
  $("body").on("click", "#tambah-nominal", function (e) {
    e.preventDefault();
    $("#kotak-tambah-nominal").css("display", "block");
    $("#tambah-nominal").hide();
  });

  $("body").on("click", ".hapus-data-nominal", function (e) {
    e.preventDefault();
    id_nominal = $(this).data("id");
    kolom = $(this).parent().parent();

    $.ajax({
      type: "POST",
      url: "hapusNominal",
      data: { id_nominal },
      //   dataType: "dataType",
      success: function (response) {
        kolom.fadeOut();
      },
    });
  });
});
