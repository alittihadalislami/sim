function tampilData(tahun = "2023-2024") {
  $.ajax({
    type: "POST",
    url: base_url + "yayasan/tampilData/" + tahun,
    dataType: "json",
    success: function (data) {
      html = "";
      $.each(data, function (idx, val) {
        html += `<tr>
            <td>${idx + 1}</td>
            <td>${val.nama_asatid}</td>
            <td>${val.lembaga}</td>
            <td>${val.tugas}</td>
            <td>${val.no_surat}</td>
            <td class="text-center">
                <a class="buat-sk" target="_blank" data-id="${
                  val.id_penugasan
                }" href='${base_url}yayasan/buatSkYayasan/${
          val.id_penugasan
        }'><i class="fas fa-arrow-alt-circle-down"></i></a>
            </td>
        </tr>`;
      });
      $("#data").html(html);
    },
  });
}

const buatNoSk = async () => {
  const response = await new Promise((resolve, reject) => {
    $.ajax({
      type: "POST",
      url: base_url + "yayasan/ajaxCekNomor",
      dataType: "json",
      success: resolve,
      error: reject,
    });
  });
  return response;
};

$(document).ready(function () {
  tampilData();

  $("#tambah").click(function () {
    tahun = $("#tahun_ajaran").val();

    if (tahun === "" || tahun === "2023-2024") {
      alert("Tahun ajaran tidak boleh kosong / salah");
      return; // Keluar dari fungsi jika tahun kosong
    }

    $("#tahun").val(tahun);
    $("#form").modal("show");
  });

  $("#tahun_ajaran").change(function (e) {
    e.preventDefault();
    tahun = $("#tahun_ajaran").val();
    tampilData(tahun);
  });

  $("#cari").click(function (e) {
    e.preventDefault();
    tahun = $("#tahun_ajaran").val();
    tampilData(tahun);
  });

  $("#tugas").change(function (e) {
    e.preventDefault();
    isi = $("#tugas").val();
    console.log(isi);
    if ($("#tugas").val() == "2") {
      $("#div-mapel").removeClass("d-none");
    } else {
      $("#div-mapel").addClass("d-none");
    }
  });

  $("#tugas, #lembaga").change(function () {
    input_lembaga = $("#lembaga").val();
    if (input_lembaga == 1) {
      lembaga = "MII";
    } else if (input_lembaga == 2) {
      lembaga = "MA";
    } else {
      lembaga = "SMP";
    }

    const fetchData = async () => {
      const nomor = await buatNoSk();
      const bulan_romawi = "VII";
      const tahun = "2024";
      nomor_baru = `${nomor.padStart(
        3,
        "0"
      )}/YPAA/${lembaga}/${bulan_romawi}/${tahun}`;
      console.log(nomor_baru);

      $("#no_surat").val(nomor_baru);
    };

    fetchData();
  });

  $("#gen-nomor-surat").click(function (e) {
    e.preventDefault();

    const fetchData = async () => {
      const nomor = await buatNoSk();
      const lembaga = "MII";
      const bulan_romawi = "VII";
      const tahun = "2024";
      nomor_baru = `${nomor.padStart(
        3,
        "0"
      )}/YPAA/${lembaga}/${bulan_romawi}/${tahun}`;
      console.log(nomor_baru);

      $("#no_surat").val(nomor_baru);
    };

    fetchData();
  });

  //   $(document).on("click", ".buat-sk", function () {
  //     var id = $(this).data("id");
  //     $.ajax({
  //       url: base_url + "yayasan/buatSkYayasan/" + id,
  //       type: "GET",
  //       success: function (response) {
  //         // Lakukan sesuatu setelah file berhasil diunduh
  //         console.log("File berhasil diunduh!");
  //       },
  //       error: function (xhr, status, error) {
  //         // Tangani error jika terjadi
  //         console.error("Terjadi kesalahan: " + error);
  //       },
  //     });
  //   });
});
