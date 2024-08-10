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

$(document).ready(function () {
  tampilData();

  $("#tambah").click(function () {
    $("#form").modal("show");
  });

  $("#tahun_ajaran").change(function (e) {
    e.preventDefault();
  });
  $("#cari").click(function (e) {
    e.preventDefault();
    tahun = $("#tahun_ajaran").val();
    tampilData(tahun);
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
