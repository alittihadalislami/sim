var base_url = window.location.origin + "/sim/";

var status_presensi = {
  4: ["btn-success", "Hadir"],
  3: "btn-outline-success",
  2: "btn-primary",
  1: "btn-warning",
  0: "btn-danger",
};

$(document).ready(function () {
  id_kbm = null;
  data_form_tambah = [];

  $("#simpan-ajuan").click(function (e) {
    e.preventDefault();
    data = $(".f-tambah");
    let status = 0;
    $(".f-tambah").each(function (i, data) {
      data_form_tambah[data.id] = data.value;
      if (data.value !== "") {
        status += 1;
      }
    });
    console.log(status);
    if (status < data.length) {
      alert("lengkapi datanya..");
      return;
    }
    console.log(data_form_tambah);
  });

  // JavaScript
  var today = new Date();
  var prevMonth = new Date(today.getFullYear(), today.getMonth() - 1, 26);
  var maxDate = new Date(today.getFullYear(), today.getMonth(), 25);

  // Jika sekarang bulan Januari, maka ambil Desember tahun sebelumnya
  if (today.getMonth() === 0) {
    prevMonth = new Date(today.getFullYear() - 1, 11, 25);
  }

  $(".input-group.date").datepicker({
    format: "DD, d MM yyyy",
    autoclose: true,
    language: "id",
    weekStart: 1,
    startDate: prevMonth,
    endDate: maxDate,
  });

  tahun = document.getElementById("tahun").value;
  bulan = document.getElementById("bulan").value;
  asatid = document.getElementById("asatid").value;

  $("#tanggal").change(function () {
    $.ajax({
      type: "POST",
      url: base_url + "absensi/ajax_getMapel",
      data: { tahun, asatid },
      dataType: "json",
      success: function (data) {
        $("#mapel option").remove();
        $("#mapel").append('<option value="" selected>Pilih..</option>');
        $.each(data, function (index, option) {
          $("#mapel").append(
            '<option value="' +
              option.id_mapel +
              '">' +
              option.mapel_alias +
              "</option>"
          );
        });
      },
    });
  }); //akhir #ket
  $("#mapel").change(function () {
    mapel = document.getElementById("mapel").value;
    $.ajax({
      type: "POST",
      url: base_url + "absensi/ajax_getKelas",
      data: { tahun, asatid, mapel },
      dataType: "json",
      success: function (data) {
        $("#kelas option").remove();
        $("#kelas").append('<option value="" selected>Pilih..</option>');
        $.each(data, function (index, option) {
          $("#kelas").append(
            '<option data-jamke="' +
              option.jamke +
              '" value="' +
              option.id_kelas +
              '">' +
              option.nama_kelas +
              "</option>"
          );
        });
      },
    });
  }); //akhir #ket

  $("#kelas").on("change", function () {
    const kelas = document.getElementById("kelas").value;
    const mapel = document.getElementById("mapel").value;
    const selectedOption = $(this).find(":selected");
    const data = selectedOption.data("jamke");
    $.ajax({
      type: "POST",
      url: base_url + "absensi/ajax_anggotaKelas",
      data: { kelas },
      dataType: "json",
      success: function (data) {
        $("#anggota-kelas button").remove();
        $.each(data, function (index, dt) {
          $("#anggota-kelas").append(
            '<div class="list-group-item list-group-item-action nama-santri">' +
              '<span id="ling-' +
              dt.santri_id +
              '" class="btn btn-success ling">A</span>' +
              '<span class="ml-2">' +
              index +
              ". " +
              dt.nama_seijazah +
              "</span>" +
              '<input type="text" id="val-' +
              dt.santri_id +
              '" value="4" class="absen">' +
              "</div>"
          );
        });
      },
    });

    $.ajax({
      type: "POST",
      url: base_url + "absensi/ajax_jadwal",
      data: { asatid, kelas, mapel },
      dataType: "json",
      success: function (data) {
        $("#jadwal option").remove();
        $("#jadwal").append('<option value="" selected>Pilih..</option>');
        $.each(data, function (index, option) {
          $("#jadwal").append(
            '<option value="' +
              option.id_kbm +
              '">Hari: ' +
              option.hari +
              ", Jam ke: " +
              option.jamke +
              "</option>"
          );
        });
      },
    });
  });

  $("#jadwal").on("change", function () {
    id_kbm = document.getElementById("jadwal").value;
    console.log(id_kbm);
  }); //akhir #ket

  $(document).on("click", ".nama-santri", function (e) {
    e.preventDefault();
    target = $(this).find("*");

    nilai_asal = target[2].value;
    nilai_baru = nilai_asal == 0 ? 4 : nilai_asal - 1;
    target[2].value = nilai_baru;
    console.log(nilai_asal);
    console.log(nilai_baru);

    $(target[0])
      .removeClass(status_presensi[nilai_asal])
      .addClass(status_presensi[nilai_baru]);

    console.log(status_presensi[nilai_baru]);
  });
});

$("#cari").click(function (e) {
  e.preventDefault();
  tahun = document.getElementById("tahun").value;
  bulan = document.getElementById("bulan").value;
  asatid = document.getElementById("asatid").value;

  if (tahun == "" || bulan == "" || asatid == "") {
    alert("Silahkan pilih data terlebih dahulu");
    return;
  }

  $.ajax({
    type: "POST",
    url: base_url + "absensi/asatid_ajax",
    data: { tahun, bulan, asatid },
    dataType: "json",
    // beforeSend: function () {
    // buatLoading();
    // },
    success: function (response) {
      hasil = "";
      for (let i = 0; i < response.length; i++) {
        hasil +=
          "<tr><td>" +
          (i + 1) +
          "</td>" +
          "<td>" +
          response[i]["tgl"] +
          "</td>" +
          "<td>" +
          response[i]["nama_asatid"] +
          "</td>" +
          "<td>" +
          response[i]["kelas_alias"] +
          "</td>" +
          "<td>" +
          response[i]["mapel_alias"] +
          "</td>" +
          "<td>" +
          response[i]["materi"] +
          "</td>" +
          "<td>" +
          response[i]["jamke"] +
          "</td>" +
          "<td> hadir </td>";
      }
      $("#data").html(hasil);
      $("#tambah").removeClass("d-none");
    },
  });
});
