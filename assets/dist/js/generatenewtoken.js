$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");
  $(".generate-new-token").on("click", function () {
    const email = $(this).data("email");
    const tryout = $(this).data("tryout");
    Swal.fire({
      title: "<b>Apakah anda yakin</b>",
      icon: "info",
      html: "<b>Generate token baru pada peserta ini ?</b>",
      focusConfirm: false,
      confirmButtonText: "Ya",
      showCancelButton: true,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: base_url + "admin/generatetoken/" + tryout,
          data: {
            email: email,
          },
          type: "post",
          success: function () {
            // JIKA URL BERHASIL DIEKSEKUSI, RELOAD HALAMAN
            window.location.reload();
          },
          // JIKA URL GAGAL DIEKSEKUSI
          error: function (request, status, error) {
            Swal.fire({
              icon: "error",
              html: request.responseText,
            });
          },
        });
      }
    });
  });
  $("body").attr("oncontextmenu", "return false;");
});
