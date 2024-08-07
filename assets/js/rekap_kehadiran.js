var status_presensi = {
  4: ["btn-success", "H"],
  3: ["btn-outline-success", "D"],
  2: ["btn-primary", "S"],
  1: ["btn-warning", "I"],
  0: ["btn-danger", "A"],
};

$(document).ready(function () {
  id_kbm = null;
  $("#simpan-ajuan").click(async function (e) {
    e.preventDefault();
    data = $(".f-tambah");
    let data_jurnal = {};
    let status = 0;

    $(".f-tambah").each(function (i, data) {
      let key = data.id;
      let value = data.value;
      data_jurnal[key] = value;
      if (value !== "") {
        status += 1;
      }
    });

    if (status < data.length) {
      alert("lengkapi datanya..");
      return;
    }
    data_absen = [];
    $(".absen").each(function (i, data) {
      value = $(this).val();
      id = $(this).attr("id");
      data_absen.push({ id, value });
    });

    $.ajax({
      type: "POST",
      url: base_url + "absensi/ajax_prosesAjuan",
      data: { data_jurnal, data_absen },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#ajuanModal").modal("hide");
      },
    });
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
        $("#anggota-kelas .nama-santri").remove();
        $.each(data, function (index, dt) {
          $("#anggota-kelas").append(
            `<div class="list-group-item list-group-item-action nama-santri">
                <span id="ling-${
                  dt.santri_id
                }" class="btn btn-success ling">A</span>
                <span class="ml-2">${parseInt(index + 1)}. ${
              dt.nama_seijazah
            }</span>
                <input type="text" id="${dt.santri_id}" value="4" class="absen">
            </div>`
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
        $("#id_kbm option").remove();
        $("#id_kbm").append('<option value="" selected>Pilih..</option>');
        $.each(data, function (index, option) {
          $("#id_kbm").append(
            `<option value="${option.id_kbm}">Hari: ${option.hari}, Jam ke: ${option.jamke}</option>`
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

    $(target[0])
      .removeClass(status_presensi[nilai_asal][0])
      .addClass(status_presensi[nilai_baru][0]);
    $(target[0]).html(status_presensi[nilai_baru][1]);
  });

  $("#tambah").click(function (e) {
    e.preventDefault();
    $("#ajuanModal").modal("show");
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
